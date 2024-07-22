import axios from 'axios';
const TOKEN = localStorage.getItem('authToken')

export default class EpicService {
    constructor(day, month, year) {
        this.apiEndpoint = '/api/epic';
        this.day = day;
        this.month = month;
        this.year = year;
    }

    async fetchEpicData() {
        try {
            const response = await axios.get(
                `${this.apiEndpoint}?day=${this.day}&month=${this.month}&year=${this.year}`, {
                headers: {
                    'Authorization': `Bearer ${TOKEN}`
                }
            });
            return response.data;
        } catch (error) {
            console.error('Failed to retrieve Epic data', error);
            throw new Error('Failed to retrieve Epic data');
        }
    }
}
