<?php

$sql_legislacoes_anexos = "SELECT * FROM legislacoes_anexos WHERE ativo = 1";

$legislacoes_anexos_tabela = $conn->query( $sql_legislacoes_anexos );

$legislacoes_anexos_array = array();

while( $legislacoes_anexos_montado = $legislacoes_anexos_tabela->fetch_assoc() ){
	
	$legislacoes_anexos_array[] = $legislacoes_anexos_montado;
	
}

//dd( $legislacoes_anexos_array );

?>