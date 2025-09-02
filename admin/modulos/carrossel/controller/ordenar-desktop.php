<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/carrossel.php';

//print_r( $_POST ); exit;

$sql = '';

if( isset( $_POST['item_nova_ordem_1'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '1' ".
	"WHERE id = ". $_POST['item_nova_ordem_1'] .";";
}

if( isset( $_POST['item_nova_ordem_2'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '2' ".
	"WHERE id = ". $_POST['item_nova_ordem_2'] .";";
}

if( isset( $_POST['item_nova_ordem_3'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '3' ".
	"WHERE id = ". $_POST['item_nova_ordem_3'] .";";
}

if( isset( $_POST['item_nova_ordem_4'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '4' ".
	"WHERE id = ". $_POST['item_nova_ordem_4'] .";";
}

if( isset( $_POST['item_nova_ordem_5'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '5' ".
	"WHERE id = ". $_POST['item_nova_ordem_5'] .";";
}

if( isset( $_POST['item_nova_ordem_6'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '6' ".
	"WHERE id = ". $_POST['item_nova_ordem_6'] .";";
}

if( isset( $_POST['item_nova_ordem_7'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '7' ".
	"WHERE id = ". $_POST['item_nova_ordem_7'] .";";
}

if( isset( $_POST['item_nova_ordem_8'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '8' ".
	"WHERE id = ". $_POST['item_nova_ordem_8'] .";";
}

if( isset( $_POST['item_nova_ordem_9'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '9' ".
	"WHERE id = ". $_POST['item_nova_ordem_9'] .";";
}

if( isset( $_POST['item_nova_ordem_10'] ) ){
	$sql .= "UPDATE carrossel SET ".
	"ordem = '10' ".
	"WHERE id = ". $_POST['item_nova_ordem_10'] .";";
}

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Mudou a ordem dos destaques de carrossel','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; exit;

if ( $conn->multi_query( $sql ) === TRUE ) {

	echo'Ordenado com sucesso.';
	
} 
else {

	echo'Erro: '. $conn->error;
	
}

$conn->close();

?>