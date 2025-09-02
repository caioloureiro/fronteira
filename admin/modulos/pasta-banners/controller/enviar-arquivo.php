<?php
//

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

require $raiz_site .'controller/funcoes.php';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

$formatos_validos = array(
	"zip",
	"jpg",
	"jpeg",
	"png",
	"gif",
	"bmp",
	"pdf",
	"zip",
	"rar",
	"webp"
);

$arquivo_bloqueado = 0;

$tamanho_maximo = 1024*1000000; // 1Gb

$pasta = $raiz_site .'banners/';

$contagem = 0;

//dd( $_FILES );

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />

		<link rel="stylesheet" href="<?php echo $raiz_site ?>css/dinamico.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/estilo.css"/>
		<link rel="stylesheet" href="<?php echo $raiz_admin ?>css/smartphone.css"/>
	</head>
	<body>
		
		<div class="box">
		
			<?php
			
				require $raiz_admin .'controller/replace.php';
			
				if( isset( $_POST ) and $_SERVER['REQUEST_METHOD'] == "POST" ){
					
					foreach( $_FILES['enviarArquivoItem']['name'] as $f => $name ){
						
						$tipo_de_arquivo = explode( '/', trim( strip_tags( $_FILES['enviarArquivoItem']['type'][$f] ) ) );
						
						//dd( $tipo_de_arquivo[1] );
						
						foreach( $formatos_validos as $allow ){
							
							if( $tipo_de_arquivo[1] == $allow ){ 
								
								$arquivo_bloqueado = 1;
								
							}
							
						}
						
						if( $arquivo_bloqueado == 0 ){
						
							echo'
							<script> 
								alert("O tipo de arquivo '. $tipo_de_arquivo[1] .' não é aceito.");
								window.history.back(); 
							</script>
							';
							
							exit; 
						
						}
						
						if($_FILES['enviarArquivoItem']['error'][$f] == 4) {

							continue;
							
						}

						if($_FILES['enviarArquivoItem']['error'][$f] == 0){

							if($_FILES['enviarArquivoItem']['size'][$f] > $tamanho_maximo) {

								$message[] = "$name é muito grande!.";

								continue;
								
							}
							
							$name = mb_strtolower( $name );
							
							$explodir_nome = explode( ' ', $name );
							
							$last_nome_numero = count( $explodir_nome ) - 1;
							
							$explodir_extensao = explode( '.', $explodir_nome[ $last_nome_numero ] );
							
							$extensao_arquivo_recebido = $explodir_extensao[1];
							
							$nome_final = '';
							
							$nome_final = date('Y-m-d-H-i-s') .'-';
							
							for( $i = 0; $i < count( $explodir_nome ) - 1; $i++){
								
								if(
									$explodir_nome[$i] != '-' &&
									$explodir_nome[$i] != ''
								){ $nome_final .= $explodir_nome[$i] .'-';}
								
							}
							
							$nome_final .= $explodir_extensao[0];
							$nome_final .= '.'. $explodir_extensao[1];
							
							$nome_final = str_replace( array_keys( $replace ), $replace, $nome_final );
							
							//dd( $nome_final );

							//NÃO VOU RENOMEAR AGORA:
							move_uploaded_file($_FILES["enviarArquivoItem"]["tmp_name"][$f], $pasta.$nome_final);
							
							$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('".$_COOKIE['fronteira_ADMIN_SESSION_usuario'] ."','banners: Subiu o arquivo: ".$pasta.$nome_final."','". date( 'Y-m-d H:i:s' ) ."');";
							$conn->multi_query( $sql );
							$conn->close();
							
							//NÃO VOU RENOMEAR AGORA:
							//echo'<script> window.location = "../view/novo-02?arquivo='. $nome_final .'"; </script>';
							echo'<script> window.location = "'. $raiz_admin .'matriz?pagina=pasta-banners"; </script>';
							
						}
						
					}
					
				}
				
			?>
			
		</div>
		
		<script>
			let copiar = document.querySelector('.copiar');
			let copiar_input = document.querySelector('.copiar_input');
			
			function copiar_texto(){
	
				copiar_input.select(); 
				copiar_input.setSelectionRange(0, 99999);
				document.execCommand("copy");				
				alert("Item copiado para área de transferência: " + copiar_input.value);
				
			}
		</script>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>