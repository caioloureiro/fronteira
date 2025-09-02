<?php

require 'conexao.php';
require '../model/popup_paginas.php';

/*Start - API*/
header("Content-Type: application/json; charset=UTF-8");
echo json_encode( $popup_paginas_array );
/*End - API*/

?>