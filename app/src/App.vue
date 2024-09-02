<template>
	<div>
		<HeaderSite v-if="store.state.logado" />
		<MenuSide v-if="store.state.logado" />
		<router-view />
		<LoadingModal v-if="store.state.loading" />
		<AlertModal v-if="store.state.alert" />
		<ConfirmModal v-if="store.state.confirm" />
	</div>
</template>

<script setup>
	import { onMounted } from 'vue';
	import { useStore } from 'vuex';
	import HeaderSite from './components/HeaderSite.vue';
	import MenuSide from './components/MenuSide.vue';
	import LoadingModal from './components/LoadingModal.vue';
	import AlertModal from './components/AlertModal.vue';
	import ConfirmModal from './components/ConfirmModal.vue';

	const store = useStore();

	onMounted(() => {
		store.commit('setLogado', localStorage.token);
	});
</script>
