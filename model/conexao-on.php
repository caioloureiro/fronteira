<?php

$servidor = "localhost";
$usuario = "fronteiramg_user";
$senha = "Gmaes@suporte*";
$banco = "fronteiramg_site";

$conn = new mysqli( $servidor, $usuario, $senha, $banco );

if( $conn->connect_error ){
	
  die("Falha na conexão: " . $conn->connect_error);
  
}

$conn->set_charset('utf8');

?>