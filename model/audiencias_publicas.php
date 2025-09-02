<?php

$sql_audiencias_publicas = "SELECT * FROM audiencias_publicas WHERE ativo = 1";

$audiencias_publicas_tabela = $conn->query( $sql_audiencias_publicas );

$audiencias_publicas_array = array();

while( $audiencias_publicas_montado = $audiencias_publicas_tabela->fetch_assoc() ){
	
	$audiencias_publicas_array[] = $audiencias_publicas_montado;
	
}

//dd( $audiencias_publicas_array );

?>