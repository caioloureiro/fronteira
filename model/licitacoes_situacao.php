<?php

$sql_licitacoes_situacao = "SELECT * FROM licitacoes_situacao WHERE ativo = 1";

$licitacoes_situacao_tabela = $conn->query( $sql_licitacoes_situacao );

$licitacoes_situacao_array = array();

while( $licitacoes_situacao_montado = $licitacoes_situacao_tabela->fetch_assoc() ){
	
	$licitacoes_situacao_array[] = $licitacoes_situacao_montado;
	
}

//dd( $licitacoes_situacao_array );

?>