<?php
//

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
require $raiz_site .'model/menu_admin.php';
require $raiz_site .'model/menu_admin_sinc.php';
require $raiz_site .'model/admin_user.php';

//dd( $_GET );
//dd( $menu_admin_array );
//dd( $menu_admin_sinc_array );
//dd( $admin_user_array );
//dd( $_COOKIE );

foreach( $admin_user_array as $usr ){

	if( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $usr['usuario'] ){
	
		$usuario_id = $usr['id'];
		$usuario_nome = $usr['nome'];
		$usuario_senha = $usr['senha'];
		$usuario_email = $usr['email'];
		$usuario_funcao = $usr['funcao'];
		$usuario_usr = $usr['usuario'];
		$usuario_tipo = $usr['tipo'];
		$usuario_foto = $usr['foto'];
		$usuario_tema = $usr['tema'];
		
	}
	
}

//dd( $usuario_id );

$esta_favoritado = $_GET['esta_favoritado'];
$menu_id = $_GET['menu_id'];
$menu_sinc_id = 0;
if( isset( $_GET['menu_sinc_id'] ) ){ $menu_sinc_id = $_GET['menu_sinc_id']; }

$favorito_ja_existe = 'nao';

foreach( $menu_admin_sinc_array as $check ){

	if( 
		$check['categoria_id'] == 1 &&
		$menu_id == $check['menu_admin_id'] &&
		$usuario_id == $check['usuario_id'] 
	){
		
		$favorito_ja_existe = 'sim';
		
	}
	
}

//dd( $favorito_ja_existe );

if( 
	$esta_favoritado == 'nao' &&
	$favorito_ja_existe == 'sim'
){
	
	echo'
	<script>
		alert("Este item já está favoritado.");
		window.history.back();
	</script>
	';
	exit;
	
}

if( 
	$esta_favoritado == 'nao' &&
	$favorito_ja_existe == 'nao'
){  

	$sql = "
	INSERT INTO `menu_admin_sinc` (
		`categoria_id`,
		`menu_admin_id`, 
		`usuario_id` 
	) VALUES 
	( 
		'1', 
		'". $menu_id ."', 
		'". $usuario_id ."' 
	); 
	";

	$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Favoritou o menu de ID: ".$menu_id."','". date( 'Y-m-d H:i:s' ) ."');";

}

if( 
	$esta_favoritado == 'sim' &&
	$favorito_ja_existe == 'sim'
){

	$sql = "UPDATE menu_admin_sinc SET ".
	"ativo = '0' ".
	"WHERE id = ". $menu_sinc_id .";";

	$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Excluiu o favorito menu_sinc de ID: ".$menu_sinc_id."','". date( 'Y-m-d H:i:s' ) ."');";
}


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

					echo'<script>window.location.href = "'. $raiz_admin .'matriz";</script>';
					
				} else {

					echo'
					<div class="alerta-vermelho">Erro: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz" ><div class="linha"><button>Retornar</button></div></a>
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