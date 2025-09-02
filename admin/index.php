<?php
$raiz_site = '../';
$raiz_admin = '';

require $raiz_admin .'controller/funcoes.php';
require $raiz_admin .'routes/model.php';
require $raiz_admin .'controller/components.php';
require $raiz_admin .'controller/info.php'; 
require $raiz_admin .'controller/auth.php';

/*Start - Barrar Brute Force*/
if( isset( $_POST['usuario'] ) ){
	
	if( !isset( $_COOKIE['tentativas'] ) ){
		
		$tentativas = 0;
		setcookie('tentativas', $tentativas, ( time() + ( 5 * 60 ) ), '/' ); // Cria o novo cookie para durar 5min
		
	}
	
	$tentativas++;
	setcookie('tentativas', $tentativas, ( time() + ( 5 * 60 ) ), '/' ); // Cria o novo cookie para durar 5min
	
	//echo '<p><pre>'. var_dump( $_COOKIE ) .'</pre></p>';
	
	if( isset( $_POST['zerar_tentativas'] ) ){
		
		$tentativas = 0;
		
	}
	
	if( $tentativas > 4 ){
		
		setcookie('fronteira_ADMIN_SESSION_usuario', 0, time() - 3600, '/'); // tempo negativo e/ou valor vazio: Delete cookie
		setcookie('fronteira_ADMIN_SESSION_senha', 0, time() - 3600, '/'); // tempo negativo e/ou valor vazio: Delete cookie
		
		echo'
		<h1 style="color:red;">Número de tentativas excedido.</h1>
		<p><form><button type="submit" name="zerar_tentativas">Clique aqui para retornar</button></form></p>
		';
		
		die();
		
	}
	
}
/*End - Barrar Brute Force*/

?>

<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>

		<title><?php echo $head_title ?></title>
		
		<?php require $raiz_admin .'view/head.php'; ?>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'css/login.css'; ?></style>
		
		<?php 
			require $raiz_admin .'controller/whitelist.php';
			require $raiz_admin .'view/login.php'; 
		?>
		
		<script><?php require $raiz_admin .'js/motor.js'; ?></script>
		
	</body>
</html>