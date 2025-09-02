<?php

$sql_carrossel = "SELECT * FROM carrossel WHERE ativo = 1";

$carrossel_tabela = $conn->query( $sql_carrossel );

$carrossel_array = array();

while( $carrossel_montado = $carrossel_tabela->fetch_assoc() ){
	
	$carrossel_array[] = $carrossel_montado;
	
}

//dd( $carrossel_array );

?>