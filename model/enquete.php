<?php

$sql_enquete = "SELECT * FROM enquete WHERE ativo = 1";

$enquete_tabela = $conn->query( $sql_enquete );

$enquete_array = array();

while( $enquete_montado = $enquete_tabela->fetch_assoc() ){
	
	$enquete_array[] = $enquete_montado;
	
}

//dd( $enquete_array );

?>