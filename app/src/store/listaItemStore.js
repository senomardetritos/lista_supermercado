import { api } from '../helpers/api';

export default {
	state: {
		item: {},
		editar: false,
	},
	getters: {},
	mutations: {
		setItem(state, data) {
			state.item = data;
		},
		setEditar(state, data) {
			state.editar = data;
		},
	},
	actions: {
		async salvar_item({ commit }, data) {
			commit('setLoading', true);
			const res = await api.post('listas-itens/salvar-item/', data);
			commit('setLoading', false);
			return res.data;
		},
		async buscar_item({ commit }, $id) {
			commit('setLoading', true);
			const res = await api.post(`listas-itens/lista-item/${$id}`);
			commit('setItem', res.data);
			commit('setLoading', false);
			commit('setEditar', false);
			return res.data;
		},
		async alterar_peguei({ dispatch, commit }, $id) {
			commit('setLoading', true);
			const res = await api.post(`listas-itens/alterar-peguei/${$id}`);
			await dispatch('buscar_item', $id);
			commit('setLoading', false);
			return res.data;
		},
		async excluir_item({ commit }, $id) {
			commit('setLoading', true);
			const res = await api.post(`listas-itens/excluir-item/${$id}`);
			commit('setLoading', false);
			return res.data;
		},
	},
};
