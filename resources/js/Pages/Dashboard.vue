<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

import { ref } from "vue";
import axios from "axios";

//Reactive variables for API response

//APOD
const apodData = ref(null);
const loading = ref(false);
const error = ref(null);

//Apod Methods
const fetchApodData = async () => {
    loading.value = true;
    error.value = null;

    try {
        const response = await axios.get('/api/apod');
        apodData.value = response.data;
    } catch (err) {
        error.value = 'Failed to retrieve APOD Datas';
        console.error(err);
    } finally {
        loading.value = false;
    }
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hello Welcome aboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-10xl mx-auto sm:px-6 lg:px-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                <img :src="apodData.url" :alt="apodData.title" class="max-w-full h-auto" />
                            </div>
                            <p class="mt-2"><strong>Copyright:</strong> {{ apodData.copyright }}</p>
                            <p class="mt-2"><strong>Date:</strong> {{ apodData.date }}</p>
                            <a :href="apodData.hdurl" target="_blank" class="mt-2 text-blue-500">View HD Image</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
