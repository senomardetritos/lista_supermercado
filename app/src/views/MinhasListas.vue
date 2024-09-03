<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">Minhas Listas</h1>
			<div class="listas">
				<ul>
					<li v-for="(item, i) in listas" :key="i" @click="editar(item.id)">
						<div>
							<h4>{{ dateToHtml(item.created_at) }}</h4>
							<span>{{ timeToHtml(item.created_at) }}</span>
						</div>
						<div class="right">
							<h4 v-if="item.total">R$ {{ item.total }}</h4>
							<h4 v-else>R$ 0.00</h4>
							<span>{{ item.qtd }} Itens</span>
						</div>
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
	import { dateToHtml, timeToHtml } from '../helpers/date';

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
		padding: 0px 0px;
		margin-bottom: 16px;
	}
	.listas li {
		list-style: none;
		display: flex;
		justify-content: space-between;
		padding: 8px 0px;
		cursor: pointer;
		border-bottom: 1px solid var(--border-light);
	}
	.listas li a {
		color: var(--bg-dark);
	}
	.listas .right {
		display: flex;
		flex-direction: column;
		align-items: flex-end;
	}
	.listas span {
		font-size: 12px;
		font-weight: 600;
	}
</style>
