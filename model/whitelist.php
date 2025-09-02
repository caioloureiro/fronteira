<?php

$sql_whitelist = "SELECT * FROM whitelist WHERE ativo = 1";

$whitelist_tabela = $conn->query( $sql_whitelist );

$whitelist_array = array();

while( $whitelist_montado = $whitelist_tabela->fetch_assoc() ){
	
	$whitelist_array[] = $whitelist_montado;
	
}

//dd( $whitelist_array );

?>