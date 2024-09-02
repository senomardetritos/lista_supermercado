import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import RecuperarSenha from '../views/RecuperarSenha.vue';
import CadastrarUsuario from '../views/CadastrarUsuario.vue';
import MinhasListas from '../views/MinhasListas.vue';
import EditarLista from '../views/EditarLista.vue';
import FormListaItem from '../views/FormListaItem.vue';

const routes = [
	{ path: '/', name: 'login', component: LoginView },
	{ path: '/recuperar', name: 'recuperar', component: RecuperarSenha },
	{ path: '/cadastrar', name: 'cadastrar', component: CadastrarUsuario },
	{ path: '/minhas-listas', name: 'minhaslistas', component: MinhasListas, meta: { auth: true } },
	{ path: '/editar-lista/:id', name: 'editarlista', component: EditarLista, props: true, meta: { auth: true } },
	{ path: '/item-lista', name: 'novoitemlista', component: FormListaItem, props: true, meta: { auth: true } },
	{ path: '/item-lista/:id', name: 'editaritemlista', component: FormListaItem, props: true, meta: { auth: true } },
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

router.beforeEach(async (to) => {
	const logado = localStorage.token;
	if (!logado && to.meta.auth && to.name !== 'login') {
		return { name: 'login' };
	}
	if (logado && !to.meta.auth && to.name !== 'minhaslistas') {
		return { name: 'minhaslistas' };
	}
});

export default router;
