<?php

$sql_concursos_categorias = "SELECT * FROM concursos_categorias WHERE ativo = 1";

$concursos_categorias_tabela = $conn->query( $sql_concursos_categorias );

$concursos_categorias_array = array();

while( $concursos_categorias_montado = $concursos_categorias_tabela->fetch_assoc() ){
	
	$concursos_categorias_array[] = $concursos_categorias_montado;
	
}

//dd( $concursos_categorias_array );

?>