<?php
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
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />

		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox cemiterios-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Cemitério
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemCodigo: </span>
					</div>
					<div class="col90">
						<input 
							name="cemCodigo" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemNome: </span>
					</div>
					<div class="col90">
						<input 
							name="cemNome" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemTelefone: </span>
					</div>
					<div class="col90">
						<input 
							name="cemTelefone" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemEndereco: </span>
					</div>
					<div class="col90">
						<input 
							name="cemEndereco" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemEmail: </span>
					</div>
					<div class="col90">
						<input 
							type="email"
							name="cemEmail" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemDescricao: </span>
					</div>
					<div class="col90">
						<input 
							name="cemDescricao" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>cemAtivo: </span>
					</div>
					<div class="col90">
						<select 
							name="cemAtivo" 
							required
						>
							<option value="S">Sim</option>
							<option value="N">Não</option>
						</select>
					</div>
				</div>

				<div class="separador"></div>
				
				<div class="linha-acao">
				
					<button type="submit">Gravar</button>
					<div class="btn" onclick="voltar()">Cancelar</div>
					
				</div>
				
				<div class="separador"></div>
				
			</form>

		</div>
		
		<script>
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=cemiterios';
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>