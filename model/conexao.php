<?php

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require 'model/conexao-off.php';

}else{
	
	require 'model/conexao-on.php';
	
}

//dd( $conn );

?>