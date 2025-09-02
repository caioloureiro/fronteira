<!-- Start - view/google-icons-fix.php !-->
<?php
/**
 * Componente para carregamento otimizado dos Material Symbols Outlined.
 * Evita a exibição temporária de texto bruto (ex: "arrow_downward") antes do ícone carregar.
 */
?>
<!-- Pré-carrega a fonte do Material Symbols Outlined -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</noscript>
<style>
	.material-symbols-outlined {
		visibility: hidden;
		font-size: 0;
	}
	.material-symbols-outlined.loaded {
		visibility: visible;
		font-size: 24px; /* Ajuste conforme necessário */
		font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; /* Configurações padrão */
	}
</style>
<script>
	document.fonts.ready.then(() => {
		document.querySelectorAll('.material-symbols-outlined').forEach(icon => {
			icon.classList.add('loaded');
		});
	});
</script>
<!-- End - view/google-icons-fix.php !-->