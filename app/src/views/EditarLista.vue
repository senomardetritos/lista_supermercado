<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">{{ lista.created_at }}</h1>
			<div class="listas">
				<ul>
					<li v-for="(item, i) in lista.itens" :key="i" @click="editar(item.id)">
						<a href="#" :class="item.resolvido == 1 ? 'resolvido' : ''">
							<span v-if="item.nome">{{ item.nome }}</span>
							<span v-else>Sem nome</span>
						</a>
						<span v-if="item.preco">R$ {{ item.preco }}</span>
						<span v-else>R$ 0.00</span>
					</li>
					<hr />
					<li>
						<span>Total</span>
						<span>R$ {{ total }}</span>
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
	const total = computed(() => store.getters.getTotal);

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
		display: flex;
		justify-content: space-between;
		cursor: pointer;
	}
	.listas li a {
		display: block;
		color: var(--bg-dark);
	}
	.listas li a.resolvido {
		text-decoration: line-through;
	}
	.listas li span {
		font-size: 14px;
		font-weight: 700;
		padding: 4px 0px;
	}
</style>
