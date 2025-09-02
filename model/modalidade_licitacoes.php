<?php

$sql_modalidade_licitacoes = "SELECT * FROM modalidade_licitacoes WHERE ativo = 1";

$modalidade_licitacoes_tabela = $conn->query( $sql_modalidade_licitacoes );

$modalidade_licitacoes_array = array();

while( $modalidade_licitacoes_montado = $modalidade_licitacoes_tabela->fetch_assoc() ){
	
	$modalidade_licitacoes_array[] = $modalidade_licitacoes_montado;
	
}

//dd( $modalidade_licitacoes_array );

?>