<?php

$sql_cemiterios_contatos = "SELECT * FROM cemiterios_contatos WHERE ativo = 1";

$cemiterios_contatos_tabela = $conn->query( $sql_cemiterios_contatos );

$cemiterios_contatos_array = array();

while( $cemiterios_contatos_montado = $cemiterios_contatos_tabela->fetch_assoc() ){
	
	$cemiterios_contatos_array[] = $cemiterios_contatos_montado;
	
}

//dd( $cemiterios_contatos_array );

?>