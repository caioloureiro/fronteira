<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../';
$raiz_admin = '../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/admin_user.php';

//dd( $conn );
//dd( $_COOKIE );

$usuario_logando = $_POST['usuario'];
$senha_logando = $_POST['acesso'];
$senha_logando_criptografada = md5( $senha_logando );
$login_ok = 0;

//dd( $senha_logando_criptografada );

if($usuario_logando == ''){
	echo '<script> alert("Por favor, digite seu usuario."); window.location.href = "'. $raiz_admin .'"; </script>';
}
if($senha_logando == ''){
	echo '<script> alert("Por favor, digite sua senha."); window.location.href = "'. $raiz_admin .'"; </script>';
}

foreach( $admin_user_array as $usuario_logando_tabela ){

	if( $usuario_logando == $usuario_logando_tabela['usuario'] ){
		
		if(
			$usuario_logando == $usuario_logando_tabela['usuario'] &&
			$senha_logando_criptografada == $usuario_logando_tabela['senha']
		){
			
			/*Start - SET COOKIE*/
			setcookie( 'fronteira_ADMIN_SESSION_usuario', $usuario_logando, time() + ( ( ( 60 * 60 ) * 24 ) * 1 ), "/"); // 86400 = 1 dia
			setcookie( 'fronteira_ADMIN_SESSION_senha', $senha_logando_criptografada, time() + ( ( ( 60 * 60 ) * 24 ) * 1 ), "/"); // 86400 = 1 dia
			/*End - SET COOKIE*/
			
			$login_ok = 1;
			
			$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $usuario_logando ." - ". $_SERVER['REMOTE_ADDR'] ."','Fez login','". date( 'Y-m-d H:i:s' ) ."');";
			
			$conn->multi_query( $sql ) or die( $conn->error );
			
			echo'<script> location.href = "'. $raiz_admin .'matriz" </script>';
			
			exit;
			
		}else{
			
			$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $usuario_logando ." - ". $_SERVER['REMOTE_ADDR'] ."','Errou a senha do Admin.','". date( 'Y-m-d H:i:s' ) ."');";
			
			$conn->multi_query( $sql ) or die( $conn->error );
			
			echo'<script> alert("A senha nao confere."); window.location = "'. $raiz_admin .'"; </script>';
			
			exit;
			
		}
		
	}
	
}

if( $login_ok == 0 ){ 
	
	$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $usuario_logando ." - ". $_SERVER['REMOTE_ADDR'] ."','Tentou acessar o Admin. Usuário não cadastrado.','". date( 'Y-m-d H:i:s' ) ."');";
	
	$conn->multi_query( $sql ) or die( $conn->error );
	
	echo'<script> alert("Usuário inexistente."); window.location = "'. $raiz_admin .'"; </script>'; 
	
	exit; 

}

?>