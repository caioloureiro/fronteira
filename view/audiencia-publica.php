<!-- Start - view/audiencia-publica.php !-->
<?php

$audiencia_id = '';
$audiencia_titulo = '';
$audiencia_data_publicacao = '';
$audiencia_data_audiencia = '';
$audiencia_local = '';
$audiencia_categoria = '';
$audiencia_descricao = '';

foreach( $audiencias_publicas_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		$audiencia_id = $item['id'];
		$audiencia_titulo = $item['titulo'];
		$audiencia_data_publicacao = $item['data_publicacao'];
		$audiencia_data_audiencia = $item['data_audiencia'];
		$audiencia_local = $item['local'];
		$audiencia_categoria = $item['categoria'];
		$audiencia_descricao = $item['descricao'];
		
	}

}

?>

<style><?php require 'css/audiencia-publica.css'; ?></style>

<section class="audiencia-publica">
	
	<div class="box">
		
		<a href="audiencias-publicas"><div class="voltar">voltar</div></a>
		
		<div class="audiencia-publica-campo" id="ler_texto">
		
			<div class="audiencia-publica-titulo"><span><?php echo $audiencia_titulo ?></span></div>
			
			<div class="audiencia-publica-linha">
				<div class="col15 audiencia-publica-realce">Data Publicação:</div>
				<div class="col35"><?php echo data_tempo( $audiencia_data_publicacao ) ?></div>
				<div class="col15 audiencia-publica-realce">Data Audiência:</div>
				<div class="col35"><?php echo data_tempo( $audiencia_data_audiencia ) ?></div>
			</div>
			<div class="audiencia-publica-linha">
				<div class="col15 audiencia-publica-realce">Local:</div>
				<div class="col85"><?php echo $audiencia_local ?></div>
			</div>
			<div class="audiencia-publica-linha">
				<div class="col15 audiencia-publica-realce">Categoria:</div>
				<div class="col85"><?php echo $audiencia_categoria ?></div>
			</div>
			<div class="audiencia-publica-linha">
				<div class="col100 audiencia-publica-realce">Descrição:</div>
			</div>
			
			<div class="audiencia-publica-descricao"><?php echo $audiencia_descricao ?></div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/audiencia-publica.php !-->