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
require $raiz_site .'model/chamamento_publico.php';
require $raiz_site .'model/downloads.php';

//print_r( $_POST ); exit;

$chamamento_id = $_POST['chamamento_id'];
//echo $chamamento_id;

$nome = $_POST['arquivo'];
	
$pasta = $raiz_site .'arquivos/';

$hoje = date( 'Y-m-d H:i:s' );

$data = $hoje;
$modalidade_id = 2; //2 = CHAMAMENTO PÚBLICO NA TABELA modalidade_licitacoes
$modalidade_item_id = $chamamento_id;
$modalidade_arquivo_id = 0;
$arquivo = $nome;

foreach( $downloads_array_total as $download ){
	
	if( $download['arquivo'] == $arquivo ){
		
		$modalidade_arquivo_id = $download['id'];
		$nome = $download['nome'];
		$arquivo = $download['arquivo'];
		
	}

}

$sql = '';

$sql .= "INSERT INTO editais (
	nome, 
	data, 
	arquivo, 
	modalidade_id, 
	modalidade_arquivo_id, 
	modalidade_item_id 
) VALUES (".
	"'". $nome ."', ".
	"'". $data ."', ".
	"'". $arquivo ."', ".
	"". $modalidade_id .", ".
	"". $modalidade_arquivo_id .", ".
	"". $modalidade_item_id ." ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: editais. Criou o item ". $nome ."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

echo $sql;

?>