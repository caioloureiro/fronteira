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
require $raiz_site .'model/menu.php';

//dd( $_POST );

$sql = '';

if( isset( $_POST['item_nova_ordem_1'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '1' ".
	"WHERE id = ". $_POST['item_nova_ordem_1'] .";";
}

if( isset( $_POST['item_nova_ordem_2'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '2' ".
	"WHERE id = ". $_POST['item_nova_ordem_2'] .";";
}

if( isset( $_POST['item_nova_ordem_3'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '3' ".
	"WHERE id = ". $_POST['item_nova_ordem_3'] .";";
}

if( isset( $_POST['item_nova_ordem_4'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '4' ".
	"WHERE id = ". $_POST['item_nova_ordem_4'] .";";
}

if( isset( $_POST['item_nova_ordem_5'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '5' ".
	"WHERE id = ". $_POST['item_nova_ordem_5'] .";";
}

if( isset( $_POST['item_nova_ordem_6'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '6' ".
	"WHERE id = ". $_POST['item_nova_ordem_6'] .";";
}

if( isset( $_POST['item_nova_ordem_7'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '7' ".
	"WHERE id = ". $_POST['item_nova_ordem_7'] .";";
}

if( isset( $_POST['item_nova_ordem_8'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '8' ".
	"WHERE id = ". $_POST['item_nova_ordem_8'] .";";
}

if( isset( $_POST['item_nova_ordem_9'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '9' ".
	"WHERE id = ". $_POST['item_nova_ordem_9'] .";";
}

if( isset( $_POST['item_nova_ordem_10'] ) ){
	$sql .= "UPDATE menu SET ".
	"ordem = '10' ".
	"WHERE id = ". $_POST['item_nova_ordem_10'] .";";
}

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Mudou a ordem dos destaques de menu','". date( 'Y-m-d H:i:s' ) ."');";

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
			
				if ($conn->multi_query( $sql ) === TRUE) {

					echo'
					<div class="alerta-verde">Ordem modificada com sucesso!</div>
					<a href="'. $raiz_admin .'matriz?pagina=menu" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Erro: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=menu" ><div class="linha"><button>Retornar</button></div></a>
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