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

//dd( $_POST );
//dd( $_FILES );

if( empty( $_POST['g-recaptcha-response'] ) ){ 
	echo'<script>window.location.href = "../recados_raw?recado=1&titulo=Erro ao enviar enquete&mensagem=Selecione o Recaptcha.";</script>';
	exit; 
}

$enquete_id = 0;

$resposta = '';

$enquete_id = $_POST['enquete_id'];

foreach( $_POST as $key => $item ){
	
	if( $key != 'g-recaptcha-response' ){
		
		$item = str_replace( ';', ',', $item );
		$item = str_replace( "'", '', $item );
		
		//dd( $key );
		
		if( $key == 'enquete_id' ){ $resposta .= $key ."=". $item .";"; }
		
		if( $key != 'enquete_id' ){ 
			
			$separador = ';';
			
			$getSeparador_array = explode( '_', trim( strip_tags( $item ) ) );
			//echo '<pre>'; print_r( $getSeparador_array[0] ); echo'</pre>';
			
			if( $getSeparador_array[0] == 'questao' ){ $separador = '='; }
			
			$resposta .= $item . $separador; 
			
		}
		
	}
	
}

foreach( $_FILES as $key => $arquivo ){
	
	$arquivo['name'] = str_replace( ';', ',', $arquivo['name'] );
	$arquivo['name'] = str_replace( "'", '', $arquivo['name'] );
	$arquivo['name'] = str_replace( "$", '-', $arquivo['name'] );
	
	$resposta .= $key ."=". renomear( 'enqueteId$'. $enquete_id .'$'. $key .'$'. $email_responsavel .'$'. $arquivo['name'] ) .";";

	/*Start - SUBIR ARQUIVO*/
	//dd( $key );
	//dd( $arquivo );
	
	$arquivo_subir_array = $arquivo;

	$phpFileUploadErrors = array(
		0 => 'Não há erro, arquivo enviado com sucesso',
		1 => 'O arquivo enviado excede a diretiva upload_max_filesize no php.ini',
		2 => 'O arquivo enviado excede a diretiva MAX_FILE_SIZE especificada no enquete HTML',
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
		$name = renomear( 'enqueteId$'. $enquete_id .'$'. $key .'$'. $email_responsavel .'$'. $arquivo['name'] );
		
		//dd( $name );
		/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/

		move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$name ); //SOBE O ARQUIVO
		
	}
	/*End - SUBIR ARQUIVO*/

}

//$resposta = rtrim( $resposta, ';' );

//dd( $resposta );
//dd( $enquete_id );

$sql = "INSERT INTO enquete_respostas (
	enquete_id, 
	respostas 
) VALUES (".
	"'". $enquete_id ."', ".
	"'". $resposta ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('Resposta ao enquete ID: ". $enquete_id ."','Tabela: enquete_respostas. Respondeu o enquete ID: ". $enquete_id ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

if ( $conn->multi_query( $sql ) === TRUE ) {

	$recado_titulo = 'Obrigado por responder esta enquete!';
	
	$recado_mensagem = 'Dúvidas, entre em contato - 14 3811-1522, 3811-1521 ou 3811-1522, atendimento de segunda a sexta, das 8h às 16h30';

	echo'<script>window.location.href = "../recados_raw?recado=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
} else {
	
	$recado_titulo = 'Ocorreu um erro.';
	$recado_mensagem = 'Error: ' . $sql . '. ' . $conn->error;

	echo'<script>window.location.href = "../recados_raw?recado=1&titulo='. $recado_titulo .'&mensagem='. $recado_mensagem .'";</script>';
	
}

$conn->close();


?>