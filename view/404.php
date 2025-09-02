<!-- Start - view/404.php !-->
<style><?php require 'css/conteudo.css'; ?></style>

<section class="conteudo">
	
	<div class="box">
	
		<style><?php require 'css/conteudo-titulo.css'; ?></style>

		<section class="conteudo-titulo">
			
			<div class="box">
				
				<div class="conteudo-titulo-campo">Erro 404</div>
				
			</div>
			
		</section>
		
		<div class="separador"></div>
		
		<p>Ops... Este endereço está errado:</p>
		
		<div class="separador"></div>
		
		<p>
			<?php 
				$actual_link = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
				echo $actual_link; 
			?>
		</p>
		
	</div>
	
</section>
<!-- End - view/404.php !-->