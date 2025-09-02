<?php

$sql_vacinometro = "SELECT * FROM vacinometro WHERE ativo = 1";

$vacinometro_tabela = $conn->query( $sql_vacinometro );

$vacinometro_array = array();

while( $vacinometro_montado = $vacinometro_tabela->fetch_assoc() ){
	
	$vacinometro_array[] = $vacinometro_montado;
	
}

//dd( $vacinometro_array );

?>