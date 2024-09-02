<template>
	<div>
		<div class="modal"></div>
		<div class="modal-container">
			<div class="card">
				<h3>{{ store.state.confirm.titulo }}</h3>
				<h5>{{ store.state.confirm.texto }}</h5>
				<button type="button" class="btn btn-primary" @click="continuar">Continuar</button>
				<button type="button" class="btn btn-secondary" @click="fechar">Fechar</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { useStore } from 'vuex';

	const store = useStore();

	function fechar() {
		store.commit('setConfirm', null);
	}

	function continuar() {
		store.commit('setConfirm', null);
		store.state.confirm.continuar();
	}
</script>
