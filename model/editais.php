<?php

$sql_editais = "SELECT * FROM editais WHERE ativo = 1";

$editais_tabela = $conn->query( $sql_editais );

$editais_array = array();

while( $editais_montado = $editais_tabela->fetch_assoc() ){
	
	$editais_array[] = $editais_montado;
	
}

//dd( $editais_array );

$sql_editais_destaque = "SELECT * FROM (SELECT * FROM editais WHERE ativo = 1 ORDER BY id DESC LIMIT 10) g ORDER BY g.id";

$editais_destaque_tabela = $conn->query( $sql_editais_destaque );

$editais_destaque_array = array();

while( $editais_destaque_montado = $editais_destaque_tabela->fetch_assoc() ){
	
	$editais_destaque_array[] = $editais_destaque_montado;
	
}

//dd( $editais_destaque_array );

?>