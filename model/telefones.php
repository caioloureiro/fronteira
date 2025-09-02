<?php

$sql_telefones = "SELECT * FROM telefones WHERE ativo = 1";

$telefones_tabela = $conn->query( $sql_telefones );

$telefones_array = array();

while( $telefones_montado = $telefones_tabela->fetch_assoc() ){
	
	$telefones_array[] = $telefones_montado;
	
}

//dd( $telefones_array );

?>