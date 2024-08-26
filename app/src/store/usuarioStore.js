import { api } from '../helpers/api';

export default {
	state: {},
	getters: {},
	mutations: {},
	actions: {
		async login({ commit }, data) {
			commit('setLoading', true);
			const res = await api.post('usuarios/login', data);
			commit('setLoading', false);
			return res.data;
		},
	},
};
