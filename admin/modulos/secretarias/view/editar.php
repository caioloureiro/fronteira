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
require $raiz_site .'model/secretarias.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar secretarias</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style>
			<?php require $raiz_admin .'routes/css-modulo.php'; ?>
		</style>
		
		<?php 
			
			$pasta_nome = 'secretarias';
			$pasta = $raiz_site .'secretarias/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
			$editor_de_texto_valor = '';
			
			foreach( $secretarias_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox secretarias-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar Página: '. $item['titulo'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha linha-auto">

								<div class="col10"><span>Foto: </span></div>
								
								';

									$imagem_check = explode( '/', $item['foto'] );

									if(
										$imagem_check[0] == 'http:' ||
										$imagem_check[0] == 'https:'
									){

										$imagem = $item['foto'];
										
									}else{

										$imagem = $pasta. $item['foto'];
										
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
											name="foto" 
											class="item-escolher-imagem-input" 
											value="'. $item['foto'] .'"
										/>
									</div>
								</div>
								
							</div>
							
							<div class="separador"></div>
							
							<div class="linha">
								<div class="col10">
									<span>Página*: </span>
								</div>
								<div class="col90">
									<input 
										name="pagina" 
										value="'. $item['pagina'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Título*: </span>
								</div>
								<div class="col90">
									<input 
										name="titulo" 
										value="'. $item['titulo'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Representante: </span>
								</div>
								<div class="col90">
									<input 
										name="secretario" 
										value="'. $item['secretario'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Endereço: </span>
								</div>
								<div class="col90">
									<input 
										name="endereco" 
										value="'. $item['endereco'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Atendimento: </span>
								</div>
								<div class="col90">
									<input 
										name="horario" 
										value="'. $item['horario'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Google Maps: </span>
								</div>
								<div class="col90">
									<input 
										name="localizacao" 
										value="'. htmlspecialchars( $item['localizacao'] ) .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								
								<div class="col10">
									<span>E-mail: </span>
								</div>
								<div class="col15">
									<input 
										name="email" 
										value="'. $item['email'] .'"
									/>
								</div>
							
								<div class="col05">
									<span>Telefone: </span>
								</div>
								<div class="col10">
									<input 
										name="telefone" 
										value="'. $item['telefone'] .'"
									/>
								</div>
								
							</div>
							
							<div class="linha">
							
								<div class="col10">
									<span>Site: </span>
								</div>
								<div class="col40">
									<input 
										name="site" 
										value="'. $item['site'] .'"
									/>
								</div>
							
								<div class="col10">
									<span>Facebook: </span>
								</div>
								<div class="col40">
									<input 
										name="facebook" 
										value="'. $item['facebook'] .'"
									/>
								</div>
								
							</div>
							
							<div class="linha">
							
								<div class="col10">
									<span>Instagram: </span>
								</div>
								<div class="col40">
									<input 
										name="instagram" 
										value="'. $item['instagram'] .'"
									/>
								</div>
							
								<div class="col10">
									<span>X (Twitter): </span>
								</div>
								<div class="col40">
									<input 
										name="twitter" 
										value="'. $item['twitter'] .'"
									/>
								</div>
								
							</div>
							
							<div class="separador"></div>
								
							<div class="linha linha-auto">
								<textarea id="editor" name="editor_texto"></textarea>
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			
			console.log( editor_de_texto_json );
			
			//document.querySelector('.editor_de_texto .recebe').value = editor_de_texto_json;
			//document.querySelector('.editor_de_texto #text-input').innerHTML = editor_de_texto_json;
			
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			editor.value = editor_de_texto_json;
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
				
				window.history.back();
				
			}
		</script>
		
	</body>
	
</html>