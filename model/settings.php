<?php

$sql_settings = "SELECT * FROM settings WHERE ativo = 1";

$settings_tabela = $conn->query( $sql_settings );

$settings_array = array();

while( $settings_montado = $settings_tabela->fetch_assoc() ){
	
	$settings_array[] = $settings_montado;
	
}

//dd( $settings_array );

?>