<?php

$sql_conselhos_municipais = "SELECT * FROM conselhos_municipais WHERE ativo = 1";

$conselhos_municipais_tabela = $conn->query( $sql_conselhos_municipais );

$conselhos_municipais_array = array();

while( $conselhos_municipais_montado = $conselhos_municipais_tabela->fetch_assoc() ){
	
	$conselhos_municipais_array[] = $conselhos_municipais_montado;
	
}

//dd( $conselhos_municipais_array );

?>