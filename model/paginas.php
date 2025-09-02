<?php
/*Start - PÁGINAS CRIADAS PELO USUÁRIO*/

$sql_paginas = "SELECT * FROM paginas WHERE ativo = 1";

$paginas_tabela = $conn->query( $sql_paginas );

$paginas = array();

while( $paginas_montado = $paginas_tabela->fetch_assoc() ){
	
	$paginas[] = $paginas_montado;
	
}

//dd( $paginas );

/*End - PÁGINAS CRIADAS PELO USUÁRIO*/

?>