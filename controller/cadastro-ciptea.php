<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}
require 'funcoes.php';
require '../model/formularios.php';
require '../model/formularios_respostas.php';

//dd( $_POST );
//dd( $_FILES );
//dd( $formularios_respostas_array );

$formulario_id = 0;

$resposta = '';

$formulario_id = $_POST['formulario_id'];
$email_responsavel = $_POST['email_responsavel'];
//dd( $email_responsavel );

foreach( $_POST as $key => $item ){
	
	$item = str_replace( ';', ',', $item );
	$item = str_replace( "'", '', $item );
	
	$resposta .= $key ."=". $item .";";
	
}

$resposta = rtrim( $resposta, ';' );

//dd( $resposta );
//dd( $formulario_id );

// Obtendo o último item do array
$ultimo_item = end($formularios_respostas_array);
$novo_id = $ultimo_item['id'] + 1;

$prefixo_protocolo = 'CIPTEA';

$protocolo = $prefixo_protocolo . $formulario_id .'prot'. $novo_id;
//dd( $protocolo );

$sql = "INSERT INTO formularios_respostas (
	formulario_id, 
	respostas, 
	protocolo
) VALUES (".
	"'". $formulario_id ."', ".
	"'". $resposta ."', ".
	"'". $protocolo ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email_responsavel ."','Tabela: formularios_respostas. Respondeu o formulário ID: ". $formulario_id ." e protocolo: ". $protocolo ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

if ( $conn->multi_query( $sql ) === TRUE ) {

	$recado_titulo = 'Obrigado por responder ao formulário CIPTEA!';
	
	$recado_mensagem = 'Seu protocolo para atendimento: '. $protocolo .'. Aguarde o contato da Prefeitura para retirar do documento. Dúvidas, entre em contato - 14 3811-1522, 3811-1521 ou 3811-1522, atendimento de segunda a sexta, das 8h às 16h30';

	echo'<script>window.location.href = "../recados_raw_formulario?recado=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
} else {
	
	$recado_titulo = 'Ocorreu um erro.';
	$recado_mensagem = 'Error: ' . $sql . '. ' . $conn->error;

	echo'<script>window.location.href = "../recados_raw?recado=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
}

$conn->close();


?>