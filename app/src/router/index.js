import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import RecuperarSenha from '../views/RecuperarSenha.vue';
import CadastrarUsuario from '../views/CadastrarUsuario.vue';

const routes = [
	{ path: '/', name: 'home', component: HomeView },
	{ path: '/recuperar', name: 'recuperar', component: RecuperarSenha },
	{ path: '/cadastrar', name: 'cadastrar', component: CadastrarUsuario },
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

export default router;
