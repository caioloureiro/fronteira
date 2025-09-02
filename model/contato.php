<?php

$sql_contato = "SELECT * FROM contato WHERE ativo = 1";

$contato_tabela = $conn->query( $sql_contato );

$contato_array = array();

while( $contato_montado = $contato_tabela->fetch_assoc() ){
	
	$contato_array[] = $contato_montado;
	
}

//dd( $contato_array );

?>