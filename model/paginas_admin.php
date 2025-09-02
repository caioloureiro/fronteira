<?php

$sql_paginas_admin = "SELECT * FROM paginas_admin WHERE ativo = 1";
$paginas_admin_tabela = $conn->query( $sql_paginas_admin );

$paginas_admin_array = array();

while( $paginas_admin_montado = $paginas_admin_tabela->fetch_assoc() ){
	
	$paginas_admin_array[] = $paginas_admin_montado;
	
}

//dd( $paginas_admin_array );

?>