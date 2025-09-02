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
require $raiz_site .'model/popup_paginas.php';

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
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
			
				foreach( $popup_paginas_array as $item ){
					
					if( $item['id'] == $_GET['id'] ){
						
						$alvo_nome = '';

						if( $item['alvo'] == 'pagina' ){ 
							require $raiz_site .'model/paginas.php';
							foreach( $paginas as $get ){
								if( $get['id'] == $item['alvo_id'] ){
									$alvo_nome = $get['titulo'];
								}
							}
						}
						if( $item['alvo'] == 'pagina_fixa' ){ 
							require $raiz_site .'model/paginas_fixas.php'; 
							foreach( $paginas_fixas as $get ){
								if( $get['id'] == $item['alvo_id'] ){
									$alvo_nome = $get['titulo'];
								}
							}
						}
						if( $item['alvo'] == 'noticia' ){ 
							require $raiz_site .'model/noticias.php'; 
							foreach( $noticias_array as $get ){
								if( $get['id'] == $item['alvo_id'] ){
									$alvo_nome = $get['titulo'];
								}
							}
						}
						if( $item['alvo'] == 'secretaria' ){ 
							require $raiz_site .'model/secretarias.php'; 
							foreach( $secretarias_array as $get ){
								if( $get['id'] == $item['alvo_id'] ){
									$alvo_nome = $get['titulo'];
								}
							}
						}
			
						echo'
						<div class="alerta-vermelho">
							Ao clicar em confirmar, você estará APAGANDO o popup da página:<br/>
							'. $alvo_nome .'
						</div>
						<div class="linha">
							<a href="'. $raiz_admin .'matriz?exemplo=popup_paginas" ><button>Retornar</button></a>
							<a href="../controller/excluir?id='. $item['id'] .'"><button class="btn-vermelho" onclick="return confirm(&apos;Tem certeza?&apos;)">Confirmar</button></a>
						</div>
						';
						
					}
					
				}

			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>