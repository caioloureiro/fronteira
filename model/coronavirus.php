<?php

$sql_coronavirus = "SELECT * FROM coronavirus WHERE ativo = 1";

$coronavirus_tabela = $conn->query( $sql_coronavirus );

$coronavirus_array = array();

while( $coronavirus_montado = $coronavirus_tabela->fetch_assoc() ){
	
	$coronavirus_array[] = $coronavirus_montado;
	
}

//dd( $coronavirus_array );

?>