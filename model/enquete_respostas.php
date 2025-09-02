<?php

$sql_enquete_respostas = "SELECT * FROM enquete_respostas WHERE ativo = 1";

$enquete_respostas_tabela = $conn->query( $sql_enquete_respostas );

$enquete_respostas_array = array();

while( $enquete_respostas_montado = $enquete_respostas_tabela->fetch_assoc() ){
	
	$enquete_respostas_array[] = $enquete_respostas_montado;
	
}

//dd( $enquete_respostas_array );

?>