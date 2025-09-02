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
require $raiz_site .'model/paginas.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar paginas</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
	
	</head>
	<body>
		
		<style>
			<?php 
				require $raiz_admin .'routes/css-modulo.php'; 
			?>
			.info_pagina{
				display:none;
			}
		</style>
	
		<?php 
		
			require $raiz_admin .'view/escurecer.php'; 
			
			$pasta_nome = 'img';
			$pasta = $raiz_site .'img/';
			
			require 'imagens.php';
			require 'visualizar_pagina.php';
			
		?>
		
		<div class="box">
		
			<?php
				
				$editor_de_texto_valor = '';
				
				foreach( $paginas as $pag ){
					
					if( $pag['id'] == $_GET['id'] ){
						
						/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
						$editor_de_texto_json = json_encode( $pag['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
						//dd( $editor_de_texto_json );
						/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					
						echo'
						<div class="lightbox pagina-editar on">

							<form action="../controller/editar.php" method="POST">
							
								<input name="id" value="'. $pag['id'] .'" style="display:none" />
							
								<div class="lightbox-titulo">

									Editar Página: '. $pag['titulo'] .'
									<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
									
								</div>
							
								<div class="linha">

									<div class="col10"><span>Título: </span></div>

									<div class="col90"><input name="titulo" required value="'. $pag['titulo'] .'" /></div>
									
								</div>
								
								<div class="linha">
									<div class="col10">
										<span>Informações da página: </span>
									</div>
									<div class="col10">
										<span>
											<select 
												class="info" 
												name="info"
											>
												<option 
													value="0"
													'; if( $pag['info'] == 0 ){ echo 'selected'; } echo'
												>Não</option>
												<option 
													value="1"
													'; if( $pag['info'] == 1 ){ echo 'selected'; } echo'
												>Sim</option>
											</select>
										</span>
									</div>
									<div class="col20">
										<span><div class="btn" onclick="abrir_lightbox()">Preview</div></span>
									</div>
								</div>
								
								<div 
									class="
										info_pagina
										'; if( $pag['info'] == 1 ){ echo 'on'; } echo'
									"
								>
									
									<div class="separador"></div>
									
									<div class="linha linha-auto">

										<div class="col10"><span>Imagem: </span></div>
										
										<div class="col90">
											<div 
												class="escolher-imagem-btn item-escolher-imagem-btn" 
												onclick="abrir_item_imagens()" 
												style="background-image:url( '. $pasta.$pag['foto'] .' )"
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
													value="'. $pag['foto'] .'"
												/>
											</div>
										</div>
										
									</div>
									
									<div class="separador"></div>
									
									<div class="linha">
										<div class="col10">
											<span>Representante: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="representante" 
													value="'. $pag['representante'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Telefone: </span>
										</div>
										<div class="col10">
											<span>
												<input 
													name="telefone" 
													value="'. $pag['telefone'] .'"
												/>
											</span>
										</div>
										<div class="col10">
											<span>E-mail: </span>
										</div>
										<div class="col30">
											<span>
												<input 
													name="email" 
													value="'. $pag['email'] .'"
												/>
											</span>
										</div>
										<div class="col10">
											<span>Atendimento: </span>
										</div>
										<div class="col30">
											<span>
												<input 
													name="horario" 
													value="'. $pag['horario'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Endereço: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="endereco" 
													value="'. $pag['endereco'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Site: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="site" 
													value="'. $pag['site'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Facebook: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="facebook" 
													value="'. $pag['facebook'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Instagram: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="instagram" 
													value="'. $pag['instagram'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Twitter: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="twitter" 
													value="'. $pag['twitter'] .'"
												/>
											</span>
										</div>
									</div>
									
									<div class="linha">
										<div class="col10">
											<span>Google Maps: </span>
										</div>
										<div class="col90">
											<span>
												<input 
													name="localizacao" 
													value="'. htmlspecialchars( $pag['localizacao'] ) .'"
												/>
											</span>
										</div>
									</div>
									
								</div>
								
								<div class="separador"></div>
								
								<div class="linha linha-auto">
									<textarea id="editor" name="editor_texto"></textarea>
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
			
		</div>
		
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
			
			let info = document.querySelector('.info');
			let info_pagina = document.querySelector('.info_pagina');
			
			info.addEventListener('change', function() {
				
				if( info.value == '0' ){
					info_pagina.classList.remove("on");
				}
				if( info.value == '1' ){
					info_pagina.classList.add("on");
				}
				
			});

			function abrir_lightbox(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-visualizar_pagina').classList.add('on');
				
			}

			function fechar_lightbox(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.item-visualizar_pagina').classList.remove('on');
				
			}
			
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