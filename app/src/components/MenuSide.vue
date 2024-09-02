<template>
	<div class="menu-side">
		<ul>
			<li>
				<a href="#" @click="cadastrar">
					<i class="bi-file-earmark-plus"></i>
					<span>Adicionar Lista</span>
				</a>
			</li>
			<li>
				<RouterLink to="/minhas-listas">
					<i class="bi-list-check"></i>
					<span>Minhas Listas</span>
				</RouterLink>
			</li>
			<li>
				<a href="#" @click="sair">
					<i class="bi-box-arrow-left"></i>
					<span>Sair</span>
				</a>
			</li>
		</ul>
	</div>
</template>

<script setup>
	import { useRouter, RouterLink } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();

	async function cadastrar() {
		store.commit('setConfirm', {
			titulo: 'Adicionar Lista',
			texto: 'Adicionar uma nova lista?',
			continuar: async () => {
				const res = await store.dispatch('cadastrar_lista');
				if (res.error) {
					store.commit('setAlert', res.error);
				} else {
					router.push(`/editar-lista/${res}`);
					store.commit('setAlert', 'Lista Cadastrada com sucesso!');
				}
			},
		});
	}

	function sair() {
		store.commit('setLogado', false);
	}
</script>

<style scoped>
	.menu-side {
		position: fixed;
		top: 52px;
		left: 0px;
		padding: 24px;
		width: 300px;
		height: calc(100vw - 52px);
		border-right: 1px solid #eee;
		display: none;
	}

	.menu-side li {
		list-style: none;
	}

	.menu-side li i,
	.menu-side li span {
		display: block;
		padding: 8px;
		color: var(--bg-dark);
	}

	.menu-side li a {
		display: flex;
		align-items: center;
		justify-content: flex-start;
		color: var(--bg-dark);
	}

	@media (min-width: 800px) {
		.menu-side {
			display: block;
		}
	}

	@media (max-width: 1200px) {
		.menu-side {
			padding: 12px;
			width: 60px;
		}
		.menu-side li a span {
			display: none;
		}
	}
</style>
