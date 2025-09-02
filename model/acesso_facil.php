<?php
$sql_acesso_facil = "SELECT * FROM acesso_facil WHERE ativo = 1";

$acesso_facil_tabela = $conn->query( $sql_acesso_facil );

$acesso_facil_array = array();

while( $acesso_facil_montado = $acesso_facil_tabela->fetch_assoc() ){
	
	$acesso_facil_array[] = $acesso_facil_montado;
	
}

//dd( $acesso_facil_array );
?>