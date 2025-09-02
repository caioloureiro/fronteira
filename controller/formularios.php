<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}
require 'funcoes.php';
require 'recaptchalib.php';
require '../model/formularios.php';
require '../model/formularios_respostas.php';

//dd( $_POST );
//dd( $_FILES );
//dd( $formularios_respostas_array );

if( empty( $_POST['g-recaptcha-response'] ) ){ 
	echo'<script>window.location.href = "../recados_raw?raw=1&titulo=Erro ao enviar formulário&mensagem=Selecione o Recaptcha.";</script>';
	exit; 
}

$formulario_id = 0;

$resposta = '';

$formulario_id = $_POST['formulario_id'];

$prefixo_protocolo = 'form';
foreach( $formularios_array as $form ){

	if( 
		$formulario_id == $form['id'] 
		&& $form['prefixo_protocolo'] != '' 
	){
		
		$prefixo_protocolo = $form['prefixo_protocolo'];
		
	}

}

foreach( $_POST as $key => $item ){
	
	if( $key != 'g-recaptcha-response' ){
		
		$item = str_replace( ';', ',', $item );
		$item = str_replace( "'", '', $item );
		
		$resposta .= $key ."=". $item .";";
		
	}
	
}

foreach( $_FILES as $key => $arquivo ){
	
	$arquivo['name'] = str_replace( ';', ',', $arquivo['name'] );
	$arquivo['name'] = str_replace( "'", '', $arquivo['name'] );
	$arquivo['name'] = str_replace( "$", '-', $arquivo['name'] );
	
	$resposta .= $key ."=". renomear( 'formId$'. $formulario_id .'$'. $key .'$'. $email_responsavel .'$'. $arquivo['name'] ) .";";

	/*Start - SUBIR ARQUIVO*/
	//dd( $key );
	//dd( $arquivo );
	
	$arquivo_subir_array = $arquivo;

	$phpFileUploadErrors = array(
		0 => 'Não há erro, arquivo enviado com sucesso',
		1 => 'O arquivo enviado excede a diretiva upload_max_filesize no php.ini',
		2 => 'O arquivo enviado excede a diretiva MAX_FILE_SIZE especificada no formulário HTML',
		3 => 'O arquivo enviado foi carregado apenas parcialmente',
		4 => 'Nenhum arquivo foi carregado',
		6 => 'Faltando uma pasta temporária',
		7 => 'Falha ao gravar arquivo no disco.',
		8 => 'Uma extensão PHP interrompeu o upload do arquivo.',
	);

	$formatos_validos = array(
		"bmp",
		"gif",
		"jpeg",
		"jpg",
		"png",
		"webp",
		
		"rar",
		"zip",
		
		"pdf",
	);

	$arquivo_aceito = 0;

	$tamanho_maximo = 1024 * 20000; // 20Mb

	$pasta = '../formularios_arquivos/';

	$contagem = 0;

	require 'replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

	//$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );
	$tipo_de_arquivo_array = explode( '.', trim( strip_tags( $arquivo['name'] ) ) );
	$tipo_de_arquivo = mb_strtolower( $tipo_de_arquivo_array[ count( $tipo_de_arquivo_array ) - 1 ] );

	//dd( $tipo_de_arquivo );

	foreach( $formatos_validos as $allow ){
		
		if( $tipo_de_arquivo == $allow ){ 
			
			$arquivo_aceito = 1;
			
		}
		
	}

	//dd( $arquivo_aceito );

	if( $arquivo_aceito == 0 ){

		echo'
		<script> 
			alert("O tipo de arquivo: '. $tipo_de_arquivo .' não é aceito.");
			window.history.back(); 
		</script>
		';
		
		exit; 
		
	}

	if( $arquivo_subir_array['error'] == 4 ) {
		
		echo'
		<script> 
			alert("O arquivo não subiu.");
			window.history.back(); 
		</script>
		';
		
		exit; 
		
	}

	if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
		
		//dd( $arquivo_subir_array['size'] .' > '. $tamanho_maximo );
		
		if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

			echo'
			<script> 
				alert("O arquivo é muito grande.");
				window.history.back(); 
			</script>
			';
			
			exit; 
			
		}
		
		/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
		$name = renomear( 'formId$'. $formulario_id .'$'. $key .'$'. $email_responsavel .'$'. $arquivo['name'] );
		
		//dd( $name );
		/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

		move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$name ); //SOBE O ARQUIVO
		
	}
	/*End - SUBIR ARQUIVO*/

}

$resposta = rtrim( $resposta, ';' );

//dd( $resposta );
//dd( $formulario_id );

// Obtendo o último item do array
$ultimo_item = end($formularios_respostas_array);
$novo_id = $ultimo_item['id'] + 1;

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

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('Resposta ao formulário ID: ". $formulario_id ."','Tabela: formularios_respostas. Respondeu o formulário ID: ". $formulario_id ." e protocolo: ". $protocolo ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

if ( $conn->multi_query( $sql ) === TRUE ) {

	$recado_titulo = 'Obrigado por responder este formulário!';
	
	$recado_mensagem = 'Seu protocolo de atendimento: '. $protocolo .'. Aguarde o contato da Prefeitura para retirar do documento. Dúvidas, entre em contato - 14 3811-1522, 3811-1521 ou 3811-1522, atendimento de segunda a sexta, das 8h às 16h30. <strong>ANOTE SEU PROTOCOLO: '. $protocolo .'</strong>';
	
	/*Start - PROVISÓRIO*/
	if( $formulario_id == 11 ){ $recado_mensagem = 'Sua inscrição foi realizada com sucesso. Retire o numeral nos dias 28 e 29/11 na Secretaria Municipal da Educação, das 8h às 17h. Boa prova!'; }
	/*End - PROVISÓRIO*/
	
	echo'<script>window.location.href = "../recados_raw_formulario?raw=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
} else {
	
	$recado_titulo = 'Ocorreu um erro.';
	$recado_mensagem = 'Error: ' . $sql . '. ' . $conn->error;

	echo'<script>window.location.href = "../recados_raw?raw=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
}

$conn->close();


?>