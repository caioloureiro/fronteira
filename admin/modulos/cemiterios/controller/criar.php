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

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){
	echo'<script>window.history.back();</script>';
	exit;
}

if(
	$_POST['cemCodigo'] == '' 
	|| $_POST['cemNome'] == '' 
	|| $_POST['cemTelefone'] == '' 
	|| $_POST['cemEndereco'] == '' 
	|| $_POST['cemAtivo'] == '' 
){
	echo'<script>window.history.back();</script>';
	exit;
}

$cemCodigo = $_POST['cemCodigo'];
$cemNome = $_POST['cemNome'];
$cemTelefone = $_POST['cemTelefone'];
$cemEndereco = $_POST['cemEndereco'];
$cemEmail = $_POST['cemEmail'];
$cemDescricao = $_POST['cemDescricao'];
$cemAtivo = $_POST['cemAtivo'];

$hoje = date( 'Y-m-d H:i:s' ) ;
//dd( $hoje );

$sql = "INSERT INTO cemiterios (
	cemCodigo, 
	cemNome, 
	cemTelefone, 
	cemEndereco, 
	cemEmail, 
	cemDescricao, 
	cemAtivo 
) VALUES (".
	"". $cemCodigo .", ".
	"'". $cemNome ."', ".
	"'". $cemTelefone ."', ".
	"'". $cemEndereco ."', ".
	"'". $cemEmail ."', ".
	"'". $cemDescricao ."', ".
	"'". $cemAtivo ."' ".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: cemiterios. Criou o item ". $cemNome ."','". date( 'Y-m-d H:i:s' ) ."');";

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
					<a href="'. $raiz_admin .'matriz?pagina=cemiterios" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=cemiterios" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

    // NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php
    // $conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>