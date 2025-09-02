<!-- Start - view/conteudo-titulo-secretarias.php !-->
<?php

$conteudo_titulo_pagina = '';

foreach( $secretarias_array as $item ){
	
	if( $item['pagina'] == $_GET['secretaria'] ){ 
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
<!-- End - view/conteudo-titulo-secretarias.php !-->