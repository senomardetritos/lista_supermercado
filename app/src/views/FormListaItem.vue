<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">Item da Lista</h1>
			<div class="item" v-if="item && !editar">
				<div class="item-header">
					<h3>{{ item.nome }}</h3>
					<div>
						<div v-if="item.resolvido == 0" class="badge primary" @click="alterarPeguei">Pegar</div>
						<div v-if="item.resolvido == 1" class="badge yellow" @click="alterarPeguei">Já Peguei</div>
					</div>
				</div>
				<div class="footer-buttons">
					<button type="button" class="btn btn-primary" @click="setEditar">Editar Item</button>
					<button type="button" class="btn btn-danger" @click="excluir">Excluir</button>
					<button type="button" class="btn btn-secondary" @click="voltar">Voltar</button>
				</div>
			</div>
			<form @submit.prevent="salvar" v-else>
				<div class="form-group">
					<label for="nome">Item</label>
					<input type="nome" v-model="dataForm.nome" id="nome" required />
				</div>
				<div class="footer-buttons">
					<button type="submit" class="btn btn-primary">
						{{ item ? 'Editar Item' : 'Adicionar Item' }}
					</button>
					<button type="button" class="btn btn-secondary" v-if="item && editar" @click="cancelar">Cancelar</button>
					<button type="button" class="btn btn-secondary" @click="voltar">Lista</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import { reactive, computed, defineProps, onMounted } from 'vue';
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();
	const lista = computed(() => store.state.listaStore.lista);
	const item = computed(() => store.state.listaItemStore.item);
	const editar = computed(() => store.state.listaItemStore.editar);

	const dataForm = reactive({
		nome: '',
	});

	const props = defineProps({
		id: String,
	});

	onMounted(async () => {
		if (!lista.value.id) router.push('/minhas-listas');
		await store.dispatch('buscar_item', props.id);
		store.commit('setEditar', false);
	});

	async function salvar() {
		dataForm.id = props.id || null;
		dataForm.listas_id = lista.value.id;
		await store.dispatch('salvar_item', dataForm);
		await store.dispatch('buscar_item', props.id);
		if (!props.id) voltar();
	}

	function setEditar() {
		dataForm.nome = item.value.nome;
		store.commit('setEditar', true);
	}

	function cancelar() {
		store.commit('setEditar', false);
	}

	async function alterarPeguei() {
		store.dispatch('alterar_peguei', props.id);
	}

	function voltar() {
		router.push('/editar-lista/' + lista.value.id);
	}

	async function excluir() {
		store.commit('setConfirm', {
			titulo: 'Excluir Item',
			texto: `Deseja excluir ${item.value.nome}?`,
			continuar: async () => {
				await store.dispatch('excluir_item', props.id);
				voltar();
			},
		});
	}
</script>

<style scoped>
	.item .item-header {
		display: flex;
		justify-content: space-between;
	}
	.item .item-header .badge {
		padding: 4px 14px;
		border-radius: 12px;
		font-size: 12px;
		font-weight: 900;
	}
	.item .item-header .badge.primary {
		background: var(--bg-primary);
		color: white;
	}
	.item .item-header .badge.yellow {
		background: var(--bg-yellow);
		color: black;
	}
</style>
