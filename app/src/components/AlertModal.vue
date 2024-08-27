<template>
	<div>
		<div class="alert"></div>
		<div class="alert-container">
			<div class="card">
				<h3>{{ store.state.alert }}</h3>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { onMounted } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();

	onMounted(() => {
		setTimeout(() => {
			store.commit('setAlert', '');
		}, 2000);
	});
</script>

<style scoped>
	.alert {
		content: '';
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100vw;
		height: 100vh;
		background-color: black;
		opacity: 0.3;
		z-index: 1;
	}
	.alert-container {
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100vw;
		height: 100vh;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		opacity: 1;
		z-index: 10;
	}
</style>
