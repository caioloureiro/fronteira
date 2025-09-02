<!-- Start - view/conteudo-titulo-pag-fixa.php !-->
<?php

require 'model/galeria.php'; 

foreach( $galeria_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){ 
		$conteudo_titulo_pagina = $item['nome']; 
	}
	
}
	
?>

<style><?php require 'css/conteudo-titulo.css'; ?></style>

<section class="conteudo-titulo">
	
	<div class="box">
		
		<div class="conteudo-titulo-campo"><?php echo 'Galeria: '. $conteudo_titulo_pagina ?></div>
		
	</div>
	
</section>
<!-- End - view/conteudo-titulo-pag-fixa.php !-->