<template>
	<div>
		<div class="modal"></div>
		<div class="modal-container">
			<div class="container-sm">
				<div class="card">
					<h3 class="title">{{ store.state.confirm.titulo }}</h3>
					<h5>{{ store.state.confirm.texto }}</h5>
					<div class="footer-buttons">
						<button type="button" class="btn btn-primary" @click="continuar">Continuar</button>
						<button type="button" class="btn btn-secondary" @click="fechar">Fechar</button>
					</div>
				</div>
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
		store.state.confirm.continuar();
		store.commit('setConfirm', null);
	}
</script>
