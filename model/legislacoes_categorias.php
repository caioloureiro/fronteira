<?php

$sql_legislacoes_categorias = "SELECT * FROM legislacoes_categorias WHERE ativo = 1";

$legislacoes_categorias_tabela = $conn->query( $sql_legislacoes_categorias );

$legislacoes_categorias_array = array();

while( $legislacoes_categorias_montado = $legislacoes_categorias_tabela->fetch_assoc() ){
	
	$legislacoes_categorias_array[] = $legislacoes_categorias_montado;
	
}

//dd( $legislacoes_categorias_array );

?>