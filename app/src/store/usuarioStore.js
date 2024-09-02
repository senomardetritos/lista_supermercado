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
		async enviar_recuperar({ commit }, data) {
			commit('setLoading', true);
			const res = await api.post('usuarios/enviar-recuperar', data);
			commit('setLoading', false);
			return res.data;
		},
		async recuperar({ commit }, data) {
			commit('setLoading', true);
			const res = await api.post('usuarios/recuperar', data);
			commit('setLoading', false);
			return res.data;
		},
		async cadastrar_usuario({ commit }, data) {
			commit('setLoading', true);
			const res = await api.post('usuarios/cadastrar-usuario', data);
			commit('setLoading', false);
			return res.data;
		},
	},
};
