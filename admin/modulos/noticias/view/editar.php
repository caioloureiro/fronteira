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
require $raiz_site .'model/noticias.php';
require $raiz_site .'model/categorias.php';

$hoje = date( 'Y-m-d H:i:s' );

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar noticias</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<?php 
			
			$pasta_nome = 'noticias-img';
			$pasta = $raiz_site .'noticias-img/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			require 'preview.php';
			
			$editor_de_texto_valor = '';
			
			$preview_titulo = '';
			$preview_publicacao = '';
			$preview_imagem = '';
			$preview_legenda = '';
			$preview_subtitulo = '';
			$preview_texto = '';
			
			foreach( $noticias_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					
					$preview_titulo = $item['titulo'];
					$preview_publicacao = data_tempo( $item['data_publicacao'] );
					$preview_legenda = $item['legenda'];
					$preview_subtitulo = $item['subtitulo'];
					$preview_texto = $item['texto'];
					$preview_categorias = $item['categorias'];
				
					echo'
					<div class="lightbox noticia-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar Notícia: '. $item['titulo'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( ../../../img/fechar.svg );"></div>
								
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

									$preview_imagem = $imagem;									
									
								echo'

								<div class="col90">
									<div 
										class="escolher-imagem-btn item-escolher-imagem-btn" 
										onclick="abrir_item_imagens()" 
										style="background-image:url( '. $imagem .' )"
									></div>
								</div>
								
								<div class="linha">
									<div class="col10"><span>URL Imagem: </span></div>
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
							
								<div class="col10"><span>Título: </span></div>
								
								<div class="col90">
									<input 
										name="titulo" 
										required 
										value="'. $item['titulo'] .'"
										class="noticia_titulo" 								
									/>
								</div>
								
							</div>
							
							<div class="linha">
							
								<div class="col10"><span>Subtítulo: </span></div>
								
								<div class="col90">
									<input 
										name="subtitulo" 
										value="'. $item['subtitulo'] .'" 
										class="noticia_subtitulo"
									/>
								</div>
								
							</div>
							
							<div class="linha" title="A legenda pode ficar em branco.">
								<div class="col10">
									<span>Legenda da foto: </span>
								</div>
								<div class="col90">
									<input 
										name="legenda" 
										value="'. $item['legenda'] .'" 
										class="noticia_legenda"
									/>
								</div>
							</div>
							
							<div class="linha">
				
								<div class="col10">
									<span>Categorias: </span>
								</div>
								<div class="col15">
									<span>
										<select class="categorias_trigger" name="categorias_trigger">
											<option value="">Categoria</option>
											
											';
											
												foreach( $categorias_array as $notCat ){

													echo '<option>'. $notCat['nome'] .'</option>';
													
												}
												
											echo'
											
										</select>
									</span>
								</div>
								<div class="col75">
									<span>
										<input 
											type="text" 
											class="categorias" 
											name="categorias"
											value="'. $item['categorias'] .'"
										/>
									</span>
								</div>
								
							</div>
							
							<div class="linha">
							
								<div class="col10"><span>Rascunho: </span></div>
								<div class="col05">
									<span>
										<input 
											name="publicado" 
											type="checkbox" 
											'; if( $item['publicado'] == 0 ){ echo'checked'; } echo'
											class="noticia_publicacao"
										/>
									</span>
								</div>
								
								<div class="col10">
									<span>Utilidade Pública: </span>
								</div>
								<div class="col05">
									<span>
										<input 
											name="utilidade_publica" 
											type="checkbox" 
											'; if( $item['utilidade_publica'] == 1 ){ echo'checked'; } echo'
										/>
									</span>
								</div>
								
								<div class="col15">
									<span>Data da publicação da notícia: </span>
								</div>
								<div class="col15">
									<span>
										<input 
											name="data_publicacao" 
											type="datetime-local" 
											value="'. $item['data_publicacao'] .'"
										/>
									</span>
								</div>
								
								<div class="col15">
									<span>Data da atualização da notícia: </span>
								</div>
								<div class="col15">
									<span>
										<input 
											name="data_atualizacao" 
											type="datetime-local" 
											value="'. $item['data_atualizacao'] .'"
										/>
									</span>
								</div>
								
							</div>
				
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								<textarea id="editor" name="editor_texto"></textarea>
							</div>

							<div class="linha-acao">
							
								<div class="col20">
									<button type="submit">Gravar</button>
									<div class="btn" onclick="voltar()">Cancelar</div>
								</div>
								
								<div class="col20">
									<span><div class="btn" onclick="abrir_preview()">Preview</div></span>
								</div>
								
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
			
			//categorias
			let categorias_trigger = document.querySelector('.categorias_trigger');
			let categorias = document.querySelector('.categorias');
			
			categorias_trigger.addEventListener('change', function() {

				categorias.value = categorias.value + categorias_trigger.value +';';
				
				preview_categorias.innerHTML = '';
				
				let categorias_value = categorias.value;
				
				//console.log( 'categorias_value', categorias_value ); 

				const categorias_value_array = categorias_value.split(";");
				
				// Remove valores vazios (como o último elemento após o ";") e itera no array
				categorias_value_array.filter(Boolean).forEach(( categoria ) => {
					
					//console.log(categoria);
					preview_categorias.innerHTML += '<div class="noticia-categoria preview_categorias">'+ categoria +'</div>';
					
				});
				
			});
			
			//imagem principal
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});
			
			//PREVIEW - titulo
			let noticia_titulo = document.querySelector('.noticia_titulo');
			let preview_titulo = document.querySelector('.preview_titulo');
			let preview_breadcrumb = document.querySelector('.preview_breadcrumb');
			
			noticia_titulo.addEventListener('keyup', function() {
				
				preview_titulo.innerHTML = noticia_titulo.value;
				preview_breadcrumb.innerHTML = limpar_caracteres( noticia_titulo.value );
				
			});
			
			//PREVIEW - subtitulo
			let noticia_subtitulo = document.querySelector('.noticia_subtitulo');
			let preview_subtitulo = document.querySelector('.preview_subtitulo');
			
			noticia_subtitulo.addEventListener('keyup', function() {
				
				preview_subtitulo.innerHTML = noticia_subtitulo.value;
				
			});
			
			//PREVIEW - legenda
			let noticia_legenda = document.querySelector('.noticia_legenda');
			let preview_legenda = document.querySelector('.preview_legenda');
			
			noticia_legenda.addEventListener('keyup', function() {
				
				preview_legenda.innerHTML = noticia_legenda.value;
				
			});
			
			//PREVIEW - publicacao
			let noticia_publicacao = document.querySelector('.noticia_publicacao');
			let preview_publicacao = document.querySelector('.preview_publicacao');
			
			function formatar_data( datetimeValue ){
				
				const [date, time] = datetimeValue.split("T"); // Separa data e hora
				const [year, month, day] = date.split("-"); // Separa ano, mês e dia
				const [hours, minutes, seconds = "00"] = time.split(":"); // Separa horas e minutos, e define segundos como "00" caso estejam ausentes

				// Formata no molde dia/mês/ano h:m:s
				const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
				//console.log(formattedDateTime); // Exibe no console ou use em outro lugar
				
				return formattedDateTime;
				
			}
			
			noticia_publicacao.addEventListener('keyup', function() {
				
				preview_publicacao.innerHTML = formatar_data( noticia_publicacao.value );
				
			});
			
			noticia_publicacao.addEventListener('change', function() {
				
				preview_publicacao.innerHTML = formatar_data( noticia_publicacao.value );
				
			});
			
			//PREVIEW - texto
			let noticia_texto = document.querySelector('#editor');
			let preview_texto = document.querySelector('.preview_texto');
			
			noticia_texto.addEventListener('keyup', function() {
				
				//console.log( 'noticia_texto', noticia_texto ); 
				preview_texto.innerHTML = noticia_texto.innerHTML;
				
			});
			
			//PREVIEW - ONLOAD
			window.addEventListener('load', function() {
				
				preview_titulo.innerHTML = "<?php echo $preview_titulo ?>";
				preview_breadcrumb.innerHTML = "<?php echo $preview_titulo ?>";
				preview_publicacao.innerHTML = "<?php echo $preview_publicacao ?>";
				document.querySelector('.preview_img').src = "<?php echo $preview_imagem ?>";
				document.querySelector('.preview_img_link').href = "<?php echo $preview_imagem ?>";
				preview_legenda.innerHTML = "<?php echo $preview_legenda ?>";
				preview_texto.innerHTML = `<?php echo $preview_texto ?>`;
				preview_subtitulo_get = "<?php echo $preview_subtitulo ?>";
				preview_subtitulo.innerHTML = "<?php echo $preview_subtitulo ?>";
				
				let preview_categorias = document.querySelector('.preview_categorias');
				
				preview_categorias.innerHTML = '';
				
				let categorias_value = "<?php echo $preview_categorias ?>";
				
				console.log( 'categorias_value', categorias_value ); 

				const categorias_value_array = categorias_value.split(";");
				
				// Remove valores vazios (como o último elemento após o ";") e itera no array
				categorias_value_array.filter(Boolean).forEach(( categoria ) => {
					
					//console.log(categoria);
					preview_categorias.innerHTML += '<div class="noticia-categoria preview_categorias">'+ categoria +'</div>';
					
				});
				
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
			
			function abrir_preview(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.preview').classList.add('on');
				
			}

			function fechar_preview(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.preview').classList.remove('on');
				
			}
			
		</script>
		
	</body>
</html>