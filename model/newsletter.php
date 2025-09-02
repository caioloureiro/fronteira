<?php

$sql_newsletter = "SELECT * FROM newsletter WHERE ativo = 1";

$newsletter_tabela = $conn->query( $sql_newsletter );

$newsletter_array = array();

while( $newsletter_montado = $newsletter_tabela->fetch_assoc() ){
	
	$newsletter_array[] = $newsletter_montado;
	
}

//dd( $newsletter_array );

?>