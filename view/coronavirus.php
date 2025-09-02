<!-- Start - view/coronavirus.php !-->
<?php

require 'model/paginas_fixas.php';
require 'model/coronavirus.php';

$pagina_texto = '';

foreach( $paginas_fixas as $item ){
	
	if( $item['pagina'] == $_GET['pagina'] ){ 
		$pagina_link = $item['pagina']; 
		$pagina_titulo = $item['titulo']; 
		$pagina_texto = $item['texto']; 
	}
	
}

$hoje = date( 'Y-m-d H:i:s' );

$valor_confirmados = 0;
$valor_descartados = 0;
$valor_obitos = 0;
$valor_quarentena = 0;
$valor_uti = 0;
$valor_enfermaria = 0;
$data = data_tempo( $hoje );

foreach( $coronavirus_array as $covid ){
	
	if( $covid['confirmados'] != 0 ){ $valor_confirmados = $covid['confirmados']; }
	if( $covid['descartados'] != 0 ){ $valor_descartados = $covid['descartados']; }
	if( $covid['obitos'] != 0 ){ $valor_obitos = $covid['obitos']; }
	if( $covid['quarentena'] != 0 ){ $valor_quarentena = $covid['quarentena']; }
	if( $covid['uti'] != 0 ){ $valor_uti = $covid['uti']; }
	if( $covid['enfermaria'] != 0 ){ $valor_enfermaria = $covid['enfermaria']; }
	
	$data = data_tempo( $covid['data'] );
	
}

?>

<style><?php require 'css/coronavirus.css'; ?></style>

<section class="coronavirus">
	
	<div class="box">
	
		<div class="coronavirus-txt"><?php echo $pagina_texto ?></div>
		
		<div class="coronavirus-data">Última atualização: <?php echo $data ?></div>
	
		<div class="coronavirus-grid">
			
			<div class="coronavirus-linha">
				<div class="coronavirus-celula">
					<div class="coronavirus-item">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">add_circle</span></div>
						<div class="coronavirus-nome">Confirmados</div>
						<div class="coronavirus-valor"><?php echo $valor_confirmados ?></div>
					</div>
				</div>
				<div class="coronavirus-celula">
					<div class="coronavirus-item verde">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">accessibility_new</span></div>
						<div class="coronavirus-nome">Descartados</div>
						<div class="coronavirus-valor"><?php echo $valor_descartados ?></div>
					</div>
				</div>
				<div class="coronavirus-celula">
					<div class="coronavirus-item preto">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">stop_circle</span></div>
						<div class="coronavirus-nome">Óbitos</div>
						<div class="coronavirus-valor"><?php echo $valor_obitos ?></div>
					</div>
				</div>
			</div>
			
			<div class="coronavirus-linha">
				<div class="coronavirus-celula">
					<div class="coronavirus-item amarelo">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">hourglass_bottom</span></div>
						<div class="coronavirus-nome">Quarentena</div>
						<div class="coronavirus-valor"><?php echo $valor_quarentena ?></div>
					</div>
				</div>
				<div class="coronavirus-celula">
					<div class="coronavirus-item vermelho">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">coronavirus</span></div>
						<div class="coronavirus-nome">UTI</div>
						<div class="coronavirus-valor"><?php echo $valor_uti ?></div>
					</div>
				</div>
				<div class="coronavirus-celula">
					<div class="coronavirus-item laranja">
						<div class="coronavirus-icone"><span class="material-symbols-outlined">sick</span></div>
						<div class="coronavirus-nome">Enfermaria</div>
						<div class="coronavirus-valor"><?php echo $valor_enfermaria ?></div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/coronavirus.php !-->