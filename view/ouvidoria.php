<!-- Start - view/ouvidoria.php !-->
<style>
	<?php 
		require 'css/ouvidoria.css'; 
		require 'css/formularios.css'; 
	?>
</style>

<section class="ouvidoria">
	
	<div class="box">
		
		<?= $pagina['texto'] ?>
		
		<div class="ouvidoria-itens">
			
			<div class="col40">
			
				<?php require 'view/acesso-protocolo.php'; ?>
				
			</div>
			<div class="col60">
			
				<?php require 'view/formulario-ouvidoria.php'; ?>
				
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/ouvidoria.php !-->