<?php

$sql_galeria_imagens = "SELECT * FROM galeria_imagens WHERE ativo = 1";

$galeria_imagens_tabela = $conn->query( $sql_galeria_imagens );

$galeria_imagens_array = array();

while( $galeria_imagens_montado = $galeria_imagens_tabela->fetch_assoc() ){
	
	$galeria_imagens_array[] = $galeria_imagens_montado;
	
}

//dd( $galeria_imagens_array );

?>