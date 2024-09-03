<template>
	<div class="container-sm">
		<div class="card">
			<h1 class="title">Cadastrar Usuário</h1>
			<form @submit.prevent="cadastrar">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" v-model="dataForm.email" id="email" placeholder="Email" required />
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" v-model="dataForm.senha" id="senha" placeholder="Senha" required />
				</div>
				<div class="form-group">
					<label for="senha2">Repetir Senha</label>
					<input type="password" v-model="dataForm.senha2" id="senha2" placeholder="Repetir Senha" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Cadastrar</button>
				</div>
				<div class="form-group" v-if="error">
					<div class="form-error">{{ error }}</div>
				</div>
				<div class="text-center">
					<RouterLink to="/">Voltar para Login</RouterLink>
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
		email: '',
		senha: '',
		senha2: '',
	});

	const error = ref('');

	async function cadastrar() {
		error.value = checkError();
		if (error.value) return;
		const res = await store.dispatch('cadastrar_usuario', dataForm);
		if (res.error) {
			error.value = res.error;
		} else {
			store.commit('setAlert', 'Usuário cadastrado com sucesso');
			router.push('/');
		}
	}

	function checkError() {
		if (dataForm.senha !== dataForm.senha2) {
			return 'Senha devem ser iguais';
		}
		return '';
	}
</script>
