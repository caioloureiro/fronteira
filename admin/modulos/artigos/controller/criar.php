<?php
//

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../../../model/conexao-off.php';

}else{
	
	require '../../../model/conexao-on.php';
	
}

require '../../../controller/funcoes.php';

//dd( $_POST );

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){
	echo'<script>window.history.back();</script>';
	exit;
}

if(
	$_POST['titulo'] == '' 
	|| $_POST['editor_texto'] == ''
	|| $_POST['imagem'] == ''
){
	echo'<script>window.history.back();</script>';
	exit;
}

$imagem = $_POST['imagem'];
$titulo = $_POST['titulo'];
$texto = $_POST['editor_texto'];

//dd( htmlspecialchars( $texto ) );

$publicado = 1;

if( 
	isset( $_POST['publicado'] ) 
	&& $_POST['publicado'] == 'on' 
){ $publicado = 0; }

//dd( $publicado );

$hoje = date( 'Y-m-d H:i:s' ) ;
//dd( $hoje );

$publicacao = $hoje;
$atualizacao = $hoje;
$destaque = 0;
$destaque_ordem = 0;


// PROTEÇÃO: Verificar se já existe (evitar duplicatas por submit múltiplo)
$check_duplicate = $conn->query("SELECT id FROM artigos WHERE titulo = '". $conn->real_escape_string($titulo) ."' LIMIT 1");
if ($check_duplicate && $check_duplicate->num_rows > 0) {
    $row_dup = $check_duplicate->fetch_assoc();
    echo '<script>alert("Este registro já foi criado (ID: '. $row_dup['id'] .'). Evite clicar múltiplas vezes no botão Gravar."); window.history.back();</script>';
    exit;
}

$sql = "INSERT INTO artigos (
	imagem,
	publicacao,
	atualizacao,
	titulo,
	texto,
	destaque,
	destaque_ordem,
	publicado
) VALUES (".
	"'". $imagem ."',".
	"'". $publicacao ."',".
	"'". $atualizacao ."',".
	"'". $titulo ."',".
	"'". $texto ."',".
	"'". $destaque ."',".
	"'". $destaque_ordem ."',".
	"'". $publicado ."'".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Criou o artigo ". $titulo ."','". date( 'Y-m-d H:i:s' ) ."');";

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
		
		<style><?php require '../../../routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
			
				if ( $conn->multi_query( $sql ) === TRUE ) {

					echo'
					<div class="alerta-verde">Item criado com sucesso.</div>
					<a href="../../../matriz?pagina=artigos" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="../../../matriz?pagina=artigos" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

    // NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php
    // $conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../../js/motor.js"></script>	
		
	</body>
	
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>