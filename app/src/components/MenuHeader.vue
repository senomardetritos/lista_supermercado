<template>
	<div class="menu-header">
		<div class="btn-sair">
			<a href="#" @click="sair">Sair</a>
		</div>
		<div class="btn-menu">
			<a href="#" class="menu-icon" @click="showHideMenu">
				<i class="bi-list"></i>
			</a>
			<div class="menu" v-if="showMenu">
				<ul>
					<li>
						<a href="#" @click="cadastrar">
							<i class="bi-file-earmark-plus"></i>
							<span>Adicionar Lista</span>
						</a>
					</li>
					<li>
						<a href="#" @click="minhas_listas">
							<i class="bi-list-check"></i>
							<span>Minhas Listas</span>
						</a>
					</li>
					<li>
						<a href="#" @click="sair">
							<i class="bi-box-arrow-left"></i>
							<span>Sair</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { ref } from 'vue';
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();

	const showMenu = ref(false);

	async function cadastrar() {
		showMenu.value = false;
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

	function minhas_listas() {
		showMenu.value = false;
		router.push('/minhas-listas');
	}

	function sair() {
		showMenu.value = false;
		store.commit('setLogado', false);
	}

	function showHideMenu() {
		showMenu.value = !showMenu.value;
	}
</script>

<style scoped>
	.menu-header .btn-sair a,
	.menu-header .btn-menu a {
		color: var(--bg-dark);
	}

	.menu-header .btn-menu .menu-icon {
		display: none;
		font-size: 24px;
	}

	.menu-header .btn-menu {
		position: relative;
	}

	.menu-header .btn-menu .menu {
		position: absolute;
		top: 32px;
		right: -12px;
		min-width: 200px;
		padding: 8px 0px;
		background: white;
		border: 1px solid var(--border-light);
		box-shadow: 0px 0px 15px -10px #000;
		display: none;
	}

	.menu-header .btn-menu .menu li {
		list-style: none;
		padding: 4px 12px;
	}

	.menu-header .btn-menu .menu li * {
		padding: 4px;
		font-size: 14px;
	}

	@media (max-width: 1200px) {
		.menu-header .btn-sair a {
			display: none;
		}
		.menu-header .btn-menu .menu,
		.menu-header .btn-menu .menu-icon {
			display: block;
		}
	}
</style>
