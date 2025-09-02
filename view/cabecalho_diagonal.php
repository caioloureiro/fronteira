<!-- Start - view/cabecalho.php !-->
<style><?php require 'css/cabecalho.css'; ?></style>

<nav class="cabecalho">

	<div class="cabecalho-logo-box">
		<a href="./"><div class="cabecalho-logo"></div></a>
	</div>
	
	<div class="cabecalho-dir">

		<?php 
			require 'view/topo.php'; 
			require 'view/acessibilidade.php'; 
			require 'view/menu.php'; 
		?>
		
	</div>

</nav>

<?php require 'view/menu-mobile.php'; ?>
<!-- End - view/cabecalho.php !-->