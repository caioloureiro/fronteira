<?php

/*Start - MySQL*/
$servidor = "localhost";
$usuario = "root";
$senha = "caio1234";
$banco = "fronteiramg_site";

$conn = new mysqli( $servidor, $usuario, $senha, $banco );

if( $conn->connect_error ){
	
  die("Connection failed: " . $conn->connect_error);
  
}

$conn->set_charset('utf8mb4');
/*Start - MySQL*/

?>