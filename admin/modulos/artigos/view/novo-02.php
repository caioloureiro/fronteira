<?php
//

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../../../model/conexao-off.php';

}else{
	
	require '../../../model/conexao-on.php';
	
}

require '../../../controller/funcoes.php';

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
		
		<style><?php require '../../../routes/css-modulo.php'; ?></style>
	
		<?php 
			
			$pasta_nome = 'img-noticias';
			$pasta = '../../../../img-noticias/';
		
			require '../../../view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<div class="lightbox artigo-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Artigo
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( ../../../img/fechar.svg );" ></div>
					
				</div>
				
				<div class="linha linha-auto">

					<div class="col10"><span>Imagem: </span></div>
					
					<?php
						$imagem_check = explode( '/', $_GET['arquivo'] );

						if(
							$imagem_check[0] == 'http:' ||
							$imagem_check[0] == 'https:'
						){

							$imagem = $_GET['arquivo'];
							
						}else{

							$imagem = $pasta. $_GET['arquivo'];
							
						}					
						
					?>

					<div class="col90"><div class="escolher-imagem-btn item-escolher-imagem-btn" onclick="abrir_item_imagens()" style="background-image:url( <?php echo $imagem ?>)"></div></div>
					<div class="linha"><div class="col10"><span>URL Imagem: </span></div><div class="col90"><input name="imagem" class="item-escolher-imagem-input" value="<?php echo $_GET['arquivo'] ?>"/></div></div>
					
				</div>
				
				<div class="separador"></div>
			
				<div class="linha"><div class="col10"><span>Rascunho: </span></div><div class="col05"><span><input name="publicado" type="checkbox" /></span></div></div>
				
				<div class="separador"></div>
				
				<div class="linha"><div class="col10"><span>Título: </span></div><div class="col90"><input name="titulo" /></div></div>
				
				<div class="separador"></div>

				<div class="linha linha-auto">
					<div class="col10"><span>Texto: </span></div><div class="col90 editor-container"><span class="editor_de_texto"></span></div>
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
			
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});

			function abrir_item_imagens(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-imagens').classList.add('on');
				
			}

			function sair_item_imagens(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.item-imagens').classList.remove('on');
				
			}
			
			function voltar(){
				
				window.history.back();
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>