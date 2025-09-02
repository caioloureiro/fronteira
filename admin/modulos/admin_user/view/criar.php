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

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
	
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php
		
			require $raiz_admin .'view/escurecer.php';
			require $raiz_admin .'view/loading.php';
			echo'<script type="text/javascript" src="'. $raiz_admin .'js/motor.js"></script>';
			
		?>
		
		<div class="lightbox usuario-criar on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Usuário
					<div class="lightbox-fechar" onclick="voltar()"><?php require $raiz_admin .'img/fechar.svg'; ?></div>
					
				</div>
			
				<div class="linha">

					<div class="col05">Nome: </div>

					<div class="col95"><input name="nome" required /></div>
					
				</div>

				<div class="linha">

					<div class="col05">Senha: </div>

					<div class="col95"><input name="senha" required /></div>
					
				</div>

				<div class="linha">

					<div class="col05">E-mail: </div>

					<div class="col95"><input name="email" type="email" required /></div>
					
				</div>

				<div class="linha">

					<div class="col05">Setor: </div>

					<div class="col95"><input name="setor" required /></div>
					
				</div>

				<div class="linha">

					<div class="col05">Login: </div>

					<div class="col95"><input name="usuario" required /></div>
					
				</div>

				<div class="linha">

					<div class="col05">Tipo: </div>

					<div class="col95">
					
						<select name="tipo" class="select_padrao">
							<option value="">Escolha o tipo</option>
							<option>normal</option>
							<option>master</option>
						</select>
					
					</div>
					
				</div>

				<div class="linha-acao"> <button type="submit">Gravar</button> </div>
				
				<div class="separador"></div>
				
			</form>

		</div>
		
		<script>
		
			function voltar(){
				
				window.history.back();
				
			}
			
		</script>
		
	</body>
	
</html>