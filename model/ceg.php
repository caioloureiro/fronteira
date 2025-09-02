<?php

$sql_ceg = "SELECT * FROM ceg WHERE ativo = 1";

$ceg_tabela = $conn->query( $sql_ceg );

$ceg_array = array();

while( $ceg_montado = $ceg_tabela->fetch_assoc() ){
	
	$ceg_array[] = $ceg_montado;
	
}

//dd( $ceg_array );

?>