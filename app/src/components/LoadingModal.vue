<template>
	<div class="loading">
		<h1>Carregando...</h1>
	</div>
</template>

<style scoped>
	.loading::before {
        content: '';
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100vw;
		height: 100vh;
		background-color: black;
        opacity: 0.3;
	}
	.loading {
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100vw;
		height: 100vh;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}
</style>
