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

$chamamento_id = current( $_POST );
//echo $chamamento_id; exit;

$hoje = date( 'Y-m-d H:i:s' );

$data = $hoje;
$modalidade_id = 2; //2 = CHAMAMENTO PÚBLICO NA TABELA modalidade_licitacoes
$modalidade_item_id = $chamamento_id;
$modalidade_arquivo_id = 0;
$nome = '';
$arquivo = '';

//echo current( $_POST );
$chamamento_publico_id = current( $_POST );

reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );

//echo '$arquivo_subir_array[name]: '. $arquivo_subir_array['name']; exit;

$download_ultimo_id = $downloads_array_total[ count( $downloads_array_total ) - 1 ]['id'];

foreach( $downloads_array_total as $download ){
	
	if( $download['id'] == $download_ultimo_id ){
		
		$modalidade_arquivo_id = $download['id'];
		$nome = $download['nome'];
		$arquivo = $download['arquivo'];
		
		//echo '$arquivo: '. $arquivo;
		
	}

}

if( $arquivo == '' ){
	
	echo 'Arquivo não encontrado na pasta uploads.';
	exit;
	
}

$sql = "INSERT INTO editais (
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

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['botucatu_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: editais. Criou o item ". $nome ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; exit;

$conn->multi_query( $sql );
$conn->close();

echo 'Edital: '. $arquivo .' vinculado ao item: '. $chamamento_publico_id .'.';

?>