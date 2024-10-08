<template>
	<div class="container-md">
		<div class="card">
			<h1 class="title">Item da Lista</h1>
			<div class="item" v-if="item && !editar">
				<div class="item-header">
					<h5>{{ item.nome }}</h5>
					<h5 v-if="item.quantidade">{{ item.quantidade }}</h5>
					<h5 v-else>1</h5>
					<h5 v-if="item.preco">R$ {{ item.preco }}</h5>
					<h5 v-else>R$ 0.00</h5>
					<h5 v-if="item.preco">R$ {{ parseInt(item.quantidade) * parseFloat(item.preco) }}</h5>
					<h5 v-else>R$ 0.00</h5>
				</div>
				<div class="footer-buttons">
					<button type="button" v-if="item.resolvido == 0" class="btn btn-primary" @click="alterarPeguei">Pegar</button>
					<button type="button" v-if="item.resolvido == 1" class="btn btn-danger" @click="alterarPeguei">Devolver</button>
					<button type="button" class="btn btn-primary" @click="setEditar">Editar Item</button>
					<button type="button" class="btn btn-danger" @click="excluir">Excluir</button>
					<button type="button" class="btn btn-secondary" @click="voltar">Voltar</button>
				</div>
			</div>
			<form @submit.prevent="salvar" v-else>
				<div class="form-group">
					<label for="nome">Item</label>
					<input type="nome" v-model="dataForm.nome" id="nome" placeholder="Item" required />
				</div>
				<div class="form-group" v-if="item">
					<label for="quantidade">Quantidade</label>
					<input type="number" v-model="dataForm.quantidade" id="quantidade" placeholder="Quantidade" required step="1" min="1" />
				</div>
				<div class="form-group" v-if="item">
					<label for="preco">Preço</label>
					<input type="number" v-model="dataForm.preco" id="preco" placeholder="Preço" required step="0.01" />
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
		quantidade: 1,
		preco: 0,
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
		const res = await store.dispatch('salvar_item', dataForm);
		if (res.error) {
			store.commit('setAlert', res.error);
		} else {
			await store.dispatch('buscar_item', props.id);
			if (!props.id) voltar();
		}
	}

	function setEditar() {
		dataForm.nome = item.value.nome;
		dataForm.quantidade = item.value.quantidade;
		dataForm.preco = item.value.preco;
		store.commit('setEditar', true);
	}

	function cancelar() {
		store.commit('setEditar', false);
	}

	async function alterarPeguei() {
		await store.dispatch('alterar_peguei', props.id);
		if (item.value.resolvido == 1) setEditar();
		else {
			dataForm.nome = item.value.nome;
			dataForm.quantidade = 0;
			dataForm.preco = 0;
			salvar();
		}
	}

	function voltar() {
		router.push('/editar-lista/' + lista.value.id);
	}

	async function excluir() {
		store.commit('setConfirm', {
			titulo: 'Excluir Item',
			texto: `Deseja excluir ${item.value.nome}?`,
			continuar: async () => {
				const res = await store.dispatch('excluir_item', props.id);
				if (res.error) {
					store.commit('setAlert', res.error);
				} else {
					voltar();
				}
			},
		});
	}
</script>

<style scoped>
	.item .item-header {
		display: flex;
		justify-content: space-between;
	}
</style>
