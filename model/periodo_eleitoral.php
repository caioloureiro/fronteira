<?php

$sql_periodo_eleitoral = "SELECT * FROM periodo_eleitoral";

$periodo_eleitoral_tabela = $conn->query( $sql_periodo_eleitoral );

$periodo_eleitoral_array = array();

while( $periodo_eleitoral_montado = $periodo_eleitoral_tabela->fetch_assoc() ){
	
	$periodo_eleitoral_array[] = $periodo_eleitoral_montado;
	
}

//dd( $periodo_eleitoral_array );

?>