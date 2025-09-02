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
require $raiz_site .'model/acesso_rapido.php';

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
		
		<style>
			<?php require $raiz_admin .'routes/css-modulo.php'; ?>
			.input_texto{
				display:none;
			}
		</style>
	
		<?php 
			
			$pasta_nome = 'acesso-rapido';
			$pasta = $raiz_site .'acesso-rapido/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<?php 
			
			foreach( $acesso_rapido_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox acesso_rapido-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar Acesso Rápido: '. $item['titulo'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha linha-auto">

								<div class="col10"><span>Ícone: </span></div>
								
								';

									$imagem_check = explode( '/', $item['icone'] );

									if(
										$imagem_check[0] == 'http:' ||
										$imagem_check[0] == 'https:'
									){

										$imagem = $item['icone'];
										
									}else{

										$imagem = $pasta. $item['icone'];
										
									}					
									
								echo'

								<div class="col90"><div class="escolher-imagem-btn item-escolher-imagem-btn" onclick="abrir_item_imagens()" style="background-image:url( '. $imagem .')"></div></div>
								<div class="linha"><div class="col10"><span>URL Imagem: </span></div><div class="col90"><input name="icone" class="item-escolher-imagem-input" value="'. $item['icone'] .'"/></div></div>
								
							</div>
							
							<div class="separador"></div>
							
							<div class="linha">
								<div class="col10">
									<span>Título: </span>
								</div>
								<div class="col90">
									<input name="titulo" value="'. $item['titulo'] .'" />
								</div>
							</div>

							<div class="linha">
								<div class="col10">
									<span>Texto: </span>
								</div>
								<div class="col10">
									<span>
										<select name="possui_texto" class="possui_texto">
											<option 
												value="0"
												'; if( $item['possui_texto'] == 0 ){ echo'selected'; } echo'
											>Não</option>
											<option 
												value="1"
												'; if( $item['possui_texto'] == 1 ){ echo'selected'; } echo'
											>Sim</option>
										</select>
									</span>
								</div>
								<div 
									class="
										col80 
										input_texto
										'; if( $item['possui_texto'] == 1 ){ echo'on'; } echo'
									"
								>
									<input 
										name="texto"
										value="'. $item['texto'] .'"
									/>
								</div>
							</div>

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
									<span>Nova Página? </span>
								</div>
								<div class="col90">
									<span>
										<select name="target">
											<option value="_self" selected >Mesma página</option>
											<option value="_blank">Nova página</option>
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
			
			let possui_texto = document.querySelector('.possui_texto');
			let input_texto = document.querySelector('.input_texto');
			let input_texto_input = document.querySelector('.input_texto input');
			
			possui_texto.addEventListener('change', function() {

				input_texto_input.value = '';
				input_texto.classList.toggle("on");
				
			});
			
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=acesso_rapido';
				
			}
			
		</script>
		
	</body>
	
</html>