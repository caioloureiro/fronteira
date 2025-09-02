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
require $raiz_site .'model/enquete_respostas.php'; 
require $raiz_site .'model/enquete.php'; 

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
		
		<div class="lightbox enquete_respostas-visualizar on">
			
			<div class="lightbox-titulo">

				Resposta
				<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );"></div>
				
			</div>
			
			<div class="formulario_campo">
				
				<?php
					
					$enquete_id = 0;
				
					foreach( $enquete_respostas_array as $resp ){
		
						if( $resp['id'] == $_GET['id'] ){
							
							$respostas_array = explode( ';', trim( strip_tags( $resp['respostas'] ) ) );
							array_pop( $respostas_array );
							
							foreach( $respostas_array as $respItem ){
								
								$respItem_array = explode( '=', trim( strip_tags( $respItem ) ) );
								
								echo '
								<div class="linha">
									<div class="col20">
										<span>'. $respItem_array[0] .'</span>
									</div>
									<div class="col80">
										<span>'. $respItem_array[1] .'</span>
									</div>
								</div>
								';
								
								if( $respItem_array[0] == 'enquete_id' ){ $enquete_id = $respItem_array[1]; }
								
							}
							
						}
						
					}
					
				?>
				
			</div>

			<div class="linha-acao"> 
				<div class="btn" onclick="voltar()">Voltar</div>
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			function voltar(){
				
				window.location.href = 'visualizar?enquete_id=<?php echo $enquete_id ?>';
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>