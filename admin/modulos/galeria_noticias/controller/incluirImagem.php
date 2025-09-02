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
	
$pasta = $raiz_site .'galeria/';

$hoje = date( 'Y-m-d H:i:s' );

//echo current( $_POST );

$noticia_id = $_POST['noticia_id'];
//echo $noticia_id;

$nome = $_POST['imagem'];
//echo $nome;

$sql = '';

$sql .= "INSERT INTO galeria_noticias (
	nome, 
	imagem, 
	noticia_id 
) VALUES (".
	"'". $nome ."', ".
	"'". $nome ."', ".
	"'". $noticia_id ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Subiu arquivo para pasta galeria: ".$pasta.$nome." e notícia: ". $noticia_id ."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

?>