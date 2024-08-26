<template>
	<div class="home">
		<div class="card">
			<h1>Login</h1>
			<div v-if="store.state.loading">Carregango...</div>
			<form @submit.prevent="logar" v-else>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" v-model="dataForm.email" id="email" required />
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" v-model="dataForm.senha" id="senha" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn-primary">Logar</button>
				</div>
				<div class="form-group" v-if="error">
					<div class="form-error" >{{ error }}</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script setup>
	import { ref, reactive } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();

	const dataForm = reactive({
		email: 'teste@teste',
		senha: '123',
	});

	const error = ref('');

	async function logar() {
		const res = await store.dispatch('login', dataForm);
		if (res.error) {
			error.value = res.error;
		}
	}
</script>
