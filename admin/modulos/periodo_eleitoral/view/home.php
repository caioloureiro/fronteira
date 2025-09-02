<!-- Start - admin/modulos/periodo_eleitoral/wiew/home.php !-->
<?php 
require $raiz_site .'model/periodo_eleitoral.php'; 

$ativado = 0;

foreach( $periodo_eleitoral_array as $item ){
	
	$ativado = $item['ativado'];
	
}

$tema = 'claro';

if( $ativado == 1 ){ $tema = 'escuro'; }

?>

<style>
	<?php 
		require 'css/switch-btn.css'; 
		require 'css/card.css'; 
	?>
</style>

<div class="conteudo periodo_eleitoral">
	
	<div class="titulo">Período Eleitoral</div>
	
	<div class="conteudo-tabela-janela">
		
		<?php
		
			if( $ativado == 1 ){
				echo'<div class="comentario">Período Eleitoral ativado.</div>';
			}
			
		?>

		<div class="card-auto">
			
			<div class="card-auto-item">
			
				<div class="col80">
					<div class="card-auto-item-titulo">Período Eleitoral</div>
				</div>
				
				<div class="col10">
					<a href="modulos/periodo_eleitoral/controller/editar.php?status_atual=<?php echo $ativado ?>">
						<div class="switch-btn-<?php echo $tema ?>"><span></span></div>
					</a>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>
<!-- End - admin/modulos/periodo_eleitoral/wiew/home.php !-->