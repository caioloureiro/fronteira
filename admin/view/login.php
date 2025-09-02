<div class="container login-container" itemscope>
	
	<div class="loading loading-on off"></div>
	
	<div class="login-circulo-box">
		<div class="login-circulo01"></div>
		<div class="login-circulo02"></div>
		<div class="login-circulo03"></div>
	</div>

	<div class="login-card">
	
		<div class="login-logo" style="background-image:url( ../<?php echo $logo ?> )"></div>
		
		<form method="POST" action="controller/seguranca.php">

			<div class="login-input-box"><input type="text" name="usuario" placeholder="Usuário"/></div>

			<div class="login-input-box"><input type="password" name="acesso" id="senha" placeholder="Senha"/><div class="login-ver"></div></div>

			<div class="login-btn-box"><button type="submit">Acessar</button></div>

		</form>
		
		<!--div class="login-esqueceu-senha"><a href="esqueci-a-senha.php">Esqueceu a senha?</a></div!-->
	
	</div>
	
</div>