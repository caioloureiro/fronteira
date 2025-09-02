<?php

$sql_acesso_rapido = "SELECT * FROM acesso_rapido WHERE ativo = 1";

$acesso_rapido_tabela = $conn->query( $sql_acesso_rapido );

$acesso_rapido_array = array();

while( $acesso_rapido_montado = $acesso_rapido_tabela->fetch_assoc() ){
	
	$acesso_rapido_array[] = $acesso_rapido_montado;
	
}

//dd( $acesso_rapido_array );

?>