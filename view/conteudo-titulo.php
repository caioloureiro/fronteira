<!-- Start - view/conteudo-titulo.php !-->
<?php

foreach( $paginas as $item ){
	
	if( $item['pagina'] == $_GET['pagina'] ){ 
		$conteudo_titulo_pagina = $item['titulo']; 
	}
	
}
	
?>

<style><?php require 'css/conteudo-titulo.css'; ?></style>

<section class="conteudo-titulo">
	
	<div class="box">
		
		<div class="conteudo-titulo-campo"><?php echo $conteudo_titulo_pagina ?></div>
		
	</div>
	
</section>
<!-- End - view/conteudo-titulo.php !-->