<template>
	<div>
		<router-view />
		<LoadingModal v-if="store.state.loading" />
	</div>
</template>

<script setup>
	import { useStore } from 'vuex';
	import LoadingModal from './components/LoadingModal.vue';

	const store = useStore();
</script>
