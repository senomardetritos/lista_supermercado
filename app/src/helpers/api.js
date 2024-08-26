import axios from 'axios';

export const api = axios.create({
	baseURL: process.env.VUE_APP_URL,
	headers: {
		'Access-Control-Allow-Origin': '*',
		'Content-Type': 'application/json',
	},
});

api.defaults.headers.Authorization = 'Bearer ' + localStorage.id + '_' + localStorage.token;
