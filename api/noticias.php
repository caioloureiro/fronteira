<?php

require 'conexao.php';
require '../model/noticias.php';

/*Start - API*/
header("Content-Type: application/json; charset=UTF-8");
echo json_encode( $noticias_array );
/*End - API*/

?>