<!-- Start - admin/modulos/email_fale_conosco/wiew/home.php !-->
<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../';
$raiz_admin = '';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'model/email_fale_conosco.php';

$email_fale_conosco_ativado = '';
$email_fale_conosco_conteudo = '';
$email_fale_conosco_tipo = '';

foreach( $email_fale_conosco_array as $mail ){

	$host = $mail['host'];
	$smtp = $mail['smtp'];
	$email = $mail['email'];
	$senha = $mail['senha'];

}

?>

<style>
	<?php 
		require 'css/switch-btn.css'; 
		require 'css/card.css'; 
	?>
</style>

<div class="conteudo email_fale_conosco">
	
	<div class="titulo">E-mail Fale Conosco</div>
	
	<div class="conteudo-tabela-janela">

		<div class="card100">
			
			<div class="card-auto-item">
				
				<form action="modulos/email_fale_conosco/controller/editar.php" method="POST">
				
					<div class="card-linha">
						<div class="col10">
							<div class="card-auto-item-titulo">Host: </div>
						</div>
						<div class="col90">
							<span>
								<input 
									name="host" 
									required 
									value="<?php echo $host ?>"
								/>
							</span>
						</div>
					</div>
					<div class="card-linha">
						<div class="col10">
							<div class="card-auto-item-titulo">SMTP: </div>
						</div>
						<div class="col90">
							<span>
								<input 
									name="smtp" 
									required 
									value="<?php echo $smtp ?>"
								/>
							</span>
						</div>
					</div>
					<div class="card-linha">
						<div class="col10">
							<div class="card-auto-item-titulo">E-mail: </div>
						</div>
						<div class="col90">
							<span>
								<input 
									name="email" 
									required 
									value="<?php echo $email ?>"
								/>
							</span>
						</div>
					</div>
					<div class="card-linha">
						<div class="col10">
							<div class="card-auto-item-titulo">Senha: </div>
						</div>
						<div class="col90">
							<span>
								<input 
									name="senha" 
									required 
									value="<?php echo $senha ?>"
								/>
							</span>
						</div>
					</div>
					
					<div class="linha-acao"> 
						<button type="submit">Gravar</button> 
					</div>
					
				</form>
				
			</div>
			
		</div>
		
	</div>
	
</div>
<!-- End - admin/modulos/email_fale_conosco/wiew/home.php !-->