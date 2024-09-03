<template>
	<div class="container-sm">
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
					<input type="email" v-model="dataForm.email" id="email" placeholder="Email" required />
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" v-model="dataForm.senha" id="senha" placeholder="Senha" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Logar</button>
				</div>
				<div class="form-group" v-if="error">
					<div class="form-error">{{ error }}</div>
				</div>
				<div class="text-center">
					<RouterLink to="/recuperar">Esqueceu a senha?</RouterLink>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import { ref, reactive } from 'vue';
	import { RouterLink, useRouter } from 'vue-router';
	import { useStore } from 'vuex';
	import { updateBearer } from '../helpers/api';

	const store = useStore();
	const router = useRouter();

	const dataForm = reactive({
		email: '',
		senha: '',
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
			store.commit('setLogado', localStorage.token);
			store.commit('setAlert', 'Logado com sucesso');
			updateBearer();
			router.push('minhas-listas');
		}
	}
</script>
