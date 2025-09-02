<?php
//

$raiz_site = '../../../../';
$raiz_admin = '../../../';

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';

//dd( $_POST );

if(
	$_POST['nome'] == '' ||
	$_POST['usuario'] == '' ||
	$_POST['senha'] == '' ||
	$_POST['email'] == '' ||
	$_POST['tipo'] == '' ||
	$_POST['foto'] == '' ||
	$_POST['funcao'] == ''
){
	echo'<script>window.history.back();</script>';
	exit;
}

else if( strlen( $_POST['usuario'] ) <= 6 ){
	echo'<script>alert("O login precisa ter mais de 6 caracteres."); window.history.back();</script>';
	exit;
}

else if( strlen( $_POST['senha'] ) <= 6 ){
	echo'<script>alert("A senha precisa ter mais de 6 caracteres."); window.history.back();</script>';
	exit;
}

$foto = $_POST['foto'];
$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha_recebida = $_POST['senha'];
$email = $_POST['email'];
$funcao = $_POST['funcao'];
$tipo = $_POST['tipo'];
$tema = 'claro';

$senha = md5( $senha_recebida );

$sql = "INSERT INTO admin_user (
	nome,
	usuario,
	senha,
	email,
	tipo,
	foto,
	funcao,
	tema
) VALUES (".
	"'". $nome ."',".
	"'". $usuario ."',".
	"'". $senha ."',".
	"'". $email ."',".
	"'". $tipo ."',".
	"'". $foto ."',".
	"'". $funcao ."',".
	"'". $tema ."'".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Criou usuario ". $usuario ." de email: ". $email ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

$redirect = 'criar_menu.php?usuario='.$usuario.'&tipo='.$tipo;

//echo $redirect; die();
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

					echo'<script>window.location.href = "'. $redirect .'";</script>';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=admin_user" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

				$conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="../../../js/motor.js"></script>	
		
	</body>
	
</html>