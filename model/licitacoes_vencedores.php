<?php

$sql_licitacoes_vencedores = "SELECT * FROM licitacoes_vencedores WHERE ativo = 1";

$licitacoes_vencedores_tabela = $conn->query( $sql_licitacoes_vencedores );

$licitacoes_vencedores_array = array();

while( $licitacoes_vencedores_montado = $licitacoes_vencedores_tabela->fetch_assoc() ){
	
	$licitacoes_vencedores_array[] = $licitacoes_vencedores_montado;
	
}

//dd( $licitacoes_vencedores_array );

?>