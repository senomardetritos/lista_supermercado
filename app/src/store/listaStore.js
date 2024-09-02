import { api } from '../helpers/api';

export default {
	state: {
		listas: [],
		lista: {},
		page: 0,
		limit: 3,
		completed: false,
	},
	getters: {},
	mutations: {
		resetListas(state) {
			state.listas = [];
			state.page = 0;
			state.completed = false;
		},
		addListas(state, data) {
			if (data) {
				if (Array.isArray(data)) {
					state.listas = [...state.listas, ...data];
				} else {
					state.listas.push(data);
				}
				state.page += state.limit;
			} else {
				state.completed = true;
			}
		},
		setLista(state, data) {
			state.lista = data;
		},
	},
	actions: {
		async cadastrar_lista({ commit }) {
			commit('setLoading', true);
			const res = await api.post('listas/cadastrar-lista');
			commit('setLoading', false);
			return res.data;
		},
		async buscar_listas({ commit, state }) {
			commit('setLoading', true);
			const res = await api.post(`listas/listas/${state.page}/${state.limit}`);
			commit('addListas', res.data);
			commit('setLoading', false);
		},
		async busca_lista({ commit }, id) {
			commit('setLoading', true);
			const res = await api.post(`listas/lista/${id}`);
			if (!Array.isArray(res.data.itens)) {
				res.data.itens = [res.data.itens];
			}
			commit('setLista', res.data);
			commit('setLoading', false);
		},
	},
};
