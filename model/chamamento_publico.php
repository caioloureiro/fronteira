<?php

$sql_chamamento_publico = "SELECT * FROM chamamento_publico WHERE ativo = 1";

$chamamento_publico_tabela = $conn->query( $sql_chamamento_publico );

$chamamento_publico_array = array();

while( $chamamento_publico_montado = $chamamento_publico_tabela->fetch_assoc() ){
	
	$chamamento_publico_array[] = $chamamento_publico_montado;
	
}

//dd( $chamamento_publico_array );

?>