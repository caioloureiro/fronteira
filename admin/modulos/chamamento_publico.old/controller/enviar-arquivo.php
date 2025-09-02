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
	
/*Start - SUBIR ARQUIVO MULTI*/
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
	"vnd.openxmlformats-officedocument.spreadsheetml.sheet",
	"xlsx",
	"xls",
	"pdf",
	"zip",
	"rar",
	"doc",
	"docx",
	"xls",
	"xlsx",
	"bmp",
	"jpg",
	"jpeg",
	"png",
	"webp",
	"afiv",
);

$arquivo_aceito = 0;

$tamanho_maximo = 1024 * 200000; // 200Mb

$pasta = $raiz_site .'arquivos/';

$contagem = 0;

$hoje = date( 'Y-m-d H:i:s' );
//dd( $hoje );

require $raiz_admin .'controller/replace.php'; //ARQUIVO REPLACE.PHP COM ARRAY DE ITENS PARA SUBSTITUIR

//dd( $_FILES );

$arquivos_subir_array = $_FILES['arquivos_subir'];
//dd( $arquivos_subir_array );

//VERIFICAR QUANTOS ARQUIVOS VIERAM NO POST
$quantidade_de_arquivos = count( $arquivos_subir_array['name'] );
//dd( $quantidade_de_arquivos );

$sql = "";
$redirect = '';

//EXECUTAR UM FOR NA QUANTIDADE DE ARQUIVOS
for( $i = 0; $i < $quantidade_de_arquivos; $i++ ){
	
	$tipo_de_arquivo = explode( '/', trim( strip_tags( $arquivos_subir_array['type'][$i] ) ) );
	//dd( $tipo_de_arquivo );
	
	foreach( $formatos_validos as $allow ){ //ACEITAR TIPOS DE ARQUIVOS
		
		if( $tipo_de_arquivo[1] == $allow ){ 
			
			$arquivo_aceito = 1;
			
		}
		
	}

	//dd( $arquivo_aceito );
	
	if( $arquivo_aceito == 1 ){ //COMO SÃO VÁRIOS ARQUIVOS CADA IF VAI ATÉ O FINAL
		
		//dd( $arquivos_subir_array['error'][$i] );

		if( $arquivos_subir_array['error'][$i] == 0 ){ //SEM ERROS
			
			//dd( $arquivos_subir_array['size'][$i] .' > '. $tamanho_maximo );
			
			if( $arquivos_subir_array['size'][$i] <= $tamanho_maximo ) {
				
				/*Start - RENOMEAR ARQUIVO POR SEGURANÇA*/
				$name = $arquivos_subir_array['name'][$i];
				//dd( $name );
				
				$nome_final = '';
				
				$name = mb_strtolower( $name );
				
				$explodir_nome = explode( ' ', $name );
				
				$last_nome_numero = count( $explodir_nome ) - 1;
				
				$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
				
				$extensao_arquivo_recebido = $explodir_extensao[1];
				
				$nome_final = date('Y-m-d-H-i-s') .'-';
				
				for( $j = 0; $j < count( $explodir_nome ) - 1; $j++){
					
					if(
						$explodir_nome[$j] != '-' &&
						$explodir_nome[$j] != ''
					){ $nome_final .= $explodir_nome[$j] .'-';}
					
				}
				
				$nome_final .= $explodir_extensao[0];
				$nome_final .= '.'. $explodir_extensao[1];
				
				$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
				
				//dd( $nome_final );
				/*End - RENOMEAR ARQUIVO POR SEGURANÇA*/
				
				/*Start - ESCREVER ARQUIVO NA TABELA DOWNLOADS*/
				$sql .= "".
				"INSERT INTO downloads (".
					"nome, ".
					"link, ".
					"data, ".
					"tipo, ".
					"arquivo ".
				") VALUES ( ".
					"'". $name ."', ".
					"'#', ".
					"'". $hoje ."', ".
					"'".$tipo_de_arquivo[1] ."', ".
					"'". $nome_final ."' ".
				"); ".
				
				"INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ( ".
					"'". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ."',".
					"'Subiu o arquivo ( chamamento_publico ): ".$pasta.$nome_final."',".
					"'". date( 'Y-m-d H:i:s' ) ."'".
				"); ".
				"";
				
				//dd( $sql );
				/*End - ESCREVER ARQUIVO NA TABELA DOWNLOADS*/
				
				/*Start - MONTAR A URL DE ENVIO*/
				$redirect .= 'arquivo'. $i .'='. $nome_final .'&';
				/*End - MONTAR A URL DE ENVIO*/
				
				move_uploaded_file( $arquivos_subir_array["tmp_name"][$i], $pasta.$nome_final ); //SOBE O ARQUIVO
				
			}
			
		}
		
	}

	if( $arquivo_aceito == 0 ){
		
		echo'
		<script> 
			alert("O tipo de arquivo '. $tipo_de_arquivo[1] .' não é aceito.");
			alert("O arquivo '. $arquivos_subir_array['name'][$i] .' não subiu.");
		</script>
		';
		
	}
	
	if( $arquivos_subir_array['error'][$i] == 4 ) {
		
		echo'
		<script> 
			alert("Ocorreu um erro ao reconhecer o arquivo: '. $arquivos_subir_array['name'][$i] .'");
			alert("O arquivo '. $arquivos_subir_array['name'][$i] .' não subiu.");
		</script>
		';
		
	}
	
	if( $arquivos_subir_array['size'][$i] > $tamanho_maximo ) {

		echo'
		<script> 
			alert("O arquivo '. $arquivos_subir_array['name'][$i] .' é muito grande. Deve ser menor que 200MB.");
			alert("O arquivo '. $arquivos_subir_array['name'][$i] .' não subiu.");
		</script>
		';
		
	}
	
	
}
/*End - SUBIR ARQUIVO MULTI*/

//echo $sql; die();

$conn->multi_query( $sql );
$conn->close();

$redirect_final = '../view/novo-02?arquivos='. $quantidade_de_arquivos .'&'. mb_substr( $redirect, 0, -1 );
//echo $redirect_final; die();

echo'<script> window.location = "'. $redirect_final .'"; </script>';

?>