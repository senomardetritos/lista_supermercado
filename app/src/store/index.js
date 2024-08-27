import { createStore } from 'vuex';
import usuarioStore from './usuarioStore';

export default createStore({
	state: {
		loading: false,
		alert: '',
		logado: false,
	},
	getters: {},
	mutations: {
		setLoading(state, loading) {
			state.loading = loading;
		},
		setAlert(state, alert) {
			state.alert = alert;
		},
		setLogado(state, logado) {
			state.logado = logado;
		},
	},
	actions: {},
	modules: {
		usuarioStore,
	},
});
