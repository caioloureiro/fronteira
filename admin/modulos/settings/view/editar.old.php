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
require '../../../model/settings_admin.php';

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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
	</head>
	<body>
		
		<style><?php require '../../../routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
				
				require '../../../view/escurecer.php';
				require 'imagens.php';
				require 'favicon.php';
				require 'img_redes.php';
				
				foreach( $settings_admin_array as $cfg ){
					
					if( $cfg['id'] == $_GET['id'] ){
						
						$imagem_check = explode( '/', $cfg['logo'] );
						if(
							$imagem_check[0] == 'http:' ||
							$imagem_check[0] == 'https:'
						){

							$imagem = $cfg['logo'];
							
						}else{

							$imagem = '../../../'. $cfg['logo'];
							
						}
						
						$favicon_check = explode( '/', $cfg['head_favicon'] );
						if(
							$favicon_check[0] == 'http:' ||
							$favicon_check[0] == 'https:'
						){

							$favicon = $cfg['head_favicon'];
							
						}else{

							$favicon = '../../../'. $cfg['head_favicon'];
							
						}
						
						$img_redes_check = explode( '/', $cfg['head_imagem'] );
						if(
							$img_redes_check[0] == 'http:' ||
							$img_redes_check[0] == 'https:'
						){

							$img_redes = $cfg['head_imagem'];
							
						}else{

							$img_redes = '../../../'. $cfg['head_imagem'];
							
						}
					
						echo'
						<div class="lightbox cfg-criar on">

							<form action="../controller/editar.php" method="POST">
							
								<input name="id" value="'. $cfg['id'] .'" style="display:none" />
							
								<div class="lightbox-titulo">
									Configurações
									<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( ../../../img/fechar.svg );"></div>
								</div>
								
								<div class="linha linha-auto">
									<div class="col10">Logo: </div>
									<div class="col90"><div class="escolher-imagem-btn item-escolher-imagem-btn" onclick="abrir_item_imagens()" style="background-image:url( '. $imagem .' ); background-size:auto 100%;"></div></div>
								</div>
								<div class="linha"><div class="col10">URL Logo: </div><div class="col90"><input name="logo" class="item-escolher-imagem-input" value="'. $cfg['logo'] .'"/></div></div>
								
								<div class="separador"></div>

								<div class="linha linha-auto">
									<div class="col10">Favicon: </div>
									<div class="col40"><div class="escolher-imagem-btn item-escolher-favicon-btn" onclick="abrir_item_favicon()" style="background-image:url( '. $favicon .' ); background-size:auto 100%;"></div></div>
									
									<div class="col10">Imagem Redes: </div>
									<div class="col40"><div class="escolher-imagem-btn item-escolher-img_redes-btn" onclick="abrir_item_img_redes()" style="background-image:url( '. $img_redes .' ); background-size:auto 100%;"></div></div>
								</div>
								<div class="linha">
									<div class="col10">URL Favicon: </div>
									<div class="col40"><input name="head_favicon" class="item-escolher-favicon-input" value="'. $cfg['head_favicon'] .'"/></div>
									
									<div class="col10">URL Img Redes: </div>
									<div class="col40"><input name="head_imagem" class="item-escolher-img_redes-input" value="'. $cfg['head_imagem'] .'"/></div>
								</div>
								
								<div class="separador"></div>
								
								<div class="linha">
									<div class="col10">Nome: </div>
									<div class="col90"><input name="head_nome" required value="'. $cfg['head_nome'] .'" /></div>
								</div>
								<div class="linha">
									<div class="col10">Título: </div>
									<div class="col90"><input name="head_title" required value="'. $cfg['head_title'] .'" /></div>
								</div>
								<div class="linha">
									<div class="col10">URL: </div>
									<div class="col90"><input name="head_link" required value="'. $cfg['head_link'] .'" /></div>
								</div>
								<div class="linha">
									<div class="col10">Descrição: </div>
									<div class="col90"><textarea name="head_description">'. $cfg['head_description'] .'</textarea></div>
								</div>
								
								<div class="separador"></div>
								
								<div class="linha">
									<div class="col10">Boas-vindas: </div>
									<div class="col90"><textarea name="boas_vindas">'. $cfg['boas_vindas'] .'</textarea></div>
								</div>
								
								<div class="separador"></div>
								
								<div class="linha">
									<div class="col10">Cidade: </div>
									<div class="col20"><input name="cidade" required value="'. $cfg['cidade'] .'" /></div>
									<div class="col05">Estado: </div>
									<div class="col10"><input name="estado" required value="'. $cfg['estado'] .'" /></div>
									<div class="col05">UF: </div>
									<div class="col10"><input name="uf" required value="'. $cfg['uf'] .'" /></div>
									<div class="col05">País: </div>
									<div class="col10"><input name="pais" required value="'. $cfg['pais'] .'" /></div>
								</div>

								<div class="linha-acao"> <button type="submit">Gravar</button> </div>
								
								<div class="separador"></div>
								
							</form>

						</div>
						';
					
					}
				
				}
				
			?>
			
		</div>
		
		<script>
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});
			
			function sair_item_nova(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.item-nova').classList.remove('on');
				
			}

			function abrir_item_imagens(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-imagens').classList.add('on');
				
			}

			function abrir_item_favicon(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-favicon').classList.add('on');
				
			}
			
			function abrir_item_img_redes(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-img_redes').classList.add('on');
				
			}
			
			function voltar(){
				
				window.location.href = '../../../matriz';
				
			}
		</script>
		
	</body>
	
</html>