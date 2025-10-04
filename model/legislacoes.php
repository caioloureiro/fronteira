<?php

$sql_legislacoes = "SELECT * FROM legislacoes WHERE ativo = 1";

$legislacoes_tabela = $conn->query( $sql_legislacoes );

$legislacoes_array = array();

while( $legislacoes_montado = $legislacoes_tabela->fetch_assoc() ){
	
	$legislacoes_array[] = $legislacoes_montado;
	
}

//dd( $legislacoes_array );

?>