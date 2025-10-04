<?php

$sql_licitacoes_categorias = "SELECT * FROM licitacoes_categorias WHERE ativo = 1";

$licitacoes_categorias_tabela = $conn->query( $sql_licitacoes_categorias );

$licitacoes_categorias_array = array();

while( $licitacoes_categorias_montado = $licitacoes_categorias_tabela->fetch_assoc() ){
	
	$licitacoes_categorias_array[] = $licitacoes_categorias_montado;
	
}

//dd( $licitacoes_categorias_array );

?>