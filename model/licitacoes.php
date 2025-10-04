<?php

$sql_licitacoes = "SELECT * FROM licitacoes WHERE ativo = 1";

$licitacoes_tabela = $conn->query( $sql_licitacoes );

$licitacoes_array = array();

while( $licitacoes_montado = $licitacoes_tabela->fetch_assoc() ){
	
	$licitacoes_array[] = $licitacoes_montado;
	
}

//dd( $licitacoes_array );

?>