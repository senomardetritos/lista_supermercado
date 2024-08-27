<template>
	<div class="container">
		<div class="card">
			<h1 class="title">Login</h1>
			<form @submit.prevent="logar">
				<div class="form-group">
					<div>
						Não tem uma conta?
						<RouterLink to="/cadastrar">Cadastre-se</RouterLink>
					</div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" v-model="dataForm.email" id="email" required />
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" v-model="dataForm.senha" id="senha" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Logar</button>
				</div>
				<div class="form-group" v-if="error">
					<div class="form-error">{{ error }}</div>
				</div>
				<div class="form-group">
					<RouterLink to="/recuperar">Esqueceu a senha?</RouterLink>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import { ref, reactive } from 'vue';
	import { RouterLink } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();

	const dataForm = reactive({
		email: 'senomar59@gmail.com',
		senha: '123',
	});

	const error = ref('');

	async function logar() {
		error.value = '';
		const res = await store.dispatch('login', dataForm);
		if (res.error) {
			error.value = res.error;
		} else {
			localStorage.id = res.id;
			localStorage.token = res.token;
			store.commit('setAlert', 'Logado com sucesso');
		}
	}
</script>
