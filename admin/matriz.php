<?php
$raiz_site = '../';
$raiz_admin = '';

if(
	isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) &&
	isset( $_COOKIE['fronteira_ADMIN_SESSION_senha'] )
){

	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
	date_default_timezone_set('America/Sao_Paulo');

	if( $_SERVER['HTTP_HOST'] == 'localhost' ){

		require $raiz_site .'model/conexao-off.php';

	}else{
		
		require $raiz_site .'model/conexao-on.php';
		
	}
	
	require $raiz_site .'controller/funcoes.php';
	require $raiz_admin .'routes/model.php';
	require $raiz_admin .'controller/components.php';
	require $raiz_admin .'controller/info.php';
	
	foreach( $admin_user_array as $usuario_tabela ){
		
		if( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $usuario_tabela['usuario'] ){
		
			$usuario_id = $usuario_tabela['id'];
			$usuario_nome = $usuario_tabela['nome'];
			$usuario_senha = $usuario_tabela['senha'];
			$usuario_email = $usuario_tabela['email'];
			$usuario_funcao = $usuario_tabela['funcao'];
			$usuario_usr = $usuario_tabela['usuario'];
			$usuario_tipo = $usuario_tabela['tipo'];
			$usuario_foto = $usuario_tabela['foto'];
			$usuario_tema = $usuario_tabela['tema'];
			
		}
		
	}

}else{
	
	echo'
	<script>
		alert("Sessão não iniciada.");
		location.href = "./"
	</script>
	';
	
}

?>

<!DOCTYPE HTML>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<title><?php echo $head_title ?></title>
		<?php require $raiz_admin .'view/head.php' ?>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css.php'; ?></style>
		
		<?php
		
			require $raiz_admin .'view/versao.php';
			require $raiz_admin .'controller/whitelist.php';
		
			/*Start - Dialogos*/
			require $raiz_admin .'view/escurecer.php';
			require $raiz_admin .'view/tutoriais-lista.php';
			/*End - Dialogos*/
			
			require $raiz_admin .'view/topo.php';
			require $raiz_admin .'view/box-usuario.php';
			require $raiz_admin .'view/menu.php';
			
			$pagina_existe = 'nao';
			$pagina = '';
			$matriz = '';
			
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			//echo'<script> alert("$actual_link:\n '. $actual_link .'"); </script>';
			$url_array = explode( '/', trim( strip_tags( $actual_link ) ) );
			$matriz = $url_array[ count( $url_array ) - 1 ];
			//echo'<script> alert("$matriz:\n '. $matriz .'"); </script>';

			if( isset( $_GET['pagina'] ) ){ $pagina = $_GET['pagina']; }

			if( $matriz == 'matriz' ){
				
				//echo'<script> alert("home"); </script>';
				require $raiz_admin .'view/home.php';
				$pagina_existe = 'sim';
				
			}
			
			if( $pagina != '' ){

				/* Start - MODULOS*/
				foreach( $modulos_admin_array as $modulo ){

					if( $_GET['pagina'] == $modulo['nome'] ){
					
						require $raiz_admin .'modulos/'. $modulo['nome'] .'/view/home.php';
						$pagina_existe = 'sim';
						
					}

				}
				/*End - MODULOS*/

				/* Start - PAGINAS*/
				foreach( $paginas_admin_array as $pagina ){

					if( $_GET['pagina'] == $pagina['nome'] ){
					
						require $raiz_admin .'view/'. $pagina['nome'] .'.php';
						$pagina_existe = 'sim';
						
					}

				}
				/*End - PAGINAS*/
				
			}
			
			if( $pagina_existe == 'nao' ){ require $raiz_admin .'view/404.php'; } //PÁGINA NÃO EXISTE
			
			require $raiz_admin .'view/loading.php';
			require $raiz_admin .'view/scripts.php';
			echo'<script type="text/javascript" src="js/gaveta.js"></script>';
			
		?>
		
	</body>
</html>