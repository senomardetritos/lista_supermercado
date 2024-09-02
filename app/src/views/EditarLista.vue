<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">Lista {{ lista.created_at }}</h1>
			<div class="listas">
				<ul>
					<li v-for="(item, i) in lista.itens" :key="i">
						<a href="#" @click="editar(item.id)">
							{{ item.nome }}
						</a>
					</li>
				</ul>
			</div>
			<div class="footer-buttons">
				<button type="button" class="btn btn-primary" @click="adicionar">Adicionar Item</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { computed, defineProps, onMounted, watch } from 'vue';
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();
	const lista = computed(() => store.state.listaStore.lista);

	const props = defineProps({
		id: String,
	});

	watch(
		() => props.id,
		() => {
			store.dispatch('busca_lista', props.id);
		}
	);

	onMounted(() => {
		store.dispatch('busca_lista', props.id);
	});

	function adicionar() {
		router.push('/item-lista');
	}

	function editar(id) {
		router.push('/item-lista/' + id);
	}
</script>

<style scoped>
	.listas li {
		list-style: none;
	}
</style>
