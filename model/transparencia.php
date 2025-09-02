<?php

$sql_transparencia = "SELECT * FROM transparencia WHERE ativo = 1";

$transparencia_tabela = $conn->query( $sql_transparencia );

$transparencia_array = array();

while( $transparencia_montado = $transparencia_tabela->fetch_assoc() ){
	
	$transparencia_array[] = $transparencia_montado;
	
}

//dd( $transparencia_array );

?>