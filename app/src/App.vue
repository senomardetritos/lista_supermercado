<template>
	<div>
		<HeaderSite v-if="store.state.logado" />
		<MenuSide v-if="store.state.logado" />
		<router-view />
		<LoadingModal v-if="store.state.loading" />
		<AlertModal v-if="store.state.alert" />
	</div>
</template>

<script setup>
	import { onMounted } from 'vue';
	import { useStore } from 'vuex';
	import HeaderSite from './components/HeaderSite.vue';
	import MenuSide from './components/MenuSide.vue';
	import LoadingModal from './components/LoadingModal.vue';
	import AlertModal from './components/AlertModal.vue';

	const store = useStore();

	onMounted(() => {
		store.commit('setLogado', localStorage.token);
	});
</script>
