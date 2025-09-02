<?php

$sql_noticias_categorias = "SELECT * FROM noticias_categorias WHERE ativo = 1";

$noticias_categorias_tabela = $conn->query( $sql_noticias_categorias );

$noticias_categorias_array = array();

while( $noticias_categorias_montado = $noticias_categorias_tabela->fetch_assoc() ){
	
	$noticias_categorias_array[] = $noticias_categorias_montado;
	
}

//dd( $noticias_categorias_array );

?>