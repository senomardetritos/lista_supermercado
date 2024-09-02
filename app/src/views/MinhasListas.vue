<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">Minhas Listas</h1>
			<div class="listas">
				<ul>
					<li v-for="(item, i) in listas" :key="i">
						<a href="#" @click="editar(item.id)">
							{{ item.created_at }}
						</a>
						<span>{{ item.qtd }} Itens</span>
					</li>
				</ul>
			</div>
			<div class="text-center">
				<a href="#" @click="carregar_mais" v-if="!completed">Carregar mais</a>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { computed, onMounted } from 'vue';
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();
	const listas = computed(() => store.state.listaStore.listas);
	const completed = computed(() => store.state.listaStore.completed);

	onMounted(() => {
		store.commit('resetListas');
		store.dispatch('buscar_listas');
	});

	function carregar_mais() {
		store.dispatch('buscar_listas');
	}

	function editar(id) {
		router.push('/editar-lista/' + id);
	}
</script>

<style scoped>
	.listas {
		padding: 12px 0px;
	}
	.listas li {
		list-style: none;
		display: flex;
		justify-content: space-between;
	}
	.listas li a {
		color: var(--bg-dark);
	}
</style>
