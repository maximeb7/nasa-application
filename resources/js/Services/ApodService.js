import axios from 'axios';
const TOKEN = localStorage.getItem('authToken')

export default class ApodService {
    constructor() {
        this.apiEndpoint = '/api/apod';
    }

    async fetchApodData() {
        try {
            const response = await axios.get(this.apiEndpoint, {
                headers: {
                    'Authorization': `Bearer ${TOKEN}`
                }
            });
            return response.data;
        } catch (error) {
            console.error('Failed to retrieve APOD data', error);
            throw new Error('Failed to retrieve APOD data');
        }
    }
}
