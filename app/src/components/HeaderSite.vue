<template>
	<div class="header">
		<div class="logo">LS</div>
		<div class="menu">
			<a href="#" @click="sair">Sair</a>
		</div>
	</div>
</template>

<script setup>
	import { useStore } from 'vuex';

	const store = useStore();

	function sair() {
		store.commit('setLogado', false);
	}
</script>

<style scoped>
	.header {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 12px 24px;
		border-bottom: 1px solid #eee;
		max-height: 52px;
	}
	.header .logo {
		font-size: 24px;
		font-weight: 900;
	}
</style>
