<?php

$sql_settings_admin = "SELECT * FROM settings_admin WHERE ativo = 1";

$settings_admin_tabela = $conn->query( $sql_settings_admin );

$settings_admin_array = array();

while( $settings_admin_montado = $settings_admin_tabela->fetch_assoc() ){
	
	$settings_admin_array[] = $settings_admin_montado;
	
}

//dd( $settings_admin_array );

?>