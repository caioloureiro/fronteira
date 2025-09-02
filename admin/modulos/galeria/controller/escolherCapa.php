<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';
$pasta = 'galeria/';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/galeria_imagens.php';

$nome_arquivo = $_POST['arquivo'];
$galeria_id = $_POST['galeria_id'];

$sql = '';

foreach( $galeria_imagens_array as $imagem ){

	if( $imagem['galeria_id'] == $galeria_id ){
		
		if( $imagem['destaque'] == 1 ){
			
			$sql .= "UPDATE galeria_imagens SET destaque = 0 WHERE id = '". $imagem['id'] ."';";
			
		}
		
	}

}

$sql .= "UPDATE galeria_imagens SET destaque = 1 WHERE imagem = '". $nome_arquivo ."';";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('".$_COOKIE['fronteira_ADMIN_SESSION_usuario'] ."','Destacou a imagem da galeria: ". $nome_arquivo ."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

?>