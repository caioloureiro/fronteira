<?php

$sql_popup = "SELECT * FROM popup WHERE ativo = 1";

$popup_tabela = $conn->query( $sql_popup );

$popup_array = array();

while( $popup_montado = $popup_tabela->fetch_assoc() ){
	
	$popup_array[] = $popup_montado;
	
}

//dd( $popup_array );

?>