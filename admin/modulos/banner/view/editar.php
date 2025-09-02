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
require $raiz_site .'model/banner.php';

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
			
			$pasta_nome = 'banners';
			$pasta = $raiz_site .'banners/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
			foreach( $banner_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox exemplo-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar banner:
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha linha-auto">

								<div class="col10"><span>Imagem: </span></div>
								
								';

									$imagem_check = explode( '/', $item['id'] );

									if(
										$imagem_check[0] == 'http:' ||
										$imagem_check[0] == 'https:'
									){

										$imagem = $item['imagem'];
										
									}else{

										$imagem = $pasta. $item['imagem'];
										
									}					
									
								echo'

								<div class="col90">
									<div 
										class="escolher-imagem-btn item-escolher-imagem-btn" 
										onclick="abrir_item_imagens()" 
										style="background-image:url( '. $imagem .')"
									></div>
								</div>
								
								<div class="linha">
									<div class="col10">
										<span>URL Imagem: </span>
									</div>
									<div class="col90">
										<input 
											name="imagem" 
											class="item-escolher-imagem-input" 
											value="'. $item['imagem'] .'"
										/>
									</div>
								</div>
								
							</div>
							
							<div class="separador"></div>
							
							<div class="linha">
								<div class="col10">
									<span>Link: </span>
								</div>
								<div class="col90">
									<input 
										name="link"
										value="'. $item['link'] .'"
									/>
								</div>
							</div>

							<div class="linha">
								<div class="col10">
									<span>Nova página? </span>
								</div>
								<div class="col90">
									<span>
										<select name="target">
											<option 
												value="_self" 
												'; if( $item['target'] == '_self' ){ echo'selected'; } echo' 
											>Mesma página</option>
											<option 
												value="_blank"
												'; if( $item['target'] == '_blank' ){ echo'selected'; } echo' 
											>Nova página</option>
										</select>
									</span>
								</div>
							</div>
							
							<div class="separador"></div>
				
							<div class="linha-acao">
							
								<button type="submit">Gravar</button>
								<div class="btn" onclick="voltar()">Cancelar</div>
								
							</div>
							
						</form>

					</div>
					';
					
				}
				
			}
			
		?>
		
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=banner';
				
			}
			
		</script>
		
	</body>
	
</html>