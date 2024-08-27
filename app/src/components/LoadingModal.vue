<template>
	<div>
		<div class="loading"></div>
		<div class="loading-container">
			<h1>Carregando...</h1>
		</div>
	</div>
</template>

<style scoped>
	.loading {
		content: '';
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100vw;
		height: 100vh;
		background-color: black;
		opacity: 0.3;
	}
	.loading-container {
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
