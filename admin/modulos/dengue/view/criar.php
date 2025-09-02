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

$hoje = date( 'Y-m-d H:i:s' );

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
	
		<div class="lightbox dengue-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Dengue: Nova atualização
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Data: </span>
					</div>
					<div class="col90">
						<input 
							type="datetime-local" 
							name="data" 
							required
							value="<?php echo $hoje ?>"
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Confirmados: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="confirmados" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Descartados: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="descartados" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Aguardando: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="aguardando" 
							value="0"
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Notificações: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="notificacoes" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Casos Auctones: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_autoctones" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Casos Importados: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_importados" 
							value="0"
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Norte: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_regiao_norte" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Sul: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_regiao_sul" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Central: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_regiao_central" 
							value="0"
						/>
					</div>
				</div>

				<div class="linha">
					<div class="col10">
						<span>Leste: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_regiao_leste" 
							value="0"
						/>
					</div>
					<div class="col10">
						<span>Oeste: </span>
					</div>
					<div class="col10">
						<input 
							type="number" 
							name="casos_regiao_oeste" 
							value="0"
						/>
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=dengue';
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>