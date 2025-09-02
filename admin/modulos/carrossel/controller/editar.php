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

//echo '<pre>'; print_r( $_POST ); echo'</pre>'; exit;

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){ echo'Usuário sem sessão ativa.'; exit; }
if( $_POST['imagem'] == '' ){ echo'Escolha uma imagem.'; exit; }
if( $_POST['imagem'] == 'ignorado' ){ echo'Escolha uma imagem.'; exit; }
if( $_POST['link'] == '' ){ echo'Escolha um link.'; exit; }

$id = $_POST['id'];

$imagem = $_POST['imagem'];
$link = $_POST['link'];
$target = $_POST['target'];
$mobile = $_POST['mobile'];

$sql = "UPDATE carrossel SET ".
"imagem = '". $imagem ."', ".
"link = '". $link ."', ".
"target = '". $target ."', ".
"mobile = '". $mobile ."' ".
"WHERE id = ". $id .";";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: carrossel. Editou o item: ". $imagem ." de ID: ".$id."','". date( 'Y-m-d H:i:s' ) ."');";

//echo '<pre>'; print_r( $sql ); echo'</pre>'; exit;

if ( $conn->multi_query( $sql ) === TRUE ) {

	echo'Item modificado com sucesso.';
	
} 
else {

	echo'Erro: '. $conn->error;
	
}

$conn->close();

?>