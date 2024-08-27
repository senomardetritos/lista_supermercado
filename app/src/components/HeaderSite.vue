<template>
	<div class="header">
		<div class="logo">LS</div>
		<div class="menu">
			<a href="#" @click="sair">Sair</a>
		</div>
	</div>
</template>

<script setup>
	import { useRouter } from 'vue-router';
	import { useStore } from 'vuex';

	const store = useStore();
	const router = useRouter();

	function sair() {
		delete localStorage.id;
		delete localStorage.token;
		store.commit('setLogado', false);
		router.push('/');
	}
</script>

<style scoped>
	.header {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 12px 24px;
	}
</style>
