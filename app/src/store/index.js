import { createStore } from 'vuex';
import { updateBearer } from '../helpers/api';
import usuarioStore from './usuarioStore';
import listaStore from './listaStore';
import listaItemStore from './listaItemStore';

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
			if (!logado) {
				delete localStorage.id;
				delete localStorage.token;
				updateBearer();
			}
		},
	},
	actions: {},
	modules: {
		usuarioStore,
		listaStore,
		listaItemStore,
	},
});
