<?php

$sql_paginas_anexos = "SELECT * FROM paginas_anexos WHERE ativo = 1";

$paginas_anexos_tabela = $conn->query( $sql_paginas_anexos );

$paginas_anexos_array = array();

while( $paginas_anexos_montado = $paginas_anexos_tabela->fetch_assoc() ){
	
	$paginas_anexos_array[] = $paginas_anexos_montado;
	
}

//dd( $paginas_anexos_array );

?>