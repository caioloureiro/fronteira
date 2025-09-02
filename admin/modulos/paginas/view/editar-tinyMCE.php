<?php
//

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
		<title>Painel de Controle</title>

		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
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
			
		?>
		
		<div class="box">
		
			<?php
				
				require $raiz_admin .'view/escurecer.php';
				
				foreach( $paginas as $pag ){
					
					if( $pag['id'] == $_GET['id'] ){
					
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
									<div class="col10"><span>Texto: </span></div><div class="col90"><textarea class="tinyMCE" name="editor_texto">'. $pag['texto'] .'</textarea></div>
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
		
		<?php 
			/*Login no TinyMCE com a conta do Google*/
			$chave_TinyMCE = '19qrwrck1ohw2pd7g0s9c5d6ijtxo6rws7l14ruuinbd62ix'; 
		?>
		
		<script
			type="text/javascript"
			src='https://cdn.tiny.cloud/1/<?php echo $chave_TinyMCE ?>/tinymce/6/tinymce.min.js'
			referrerpolicy="origin"
		></script>
		
		<script>
			
			//https://www.youtube.com/watch?v=sedMosPDe9Y
			//https://www.codexworld.com/tinymce-upload-image-to-server-using-php/
			
			const images_upload_handler_callback = ( blobInfo, progress ) => new Promise( ( resolve, reject ) => {
				
				const xhr = new XMLHttpRequest();
				xhr.withCredentials = false;
				xhr.open( 'POST', '../controller/upload_imagem.php' );
				
				xhr.upload.onprogress = (e) => {
					
					progress( e.loaded / e.total * 100 );
					
				};
				
				xhr.onload = () => {
					
					if( xhr.status == 403 ){
						
						reject( { message: 'Erro de HTTP: '+ xhr.status, remove: true } );
						return;
						
					}
					
					if( 
						xhr.status < 200 
						|| xhr.status >= 300
					){
						
						reject( { message: 'Erro de HTTP: '+ xhr.status } );
						return;
						
					}
					
					//console.log(xhr.responseText);
					
					const json = JSON.parse( xhr.responseText );
					
					if(
						!json
						|| typeof json.location != 'string'
					){
						
						reject( { message: 'JSON inválido: '+ xhr.responseText } );
						return;
						
					}
					
					resolve( json.location );
					
				};
				
				xhr.onerror = () => {
					
					reject( { message: 'O upload da imagem falhou devido ao erro de transporte de XHR. Código: '+ xhr.status } );
					
				};
				
				const formData = new FormData();
				
				formData.append( 'file', blobInfo.blob(), blobInfo.filename() );
				
				xhr.send( formData );
				
			} );
			
			tinymce.init({
				selector: '.tinyMCE',
				plugins: 'fullscreen image link media emoticons code',
				toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
				images_upload_url: '../controller/upload_imagem.php',
				images_upload_handler: images_upload_handler_callback,
				language: 'pt_BR',
			});
			
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