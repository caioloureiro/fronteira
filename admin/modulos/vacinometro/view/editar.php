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
require $raiz_site .'model/vacinometro.php';

$hoje = date( 'Y-m-d H:i:s' );

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
			
			foreach( $vacinometro_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox vacinometro-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Vacinômetro - Editar atualização: '. $item['data'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
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
										value="'. $item['data'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>1ª dose: </span>
								</div>
								<div class="col15">
									<input 
										type="number" 
										name="1_dose" 
										value="'. $item['1_dose'] .'"
									/>
								</div>
								<div class="col10">
									<span>2ª dose: </span>
								</div>
								<div class="col15">
									<input 
										type="number" 
										name="2_dose" 
										value="'. $item['2_dose'] .'"
									/>
								</div>
								<div class="col10">
									<span>3ª dose: </span>
								</div>
								<div class="col15">
									<input 
										type="number" 
										name="3_dose" 
										value="'. $item['3_dose'] .'"
									/>
								</div>
								<div class="col10">
									<span>4ª dose: </span>
								</div>
								<div class="col15">
									<input 
										type="number" 
										name="4_dose" 
										value="'. $item['4_dose'] .'"
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=vacinometro';
				
			}
			
		</script>
		
	</body>
	
</html>