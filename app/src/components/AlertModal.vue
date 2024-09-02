<template>
	<div>
		<div class="modal"></div>
		<div class="modal-container">
			<div class="container-sm">
				<div class="card">
					<h3 class="title">{{ store.state.alert }}</h3>
					<div class="footer-buttons">
						<button type="button" class="btn btn-primary" @click="fechar">Fechar</button>
					</div>
				</div>
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
