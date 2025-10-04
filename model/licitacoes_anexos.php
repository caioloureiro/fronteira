<?php

$sql_licitacoes_anexos = "SELECT * FROM licitacoes_anexos WHERE ativo = 1";

$licitacoes_anexos_tabela = $conn->query( $sql_licitacoes_anexos );

$licitacoes_anexos_array = array();

while( $licitacoes_anexos_montado = $licitacoes_anexos_tabela->fetch_assoc() ){
	
	$licitacoes_anexos_array[] = $licitacoes_anexos_montado;
	
}

//dd( $licitacoes_anexos_array );

?>