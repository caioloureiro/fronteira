<?php

$sql_administracao = "SELECT * FROM administracao WHERE ativo = 1";

$administracao_tabela = $conn->query( $sql_administracao );

$administracao_array = array();

while( $administracao_montado = $administracao_tabela->fetch_assoc() ){
	
	$administracao_array[] = $administracao_montado;
	
}

//dd( $administracao_array );

?>