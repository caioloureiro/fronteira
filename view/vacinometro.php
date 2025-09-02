<!-- Start - view/vacinometro.php !-->
<?php

require 'model/paginas_fixas.php';
require 'model/vacinometro.php';

$pagina_texto = '';

foreach( $paginas_fixas as $pag ){
	
	if( $pag['pagina'] == $_GET['pagina'] ){ 
		$pagina_link = $pag['pagina']; 
		$pagina_titulo = $pag['titulo']; 
		$pagina_texto = $pag['texto']; 
	}
	
}

$hoje = date( 'Y-m-d H:i:s' );

$primeira_dose = 0;
$segunda_dose = 0;
$terceira_dose = 0;
$quarta_dose = 0;

$data = data_tempo( $hoje );

foreach( $vacinometro_array as $item ){
	
	if( $item['1_dose'] != 0 ){ $primeira_dose = $item['1_dose']; }
	if( $item['2_dose'] != 0 ){ $segunda_dose = $item['2_dose']; }
	if( $item['3_dose'] != 0 ){ $terceira_dose = $item['3_dose']; }
	if( $item['4_dose'] != 0 ){ $quarta_dose = $item['4_dose']; }
	
	$data = data_tempo( $item['data'] );
	
}

?>

<style><?php require 'css/vacinometro.css'; ?></style>

<section class="vacinometro">
	
	<div class="box">
	
		<div class="vacinometro-txt"><?php echo $pagina_texto ?></div>
		
		<div class="vacinometro-data">Última atualização: <?php echo $data ?></div>
	
		<div class="vacinometro-grid">
			
			<div class="vacinometro-linha">
				<div class="vacinometro-celula">
					<div class="vacinometro-item">
						<div class="vacinometro-icone"><span class="material-symbols-outlined">vaccines</span></div>
						<div class="vacinometro-nome">1ª dose</div>
						<div class="vacinometro-valor"><?php echo $primeira_dose ?></div>
					</div>
				</div>
				<div class="vacinometro-celula">
					<div class="vacinometro-item">
						<div class="vacinometro-icone"><span class="material-symbols-outlined">vaccines</span></div>
						<div class="vacinometro-nome">2ª dose</div>
						<div class="vacinometro-valor"><?php echo $segunda_dose ?></div>
					</div>
				</div>
				<div class="vacinometro-celula">
					<div class="vacinometro-item">
						<div class="vacinometro-icone"><span class="material-symbols-outlined">vaccines</span></div>
						<div class="vacinometro-nome">3ª dose</div>
						<div class="vacinometro-valor"><?php echo $terceira_dose ?></div>
					</div>
				</div>
			</div>
			
			<div class="vacinometro-linha">
				<div class="vacinometro-celula">
					<div class="vacinometro-item">
						<div class="vacinometro-icone"><span class="material-symbols-outlined">vaccines</span></div>
						<div class="vacinometro-nome">4ª dose</div>
						<div class="vacinometro-valor"><?php echo $quarta_dose ?></div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/vacinometro.php !-->