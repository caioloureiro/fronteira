<?php

$sql_departamentos = "SELECT * FROM departamentos WHERE ativo = 1";

$departamentos_tabela = $conn->query( $sql_departamentos );

$departamentos_array = array();

while( $departamentos_montado = $departamentos_tabela->fetch_assoc() ){
	
	$departamentos_array[] = $departamentos_montado;
	
}

//dd( $departamentos_array );

?>