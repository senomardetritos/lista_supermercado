<template>
	<div class="container-md">
		<div class="card">
			<div class="header">
				<div>
					<h4>{{ dateToHtml(lista.created_at) }}</h4>
					<span>{{ timeToHtml(lista.created_at) }}</span>
				</div>
				<div class="right">
					<span>Total</span>
					<h4>R$ {{ total }}</h4>
				</div>
			</div>
			<div class="listas">
				<ul v-if="lista.itens && lista.itens.length > 0">
					<li v-for="(item, i) in lista.itens" :key="i" @click="editar(item.id)">
						<a href="#" :class="item.resolvido == 1 ? 'resolvido' : ''">
							<span v-if="item.nome">{{ item.nome }}</span>
							<span v-else>Sem nome</span>
						</a>
						<span v-if="item.preco">R$ {{ item.preco }}</span>
						<span v-else>R$ 0.00</span>
					</li>
				</ul>
				<ul v-else>
					<li>Nenhum item adicionado</li>
				</ul>
			</div>
			<div class="footer-buttons">
				<button type="button" class="btn btn-primary" @click="adicionar">Novo Item</button>
				<button type="button" class="btn btn-danger" @click="excluir">Excluir</button>
				<button type="button" class="btn btn-secondary" @click="voltar">Listas</button>
				<button type="button" class="btn btn-primary" @click="voltar">Por Email</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { computed, defineProps, onMounted, watch } from 'vue';
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';
	import { dateToHtml, timeToHtml } from '../helpers/date';

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

	function excluir() {
		store.commit('setConfirm', {
			titulo: 'Excluir Lista',
			texto: `Deseja excluir ${dateToHtml(lista.value.created_at)} das ${timeToHtml(lista.value.created_at)}?`,
			continuar: async () => {
				const res = await store.dispatch('excluir_lista', lista.value.id);
				if (res.error) {
					store.commit('setAlert', res.error);
				} else {
					voltar();
				}
			},
		});
	}

	function voltar() {
		router.push('/minhas-listas');
	}
</script>

<style scoped>
	.header {
		display: flex;
		justify-content: space-between;
		border-bottom: 1px solid var(--border-light);
		padding-bottom: 8px;
		margin-bottom: 8px;
	}

	.header .right {
		display: flex;
		flex-direction: column;
		align-items: flex-end;
	}

	.header span {
		font-size: 12px;
		font-weight: 600;
	}

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
