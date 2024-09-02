<template>
	<div>
		<div class="modal"></div>
		<div class="modal-container">
			<div class="card">
				<h3>{{ store.state.alert }}</h3>
				<button type="button" class="btn btn-primary" @click="fechar">Fechar</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { ref, onMounted } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();
	const interval = ref(null);

	onMounted(() => {
		interval.value = setTimeout(() => {
			store.commit('setAlert', '');
		}, 3000);
	});

	function fechar() {
		store.commit('setAlert', '');
		clearInterval(interval.value);
	}
</script>
