import axios from 'axios';

export default class ApodService {
    constructor() {
        this.apiEndpoint = '/api/apod';
    }

    async fetchApodData() {
        try {
            const response = await axios.get(this.apiEndpoint);
            return response.data;
        } catch (error) {
            console.error('Failed to retrieve APOD data', error);
            throw new Error('Failed to retrieve APOD data');
        }
    }
}
