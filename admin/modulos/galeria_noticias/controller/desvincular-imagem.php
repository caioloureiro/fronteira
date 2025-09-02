<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';
$pasta = 'galeria/';

$nome_arquivo = $_POST['arquivo'];

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/admin_user.php';

$delete = $raiz_site.$pasta.$_POST['arquivo'];

//unlink( $delete );

$sql = '';

$sql .= "UPDATE galeria_noticias SET ativo = 0 WHERE imagem = '". $nome_arquivo ."';";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('".$_COOKIE['fronteira_ADMIN_SESSION_usuario'] ."','Excluiu da pasta galeria o arquivo: ". $delete ."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

?>