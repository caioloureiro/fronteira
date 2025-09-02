<?php
//

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../../../../model/conexao-off.php';

}else{
	
	require '../../../../model/conexao-on.php';
	
}

require '../../../../controller/funcoes.php';
require '../../../../model/artigos.php';

//dd( $_POST );

$sql = '';

if( isset( $_POST['noticia_nova_ordem_1'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '1' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_1'] .";";
}

if( isset( $_POST['noticia_nova_ordem_2'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '2' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_2'] .";";
}

if( isset( $_POST['noticia_nova_ordem_3'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '3' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_3'] .";";
}

if( isset( $_POST['noticia_nova_ordem_4'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '4' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_4'] .";";
}

if( isset( $_POST['noticia_nova_ordem_5'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '5' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_5'] .";";
}

if( isset( $_POST['noticia_nova_ordem_6'] ) ){
	$sql .= "UPDATE artigos SET ".
	"destaque_ordem = '6' ".
	"WHERE id = ". $_POST['noticia_nova_ordem_6'] .";";
}

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Mudou a ordem dos destaques de artigos','". date( 'Y-m-d H:i:s' ) ."');";

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
			
				if ($conn->multi_query( $sql ) === TRUE) {

					echo'
					<div class="alerta-verde">Ordem modificada com sucesso!</div>
					<a href="../../../matriz?pagina=artigos" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Erro: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="../../../matriz?pagina=artigos" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

				$conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../js/motor.js"></script>	
		
	</body>
	
</html>