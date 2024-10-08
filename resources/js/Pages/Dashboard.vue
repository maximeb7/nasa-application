<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

import {ref} from "vue";
import ApodService from "@/Services/ApodService.js";
import EpicService from "@/Services/EpicService.js";
import MarsService from "@/Services/MarsService.js";
import DatePicker from 'vue3-datepicker';

const apodData = ref(null);
const loading = ref(false);
const loadingEpic = ref(false);
const loadingMars = ref(false);
const error = ref(null);
const selectedDate = ref(null);
const today = new Date();
const epicData = ref(null);
const marsData = ref(null);
const errorMars = ref(null);
const selectedDateMars = ref(null);


const apodService = new ApodService();
//Apod Methods
const fetchApodData = async () => {
    loading.value = true;
    error.value = null;

    try {
        apodData.value = await apodService.fetchApodData();
    } catch (err) {
        error.value = err.message || 'Failed to retrieve APOD data';
    } finally {
        loading.value = false;
    }
};

const fetchMarsData = async () => {
    loadingMars.value = true;
    errorMars.value = null;
    if (!selectedDateMars) {
        errorMars.value = 'Failed to retrieve Epic Date';
        return;
    }
    const day = selectedDateMars.value.getDate().toString().padStart(2, '0');
    const month = (selectedDateMars.value.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
    const year = selectedDateMars.value.getFullYear();


    try {
        const marsService = new MarsService(day, month, year);
        marsData.value = await marsService.fetchMarsPhotosData();
        console.log('data =====>', marsData.value)
    } catch (err) {
        errorMars.value = err.message || 'Failed to retrieve Epic Date';
    } finally {
        loadingMars.value = false;
    }
}


const fetchEpicData = async () => {
    loadingEpic.value = true;
    error.value = null;
    if (!selectedDate) {
        error.value = err.message || 'Failed to retrieve Epic Date';
        return;
    }
    const day = selectedDate.value.getDate().toString().padStart(2, '0');
    const month = (selectedDate.value.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
    const year = selectedDate.value.getFullYear();


    try {
        const epicService = new EpicService(day, month, year);
        epicData.value = await epicService.fetchEpicData();
        console.log('data =====>', epicData.value)
    } catch (err) {
        error.value = err.message || 'Failed to retrieve Epic Date';
    } finally {
        loadingEpic.value = false;
    }
}

const isDateValid = (date) => {
    return date && date < today;
};

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hello Welcome aboard</h2>
        </template>

        <div class="py-12 mb-12 relative" style="overflow: visible">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-amber-200 overflow-visible shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-around items-center mt-4">
                            <h2 class="text-2xl text-cyan-800">Mars Rover Photos</h2>
                        </div>
                        <div class="flex justify-around items-center mt-12">
                            <DatePicker v-model="selectedDateMars" :max-date="today"/>
                            <button
                                @click="fetchMarsData"
                                class="bg-blue-500 text-white px-4 py-2 rounded"
                                :disabled="!isDateValid(selectedDateMars)"
                            >
                                Get photo
                            </button>
                        </div>

                        <!-- Display loading spinner -->
                        <div v-if="loadingMars" class="mt-4 flex justify-center">
                            <p class="text-2xl text-cyan-800">Loading...</p>
                        </div>

                        <!-- Display error message -->
                        <div v-if="errorMars" class="mt-4 text-red-500">
                            <p>{{ errorMars }}</p>
                        </div>

                        <!-- Display Mars photo -->
                        <div v-if="marsData" class="mt-4">
                            <h3 class="text-xl font-bold">{{ marsData?.camera?.full_name }}</h3>
                            <p class="mt-2">{{ marsData?.rover?.name }}</p>
                            <div class="flex justify-center mt-4">
                                <img :src="marsData?.img_src" :alt="marsData?.camera?.full_name" class="w-full h-auto"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-12 mb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
                <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-around align-middle mt-4">
                            <h2 class="text-2xl text-cyan-800"> Astronomy picture of the day</h2>
                            <button @click="fetchApodData" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Get Astronomy Picture of the Day
                            </button>
                        </div>


                        <!-- Display loading spinner -->
                        <div v-if="loading" class="mt-4 justify-center">
                            <p class="text-2xl text-cyan-800">Loading...</p>
                        </div>

                        <!-- Display error message -->
                        <div v-if="error" class="mt-4 text-red-500">
                            <p>{{ error }}</p>
                        </div>

                        <!-- Display APOD data -->
                        <div v-if="apodData" class="mt-4">
                            <h3 class="text-xl font-bold">{{ apodData.title }}</h3>
                            <p class="mt-2">{{ apodData.explanation }}</p>
                            <div class="flex justify-center mt-4">
                                <img :src="apodData.url" :alt="apodData.title" class="max-w-full h-auto"/>
                            </div>
                            <p class="mt-2"><strong>Copyright:</strong> {{ apodData.copyright }}</p>
                            <p class="mt-2"><strong>Date:</strong> {{ apodData.date }}</p>
                            <a :href="apodData.hdurl" target="_blank" class="mt-2 text-blue-500">View HD Image</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 mb-12 relative" style="overflow: visible;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-visible shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-around items-center mt-4">
                            <h2 class="text-2xl text-cyan-800">Earth Polychromatic Imaging Camera</h2>
                        </div>
                        <div class="flex justify-around items-center mt-12 relative" style="overflow: visible;">
                            <div class="relative z-50">
                                <DatePicker
                                    v-model="selectedDate"
                                    :max-date="today"
                                />
                            </div>
                            <button
                                @click="fetchEpicData"
                                class="bg-blue-500 text-white px-4 py-2 rounded"
                                :disabled="!isDateValid(selectedDate)"
                            >
                                Get Earth Polychromatic Imaging Camera of the Day
                            </button>
                        </div>

                        <!-- Display loading spinner -->
                        <div v-if="loadingEpic" class="mt-4 flex justify-center">
                            <p class="text-2xl text-cyan-800">Loading...</p>
                        </div>

                        <!-- Display error message -->
                        <div v-if="error" class="mt-4 text-red-500">
                            <p>{{ error }}</p>
                        </div>

                        <!-- Display EPIC data -->
                        <div v-if="epicData" class="mt-4">
                            <h3 class="text-xl font-bold">{{ epicData?.identifier }}</h3>
                            <p class="mt-2">{{ epicData?.caption }}</p>
                            <div class="flex justify-center mt-4">
                                <img :src="epicData?.source" alt="Epic Image" class="w-full h-auto"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
