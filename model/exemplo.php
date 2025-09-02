<?php

$sql_exemplo = "SELECT * FROM exemplo WHERE ativo = 1";

$exemplo_tabela = $conn->query( $sql_exemplo );

$exemplo_array = array();

while( $exemplo_montado = $exemplo_tabela->fetch_assoc() ){
	
	$exemplo_array[] = $exemplo_montado;
	
}

//dd( $exemplo_array );

?>