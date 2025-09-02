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
	
/*Start - SUBIR ARQUIVO*/
//dd( $_FILES );

//$arquivo_subir_array = $_FILES['arquivo_subir'];

reset( $_FILES ); 
$arquivo_subir_array = current( $_FILES );

//echo current( $_POST );
$noticia_id = current( $_POST );

$sql = '';

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
	"avif",
);

$arquivo_aceito = 0;

$tamanho_maximo = 1024 * 20000; // 20Mb

$pasta = $raiz_site .'galeria/';

$contagem = 0;

require $raiz_site .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivo_subir_array['type'] ) ) );

//dd( $tipo_de_arquivo );

foreach( $formatos_validos as $allow ){
	
	if( $tipo_de_arquivo[1] == $allow ){ 
		
		$arquivo_aceito = 1;
		
	}
	
}

//dd( $arquivo_aceito );

if( $arquivo_aceito == 0 ){

	echo'O tipo de arquivo '. $tipo_de_arquivo[1] .' não é aceito.';
	return; 

}

if( $arquivo_subir_array['error'] == 4 ) {
	
	echo'O arquivo possui erro: '. $arquivo_subir_array['error'] .'';
	return; 
	
}

function resizeImage($sourcePath, $destinationPath, $newWidth) {
	
	// Obtém as dimensões da imagem original
	list($originalWidth, $originalHeight) = getimagesize($sourcePath);

	// Calcula a nova altura proporcional
	$newHeight = ($newWidth / $originalWidth) * $originalHeight;

	// Cria uma nova imagem em branco com as dimensões desejadas
	$resizedImage = imagecreatetruecolor($newWidth, $newHeight);

	// Identifica o tipo de imagem baseado na extensão do arquivo de origem
	$extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));

	// Cria a imagem original com base no formato
	switch ($extension) {
		case 'jpeg':
		case 'jpg':
			$sourceImage = imagecreatefromjpeg($sourcePath);
			break;
		case 'png':
			$sourceImage = imagecreatefrompng($sourcePath);
			break;
		case 'gif':
			$sourceImage = imagecreatefromgif($sourcePath);
			break;
		case 'webp':
			$sourceImage = imagecreatefromwebp($sourcePath);
			break;
		case 'avif':
			if (function_exists('imagecreatefromavif')) { // Verifica suporte ao AVIF
				$sourceImage = imagecreatefromavif($sourcePath);
			} else {
				echo'O formato AVIF não é suportado no servidor.';
				exit;
			}
			break;
		default:
			echo'Formato de imagem: '. $extension .' não suportado.';
			exit;
	}

	// Redimensiona a imagem
	imagecopyresampled(
		$resizedImage, $sourceImage,
		0, 0, 0, 0,
		$newWidth, $newHeight,
		$originalWidth, $originalHeight
	);

	// Salva a nova imagem no destino especificado com base no formato
	$destinationExtension = strtolower(pathinfo($destinationPath, PATHINFO_EXTENSION));

	switch ($destinationExtension) {
		case 'jpeg':
		case 'jpg':
			imagejpeg($resizedImage, $destinationPath, 90); // Qualidade 90
			break;
		case 'png':
			imagepng($resizedImage, $destinationPath);
			break;
		case 'gif':
			imagegif($resizedImage, $destinationPath);
			break;
		case 'webp':
			imagewebp($resizedImage, $destinationPath);
			break;
		case 'avif':
			if (function_exists('imageavif')) { // Verifica suporte ao AVIF
				imageavif($resizedImage, $destinationPath);
			} else {
				echo'O formato AVIF não é suportado no servidor.';
				exit;
			}
			break;
		default:
			echo'Extensão de destino não suportada.';
			exit;
	}

	// Libera a memória
	imagedestroy($sourceImage);
	imagedestroy($resizedImage);

	return true;
	
}

if( $arquivo_subir_array['error'] == 0 ){ //SEM ERROS
	
	//dd( $arquivo_subir_array['size'] .' > '. $tamanho_maximo );
	
	if( $arquivo_subir_array['size'] > $tamanho_maximo ) {

		echo'O arquivo é muito grande. Deve ser menor que 2MB.';
		return;
		
	}
	
	/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
	$name = $arquivo_subir_array['name'];
	
	$name = mb_strtolower( $name );
	
	$explodir_nome = explode( ' ', $name );
	
	$last_nome_numero = count( $explodir_nome ) - 1;
	
	$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
	
	$extensao_arquivo_recebido = $explodir_extensao[1];
	
	$nome_final = '';
	
	$nome_final = date('Y-m-d-H-i') .'-';
	
	for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
		
		if(
			$explodir_nome[$i] != '-' &&
			$explodir_nome[$i] != ''
		){ $nome_final .= $explodir_nome[$i] .'-';}
		
	}
	
	$nome_final .= $explodir_extensao[0];
	$nome_final .= '.'. $explodir_extensao[1];
	
	$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
	
	//dd( $pasta.$nome_final );
	/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/
	
	//resizeImage( $pasta.$arquivo_subir_array["name"], $pasta.$nome_final, 800 );
	
	if( move_uploaded_file( $arquivo_subir_array["tmp_name"], $pasta.$nome_final ) ){ //SOBE O ARQUIVO

		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? "https://" : "http://"; 
		$baseurl = $protocol . $_SERVER["HTTP_HOST"] . rtrim(dirname($_SERVER['REQUEST_URI']), "/") . "/"; 
		
		//echo json_encode( array( 'location' => $baseurl . $pasta . $nome_final ) );
		
	}
	else{
		
		echo'Falha no upload do arquivo.';
		return;
		
	}
	
}
/*End - SUBIR ARQUIVO*/

$hoje = date( 'Y-m-d H:i:s' );

$sql .= "INSERT INTO galeria_noticias (
	nome, 
	imagem, 
	noticia_id 
) VALUES (".
	"'". $nome_final ."', ".
	"'". $nome_final ."', ".
	"'". $noticia_id ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Subiu arquivo para pasta galeria: ".$pasta.$nome_final."','". date( 'Y-m-d H:i:s' ) ."');";
$conn->multi_query( $sql );
$conn->close();

echo $nome_final;

?>