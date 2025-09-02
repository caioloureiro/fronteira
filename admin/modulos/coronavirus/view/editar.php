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
require $raiz_site .'model/coronavirus.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			foreach( $coronavirus_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox coronavirus-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar atualização: '. $item['data'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data: </span>
								</div>
								<div class="col90">
									<input 
										name="data" 
										type="datetime-local"
										required
										value="'. $item['data'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Confirmados: </span>
								</div>
								<div class="col10">
									<input 
										name="confirmados" 
										type="number"
										value="'. $item['confirmados'] .'"
									/>
								</div>
								<div class="col10">
									<span>Descartados: </span>
								</div>
								<div class="col10">
									<input 
										name="descartados" 
										type="number"
										value="'. $item['descartados'] .'"
									/>
								</div>
								<div class="col10">
									<span>Óbitos: </span>
								</div>
								<div class="col10">
									<input 
										name="obitos" 
										type="number"
										value="'. $item['obitos'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Quarentena: </span>
								</div>
								<div class="col10">
									<input 
										name="quarentena" 
										type="number"
										value="'. $item['quarentena'] .'"
									/>
								</div>
								<div class="col10">
									<span>UTI: </span>
								</div>
								<div class="col10">
									<input 
										name="uti" 
										type="number"
										value="'. $item['uti'] .'"
									/>
								</div>
								<div class="col10">
									<span>Enfermaria: </span>
								</div>
								<div class="col10">
									<input 
										name="enfermaria" 
										type="number"
										value="'. $item['enfermaria'] .'"
									/>
								</div>
							</div>

							<div class="linha-acao"> 
								<button type="submit">Gravar</button> 
								<div class="btn" onclick="voltar()">Cancelar</div>
							</div>
							
							<div class="separador"></div>
							
						</form>

					</div>
					';
					
				}
				
			}
			
		?>
		
		<script>
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=coronavirus';
				
			}
			
		</script>
		
	</body>
	
</html>