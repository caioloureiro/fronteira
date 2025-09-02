<?php
/*Start - PAGINAS CRIADAS PELO DESENVOLVEDOR*/
$sql_paginas_fixas = "SELECT * FROM paginas_fixas WHERE ativo = 1";

$paginas_fixas_tabela = $conn->query( $sql_paginas_fixas );

$paginas_fixas = array();

while( $paginas_fixas_montado = $paginas_fixas_tabela->fetch_assoc() ){
	
	$paginas_fixas[] = $paginas_fixas_montado;
	
}

//dd( $paginas_fixas );
/*End - PAGINAS CRIADAS PELO DESENVOLVEDOR*/

?>