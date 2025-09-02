<?php

require 'conexao.php';
require '../model/exemplo.php';

/*Start - API*/
header("Content-Type: application/json; charset=UTF-8");
echo json_encode( $exemplo_array );
/*End - API*/

?>