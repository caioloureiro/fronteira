<?php

$sql_secretarias = "SELECT * FROM secretarias WHERE ativo = 1";

$secretarias_tabela = $conn->query( $sql_secretarias );

$secretarias_array = array();

while( $secretarias_montado = $secretarias_tabela->fetch_assoc() ){
	
	$secretarias_array[] = $secretarias_montado;
	
}

//dd( $secretarias_array );

?>