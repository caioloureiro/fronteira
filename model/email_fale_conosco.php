<?php

$sql_email_fale_conosco = "SELECT * FROM email_fale_conosco WHERE ativo = 1";

$email_fale_conosco_tabela = $conn->query( $sql_email_fale_conosco );

$email_fale_conosco_array = array();

while( $email_fale_conosco_montado = $email_fale_conosco_tabela->fetch_assoc() ){
	
	$email_fale_conosco_array[] = $email_fale_conosco_montado;
	
}

//dd( $email_fale_conosco_array );

?>