<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../model/conexao-off.php';

}else{
	
	require '../model/conexao-on.php';
	
}
//dd( $conn );

//dd( $_POST );

require '../model/usuarios.php';
//dd( $usuarios_array );

$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_criptografada = md5( $senha );
$login_ok = 0;

//dd( $senha_criptografada );
//dd( $_COOKIE );

if($email == ''){
	echo '<script> window.location.href = "../recados_raw?recado=1&titulo=Login&mensagem=Por favor, digite seu e-mail novamente.&btn_link=acesso-restrito-login"; </script>';
}
if($senha == ''){
	echo '<script> window.location.href = "../recados_raw?recado=1&titulo=Login&mensagem=Por favor, digite sua senha novamente.&btn_link=acesso-restrito-login"; </script>';
}

foreach( $usuarios_array as $usr ){

	if( $email == $usr['email'] ){
		
		if(
			$email == $usr['email'] &&
			$senha_criptografada == $usr['senha']
		){
			
			$login_ok = 1;
			
			/*Start - SET COOKIE*/
			setcookie( 'cidade_SESSION_usuario', $email, time() + ( ( ( 60 * 60 ) * 24 ) * 30 ), "/"); // 86400 = 1 dia
			setcookie( 'cidade_SESSION_senha', $senha_criptografada, time() + ( ( ( 60 * 60 ) * 24 ) * 30 ), "/"); // 86400 = 1 dia
			/*End - SET COOKIE*/
			
			//$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email ."','Fez login','". date( 'Y-m-d H:i:s' ) ."');";
			//$conn->multi_query( $sql ) or die( $conn->error );

			echo'<script> location.href = "../matriz" </script>';
			
			exit;
			
		}
		else{ //SE O E-MAIL ESTIVER CORRETO E A SENHA ERRADA.
			
			if( $usr['senha'] == md5('atualizar_senha') ){ 
			
				
				$mensagem ='
				<p>Olá. Seu e-mail: '. $email .' está cadastrado em nosso sistema.</p>
				<p>Estamos fazendo uma atualização cadastral. Você recebeu um e-mail com o link do formulário para atualizar sua senha. Obrigado.</p>
				';
				
				require 'enviar_atualizacao_cadastral.php';
				
				//$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email ."','Recebeu e-mail de atualização cadastral.','". date( 'Y-m-d H:i:s' ) ."');";
				//$conn->multi_query( $sql ) or die( $conn->error );
			
				echo '<script> window.location.href = "../recados_raw?recado=1&titulo=Login&mensagem='. $mensagem .'&btn_link=acesso-restrito-login"; </script>';
				
				exit;
				
			}
			
			if( $usr['senha'] != md5('atualizar_senha') ){ 
				
				//$sql = "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $email ."','Errou a senha.','". date( 'Y-m-d H:i:s' ) ."');";
				//$conn->multi_query( $sql ) or die( $conn->error );
				
				echo '<script> window.location.href = "../recados_raw?recado=1&titulo=Login&mensagem=A senha não confere.&btn_link=acesso-restrito-login"; </script>';
				
				exit;
				
			}
			
		}
		
	}
	
}

if( $login_ok == 0 ){ echo '<script> window.location.href = "../recados_raw?recado=1&titulo=Login&mensagem=Usuário inexistente.&btn_link=acesso-restrito-login"; </script>'; exit; }

?>