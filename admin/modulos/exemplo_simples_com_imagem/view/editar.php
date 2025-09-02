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
require $raiz_site .'model/exemplos.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar exemplo</title>
		
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto-novo/assets/estilo.css"/>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$pasta_nome = 'img';
			$pasta = $raiz_site .'img/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
			$editor_de_texto_valor = '';
			
			foreach( $exemplos_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox exemplos-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar exemplo: '. $item['nome'] .'
								<div 
									class="lightbox-fechar" 
									onClick="voltar()" 
									style="background-image:url( '. $raiz_admin .'img/fechar.svg );"
								></div>
								
							</div>
							
							<div class="linha linha-auto">

								<div class="col10"><span>Imagem: </span></div>
								
								';
									$imagem_check = explode( '/', $item['imagem'] );

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
										style="background-image:url( '. $imagem .' )"
									>
									</div>
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
									<span>Nome: </span>
								</div>
								<div class="col90">
									<input 
										name="nome" 
										required 
										value="'. $item['nome'] .'"
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
										required 
										value="'. $item['link'] .'"
									/>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								<div class="editor-container editor_de_texto"></div>
							</div>
							
							<div class="separador"></div>

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
		
		<script src="https://digitalmd.com.br/editor-de-texto-novo/assets/motor.js"></script>
		
		<script>
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			
			//console.log( editor_de_texto_json );
			
			document.querySelector('.editor_de_texto .recebe').value = editor_de_texto_json;
			document.querySelector('.editor_de_texto #text-input').innerHTML = editor_de_texto_json;
			/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=exemplos';
				
			}
			
		</script>
		
	</body>
	
</html>