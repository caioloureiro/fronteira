<!-- Start - view/conteudo-titulo-noticia.php !-->
<?php

$periodo_eleitoral = 0;

foreach( $periodo_eleitoral_array as $per ){
	
	$periodo_eleitoral = $per['ativado'];
	
}

foreach( $noticias_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){ 
	
		$conteudo_titulo_pagina = $item['titulo']; 
		
	}
	
}
	
?>

<style><?php require 'css/conteudo-titulo.css'; ?></style>

<section class="conteudo-titulo">
	
	<div class="box">
		
		<?php 
			
			if( $periodo_eleitoral == 0 ){
				echo '<div class="conteudo-titulo-campo">'. $conteudo_titulo_pagina .'</div>';
			}
			
			if( $periodo_eleitoral == 1 ){
				echo '<div class="conteudo-titulo-campo">'. $conteudo_titulo_pagina .' - Período Eleitoral</div>';
			}
			
		?>
		
	</div>
	
</section>
<!-- End - view/conteudo-titulo-noticia.php !-->