import { createStore } from 'vuex';
import usuarioStore from './usuarioStore';

export default createStore({
	state: {
		loading: false,
		alert: '',
	},
	getters: {},
	mutations: {
		setLoading(state, loading) {
			state.loading = loading;
		},
		setAlert(state, alert) {
			state.alert = alert;
		},
	},
	actions: {},
	modules: {
		usuarioStore,
	},
});
