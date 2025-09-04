<?php

$servidor = "localhost";
$usuario = "fronteiramg_admin";
$senha = "4JNyShm9{Fq{Q)GN*";
$banco = "fronteiramg_site";

$conn = new mysqli( $servidor, $usuario, $senha, $banco );

if( $conn->connect_error ){
	
  die("Falha na conexão: " . $conn->connect_error);
  
}

$conn->set_charset('utf8');

?>