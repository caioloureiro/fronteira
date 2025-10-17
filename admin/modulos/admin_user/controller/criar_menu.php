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
require $raiz_site .'model/admin_user.php';
require $raiz_site .'model/menu_admin_start.php';
require $raiz_site .'model/menu_admin_sinc.php';

//dd( $_GET );

$tema = 'claro';
$get_usr = $_GET['usuario'];
$tipo = $_GET['tipo'];
$sql = '';

$usuario_id = '';
$categoria_id = '';
$menu_admin_id = '';

//dd( $get_usr );

foreach( $admin_user_array as $user ){
	
	//SE O USUÁRIO RECEBIDO NA URL FOR IGUAL AO USUARIO ( LOGIN ) DO BANCO
	if( $get_usr == $user['usuario'] ){
		
		$usuario_id = $user['id'];
	
	}

}

//dd( $usuario_id );

foreach( $menu_admin_start_array as $start ){
	
	//SE O TIPO DE USUÁRIO FOR DIFERENTE DE MASTER E IGUAL A PERMISSÃO DO BANCO
	if( 
		$tipo != 'master' &&
		$tipo == $start['permissao']
	){
		
		//dd( $start );
		
		foreach( $menu_admin_sinc_array as $sinc ){
			
			//SE O ID DO MENU INFORMADO EM START FOR IGUAL AO ID DO MENU INFORMADO EM SINC E A CATEGORIA NÃO FOR FAVORITOS
			//VAI REPETIR E PEGAR O ÚLTIMO VALOR
			if( 
				$start['menu_admin_id'] == $sinc['menu_admin_id'] &&
				$sinc['categoria_id'] != 1
			){
				
				$categoria_id = $sinc['categoria_id'];
				
			}
			
		}
		
		//dd( $categoria_id );
		
		$menu_admin_id = $start['menu_admin_id'];
		
		$sql .= "INSERT INTO menu_admin_sinc (
			categoria_id, 
			menu_admin_id, 
			usuario_id
		) VALUES (".
			"'". $categoria_id ."',".
			"'". $menu_admin_id ."',".
			"'". $usuario_id ."'".
		");";
		
	}
	
	//SE O TIPO DE USUÁRIO FOR IGUAL A MASTER PEGA TODOS OS ITENS
	if( $tipo == 'master' ){
		
		//dd( $start );
		
		foreach( $menu_admin_sinc_array as $sinc ){
			
			//SE O ID DO MENU INFORMADO EM START FOR IGUAL AO ID DO MENU INFORMADO EM SINC E A CATEGORIA NÃO FOR FAVORITOS
			//VAI REPETIR E PEGAR O ÚLTIMO VALOR
			if( 
				$start['menu_admin_id'] == $sinc['menu_admin_id'] &&
				$sinc['categoria_id'] != 1
			){
				
				$categoria_id = $sinc['categoria_id'];
				
			}
			
		}
		
		//dd( $categoria_id );
		
		$menu_admin_id = $start['menu_admin_id'];
		
		$sql .= "INSERT INTO menu_admin_sinc (
			categoria_id, 
			menu_admin_id, 
			usuario_id
		) VALUES (".
			"'". $categoria_id ."',".
			"'". $menu_admin_id ."',".
			"'". $usuario_id ."'".
		");";
	
	}

}

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Montou o menu para o usuário_id: ". $usuario_id ." e tipo: ". $tipo ."','". date( 'Y-m-d H:i:s' ) ."');";

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
					<div class="alerta-verde">Usuário criado com sucesso!</div>
					<a href="'.  $raiz_admin .'matriz?pagina=admin_user" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'.  $raiz_admin .'matriz?pagina=admin_user" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

    // NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php
    // $conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo  $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>