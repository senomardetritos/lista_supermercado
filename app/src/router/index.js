import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import RecuperarSenha from '../views/RecuperarSenha.vue';
import CadastrarUsuario from '../views/CadastrarUsuario.vue';

const routes = [
	{ path: '/', name: 'login', component: LoginView },
	{ path: '/recuperar', name: 'recuperar', component: RecuperarSenha },
	{ path: '/cadastrar', name: 'cadastrar', component: CadastrarUsuario },
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

export default router;
