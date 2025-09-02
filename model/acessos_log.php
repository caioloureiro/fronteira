<?php

$sql_acessos_log = "SELECT * FROM acessos_log WHERE ativo = 1";

$acessos_log_tabela = $conn->query( $sql_acessos_log );

$acessos_log_array = array();

while( $acessos_log_montado = $acessos_log_tabela->fetch_assoc() ){
	
	$acessos_log_array[] = $acessos_log_montado;
	
}

//dd( $acessos_log_array );

?>