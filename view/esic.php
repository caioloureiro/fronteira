<!-- Start - view/esic.php !-->
<style>
	<?php 
		require 'css/esic.css'; 
		require 'css/formularios.css'; 
	?>
</style>

<section class="esic">
	
	<div class="box">
		
		<?= $pagina['texto'] ?>
		
		<div class="esic-itens">
			
			<div class="col40">
			
				<?php require 'view/acesso-protocolo.php'; ?>
				
			</div>
			<div class="col60">
			
				<?php require 'view/formulario-esic.php'; ?>
				
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/esic.php !-->