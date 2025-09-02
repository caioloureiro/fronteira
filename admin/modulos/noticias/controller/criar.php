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

//dd( $_POST );

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){ echo'<script>alert("Sessão não iniciada."); window.history.back();</script>'; exit; }

if( $_POST['titulo'] == '' ){ echo'<script>alert("Titulo em branco."); window.history.back();</script>'; exit; }
if( $_POST['editor_texto'] == '' ){ echo'<script>alert("Texto em branco."); window.history.back();</script>'; exit; }
if( $_POST['imagem'] == '' ){ echo'<script>alert("Imagem em branco."); window.history.back();</script>'; exit; }

$hoje = date( 'Y-m-d H:i:s' ) ;
//dd( $hoje );

$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$legenda = $_POST['legenda'];
$data_publicacao = $_POST['data_publicacao'];
$data_atualizacao = $_POST['data_publicacao'];
$imagem = $_POST['imagem'];
$destaque = 0;
$destaque_ordem = 0;
$utilidade_publica = 0;
$categorias = $_POST['categorias'];
$texto = $_POST['editor_texto'];
$publicado = 1;

//dd( htmlspecialchars( $texto ) );

if( 
	isset( $_POST['publicado'] ) 
	&& $_POST['publicado'] == 'on' 
){ $publicado = 0; }

//dd( $publicado );

if( 
	isset( $_POST['utilidade_publica'] ) 
	&& $_POST['utilidade_publica'] == 'on' 
){ $utilidade_publica = 1; }

//dd( $utilidade_publica );

$titulo = str_replace( "'", "&apos;", $titulo );
$subtitulo = str_replace( "'", "&apos;", $subtitulo );
$legenda = str_replace( "'", "&apos;", $legenda );
$texto = str_replace( "'", "&apos;", $texto );

$sql = "INSERT INTO noticias (
	titulo,
	subtitulo,
	legenda,
	data_publicacao,
	data_atualizacao,
	imagem,
	destaque,
	destaque_ordem,
	utilidade_publica,
	categorias,
	texto,
	publicado
) VALUES (".
	"'". $titulo ."',".
	"'". $subtitulo ."',".
	"'". $legenda ."',".
	"'". $data_publicacao ."',".
	"'". $data_atualizacao ."',".
	"'". $imagem ."',".
	"'". $destaque ."',".
	"'". $destaque_ordem ."',".
	"'". $utilidade_publica ."',".
	"'". $categorias ."',".
	"'". $texto ."',".
	"'". $publicado ."'".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Criou o noticia ". $titulo ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

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
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
			
				if ( $conn->multi_query( $sql ) === TRUE ) {

					echo'
					<div class="alerta-verde">Item criado com sucesso.</div>
					<a href="'. $raiz_admin .'matriz?pagina=noticias" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=noticias" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

				$conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>