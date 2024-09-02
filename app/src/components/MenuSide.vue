<template>
	<div class="menu-side">
		<ul>
			<li>
				<a href="#" @click="cadastrar">Adicionar Lista</a>
			</li>
			<li>
				<RouterLink to="/minhas-listas">Minhas Listas</RouterLink>
			</li>
			<li>
				<a href="#" @click="sair">Sair</a>
			</li>
		</ul>
	</div>
</template>

<script setup>
	import { RouterLink } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();

	async function cadastrar() {
		const res = await store.dispatch('cadastrar_lista');
		if (res.error) {
			store.commit('setAlert', res.error);
		} else {
			store.commit('setAlert', 'Usuário cadastrado com sucesso');
		}
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
	}

	.menu-side li {
		list-style: none;
	}

	.menu-side li a {
		display: block;
		padding: 8px 0px;
	}
</style>
