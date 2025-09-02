<?php

$sql_admin_user = "SELECT * FROM admin_user WHERE ativo = 1";

$admin_user_tabela = $conn->query( $sql_admin_user );

$admin_user_array = array();

while( $admin_user_montado = $admin_user_tabela->fetch_assoc() ){
	
	$admin_user_array[] = $admin_user_montado;
	
}

?>