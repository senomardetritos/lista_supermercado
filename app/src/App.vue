<template>
	<div>
		<router-view />
		<LoadingModal v-if="store.state.loading" />
		<AlertModal v-if="store.state.alert" />
	</div>
</template>

<script setup>
	import { useStore } from 'vuex';
	import LoadingModal from './components/LoadingModal.vue';
	import AlertModal from './components/AlertModal.vue';

	const store = useStore();
</script>
