<?php

$sql_categorias = "SELECT * FROM categorias WHERE ativo = 1";

$categorias_tabela = $conn->query( $sql_categorias );

$categorias_array = array();

while( $categorias_montado = $categorias_tabela->fetch_assoc() ){
	
	$categorias_array[] = $categorias_montado;
	
}

//dd( $categorias_array );

?>