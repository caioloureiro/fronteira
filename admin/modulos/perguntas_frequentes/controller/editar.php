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
require $raiz_site .'model/perguntas_frequentes.php';

//dd( $_POST );

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){
	echo'<script>window.history.back();</script>';
	exit;
}

if(
	$_POST['categoria'] == '' 
){
	echo'<script>alert("Selecione a categoria."); window.history.back();</script>';
	exit;
}

$id = $_POST['id'];

$pergunta = $_POST['pergunta'];
$categoria = $_POST['categoria'];
$resposta = $_POST['editor_texto'];

$sql = "UPDATE perguntas_frequentes SET ".
"pergunta = '". $pergunta ."', ".
"resposta = '". $resposta ."', ".
"categoria = '". $categoria ."' ".
"WHERE id = ". $id .";";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: perguntas_frequentes. Editou o item: ". $pergunta ." de ID: ".$id."','". date( 'Y-m-d H:i:s' ) ."');";

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
					<script>
						alert("Item MODIFICADO com sucesso!"); 
						window.location.href = "'. $raiz_admin .'matriz?pagina=perguntas_frequentes";
					</script>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=perguntas_frequentes" ><div class="linha"><button>Retornar</button></div></a>
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