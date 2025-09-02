<?php

$sql_cemiterios = "SELECT * FROM cemiterios WHERE ativo = 1";

$cemiterios_tabela = $conn->query( $sql_cemiterios );

$cemiterios_array = array();

while( $cemiterios_montado = $cemiterios_tabela->fetch_assoc() ){
	
	$cemiterios_array[] = $cemiterios_montado;
	
}

//dd( $cemiterios_array );

?>