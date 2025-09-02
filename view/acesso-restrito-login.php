<!-- Start - view/acesso-restrito-login.php !-->
<?php

if(
	isset( $_COOKIE['cidade_SESSION_usuario'] ) &&
	isset( $_COOKIE['cidade_SESSION_senha'] )
){

	echo'<script> location.href = "matriz" </script>';

}

?>

<style><?php require 'css/acesso-restrito-login.css'; ?></style>

<section class="acesso-restrito-login" title="acesso-restrito-login">
	
	<div class="acesso-restrito-login-box">
	
		<div class="acesso-restrito-login-col01">
			
			<form action="controller/seguranca" method="POST">
				
				<div class="acesso-restrito-login-col01-titulo">Login</div>
				<div class="acesso-restrito-login-col01-txt">E-mail</div>
				<div class="acesso-restrito-login-col01-linha">
					<input 
						type="email" 
						class="acesso-restrito-login-col01-input" 
						name="email" 
						required 
					/>
				</div>
				<div class="acesso-restrito-login-col01-txt">Senha</div>
				<div class="acesso-restrito-login-col01-linha">
					<input 
						type="password" 
						class="acesso-restrito-login-col01-input" 
						id="senha" 
						name="senha" 
						required 
					/>
					<div class="acesso-restrito-login-col01-input-ver"></div>
				</div>
				<div class="acesso-restrito-login-col01-linha">
					<button class="acesso-restrito-login-col01-button" type="submit">Entrar</button>
				</div>
				
				<div class="acesso-restrito-login-col01-comentario">Se você ainda não é cadastrado, não perca tempo. <a href="cadastro">Cadastre-se agora</a></div>
				<!-- <div class="acesso-restrito-login-col01-comentario">Esqueceu a senha? <a href="./">Clique aqui</a></div> !-->
				
			</form>
		
		</div>
		
		<div class="acesso-restrito-login-col02">
			<div class="acesso-restrito-lente"></div>
			<div class="acesso-restrito-login-col02-titulo">Acesso Restrito</div>
			<div class="acesso-restrito-login-col02-txt">Faça seu cadastro gratuitamente. Com esse cadastro você poderá ter acesso a vários serviços de nosso portal, bem como gerenciar os seus consentimentos e preferências.</div>
		</div>
	
	</div>
	
</section>

<script>

/*Start - VISUALIZAR SENHA*/
let login_ver = document.querySelector('.acesso-restrito-login-col01-input-ver');

if( document.querySelector('.acesso-restrito-login-col01-input-ver') ){

	login_ver.addEventListener('click', function() {
		
		let input_alvo = document.getElementById('senha');
		let input_tipo = input_alvo.type;
		
		if( input_tipo == "password" ){

			document.getElementById('senha').type = "text";
			
		}
		
		if( input_tipo == "text" ){

			document.getElementById('senha').type = "password";
			
		}
		
	});

}
/*End - VISUALIZAR SENHA*/

</script>
<!-- End - view/acesso-restrito-login.php !-->