import { createStore } from 'vuex';
import usuarioStore from './usuarioStore';

export default createStore({
	state: {
		loading: false,
	},
	getters: {},
	mutations: {
		setLoading(state, loading) {
			state.loading = loading;
		},
	},
	actions: {},
	modules: {
		usuarioStore,
	},
});
