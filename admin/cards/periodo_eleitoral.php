<!-- Start - cards/periodo_eleitoral.php !-->
<?php 
require $raiz_site .'model/periodo_eleitoral.php'; 

$home_ativado = 0;

foreach( $periodo_eleitoral_array as $home_item ){
	
	$home_ativado = $home_item['ativado'];
	
}

if( $home_ativado == 1 ){
	echo'<div class="comentario">Período Eleitoral ativado.</div>';
}

?>
<!-- End - cards/periodo_eleitoral.php !-->