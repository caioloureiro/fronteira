<?php

$sql_acesso_facil_base = "SELECT * FROM acesso_facil_base WHERE ativo = 1";

$acesso_facil_base_tabela = $conn->query( $sql_acesso_facil_base );

$acesso_facil_base_array = array();

while( $acesso_facil_base_montado = $acesso_facil_base_tabela->fetch_assoc() ){
	
	$acesso_facil_base_array[] = $acesso_facil_base_montado;
	
}

//dd( $acesso_facil_base_array );

?>