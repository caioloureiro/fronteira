<!-- Start - view/erro_404.php !-->
<section class="conteudo erro_404" title="erro_404">

	<div class="titulo">Erro 404</div>
	
	<p>
		<?php 
			$actual_link = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
			echo $actual_link; 
		?>
	</p>
	
	<p>Ops... Esse endereço está errado.</p>
	
</section>
<!-- End - view/erro_404.php !-->