<template>
	<div class="container-sm">
		<div class="card">
			<h1 class="title">Recuperar Senha</h1>
			<form @submit.prevent="enviar_recuperar">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" v-model="dataForm.email" id="email" required />
				</div>
				<div class="form-group" v-if="showCodigo">
					<label for="codigo">Código</label>
					<input type="codigo" v-model="dataForm.codigo" id="codigo" required />
				</div>
				<div class="form-group" v-if="showCodigo">
					<label for="senha">Nova Senha</label>
					<input type="password" v-model="dataForm.senha" id="senha" required />
				</div>
				<div class="form-group" v-if="showCodigo">
					<button type="button" class="btn btn-primary" @click="recuperar">Alterar Senha</button>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" @click="reenviar" v-if="showCodigo">Reenviar Email</button>
					<button type="submit" class="btn btn-primary" v-else>Enviar Email</button>
				</div>
				<div class="form-group" v-if="error">
					<div class="form-error">{{ error }}</div>
				</div>
				<div class="form-group">
					<RouterLink to="/">Voltar para login</RouterLink>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import { ref, reactive } from 'vue';
	import { RouterLink, useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();
	const dataForm = reactive({
		email: 'senomar59@gmail.com',
	});

	const error = ref('');
	const showCodigo = ref(false);

	async function enviar_recuperar() {
		error.value = '';
		const res = await store.dispatch('enviar_recuperar', dataForm);
		if (res.error) {
			error.value = res.error;
		} else {
			dataForm.codigo = '';
			dataForm.senha = '';
			showCodigo.value = true;
			store.commit('setAlert', 'Email enviado com sucesso!');
		}
	}

	async function recuperar() {
		error.value = '';
		const res = await store.dispatch('recuperar', dataForm);
		if (res.error) {
			error.value = res.error;
		} else {
			store.commit('setAlert', 'Senha alterada com sucesso!');
			router.push('/');
		}
	}

	function reenviar() {
		showCodigo.value = false;
		enviar_recuperar();
	}
</script>
