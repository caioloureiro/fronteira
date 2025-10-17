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
require $raiz_site .'model/categorias.php';

$hoje = date( 'Y-m-d H:i:s' );

?>
<!DOCTYPE HTML>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar notícia</title>
		
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
			
		?>
		
		<div class="lightbox noticia-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova Notícia
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_site ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha linha-auto"><div class="col10"><span>Imagem: </span></div>
					
					<?php
						
						$get_imagem = '';
						$imagem = '';
						
						if( 
							isset( $_GET['arquivo'] )
							&& $_GET['arquivo'] != 0 
						){ $get_imagem = $_GET['arquivo']; }
					
						$imagem_check = explode( '/', $get_imagem );

						if(
							$imagem_check[0] == 'http:' ||
							$imagem_check[0] == 'https:'
						){

							$imagem = $get_imagem;
							
						}else{

							$imagem = $pasta. $get_imagem;
							
						}					
						
					?>

					<div class="col90">
						<div 
							class="escolher-imagem-btn item-escolher-imagem-btn" 
							onclick="abrir_item_imagens()" 
							style="background-image:url( <?php echo $imagem ?>)"
						></div>
					</div>
					<div class="linha"><div class="col10"><span>URL Imagem: </span></div>
						<div class="col90">
							<input 
								name="imagem" 
								class="item-escolher-imagem-input" 
								value="<?php echo $get_imagem ?>"
								required
							/>
						</div>
					</div>
					
				</div>
				
				<div class="separador"></div>
				
				<div class="linha"><div class="col10"><span>Título: </span></div>
					<div class="col90">
						<input 
							name="titulo" 
							class="noticia_titulo" 
							required 
						/>
					</div>
				</div>
				
				<div class="linha"><div class="col10"><span>Subtítulo: </span></div>
					<div class="col90">
						<input 
							name="subtitulo" 
							class="noticia_subtitulo"
						/>
					</div>
				</div>
				
				<div class="linha" title="A legenda pode ficar em branco."><div class="col10"><span>Legenda da foto: </span></div>
					<div class="col90">
						<input name="legenda" class="noticia_legenda" />
					</div>
				</div>
				
				<div class="linha"><div class="col10"><span>Categorias: </span></div>
					<div class="col15">
						<span>
							<select class="categorias_trigger" name="categorias_trigger">
								<option value="">Categoria</option>
								
								<?php
								
									foreach( $categorias_array as $notCat ){

										echo '<option>'. $notCat['nome'] .'</option>';
										
									}
									
								?>
								
							</select>
						</span>
					</div>
					<div class="col75">
						<span>
							<input 
								type="text" 
								class="categorias" 
								name="categorias"
							/>
						</span>
					</div>
					
				</div>
			
				<div class="linha"><div class="col10"><span>Rascunho: </span></div>
				
					<div class="col05">
						<span>
							<input 
								name="publicado" 
								type="checkbox" 
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
								class="noticia_publicacao"
								value="<?php echo $hoje ?>"
								required
							/>
						</span>
					</div>
					
				</div>
				
				<div class="separador"></div>

				<div class="linha linha-auto">
					<textarea id="editor" name="editor_texto"></textarea>
				</div>

				<div class="separador"></div>
				
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/

			function limpar_caracteres( limpar ){
				
				limpar = limpar.replaceAll(' ', '-')
					.replaceAll("'", '')
					.replaceAll('&#039', '')
					.replaceAll('&Auml', 'A')
					.replaceAll('&Ouml', 'Oe')
					.replaceAll('&Uuml', 'Ue')
					.replaceAll('&amp', '')
					.replaceAll('&auml', 'ae')
					.replaceAll('&gt', '')
					.replaceAll('&lt', '')
					.replaceAll('&ouml', 'oe')
					.replaceAll('&quot', '')
					.replaceAll('&uuml', 'ue')
					.replaceAll('À', 'A')
					.replaceAll('Á', 'A')
					.replaceAll('Â', 'A')
					.replaceAll('Ã', 'A')
					.replaceAll('Ä', 'Ae')
					.replaceAll('Å', 'A')
					.replaceAll('Æ', 'Ae')
					.replaceAll('Ç', 'C')
					.replaceAll('È', 'E')
					.replaceAll('É', 'E')
					.replaceAll('Ê', 'E')
					.replaceAll('Ë', 'E')
					.replaceAll('Ì', 'I')
					.replaceAll('Í', 'I')
					.replaceAll('Î', 'I')
					.replaceAll('Ï', 'I')
					.replaceAll('Ð', 'D')
					.replaceAll('Ñ', 'N')
					.replaceAll('Ò', 'O')
					.replaceAll('Ó', 'O')
					.replaceAll('Ô', 'O')
					.replaceAll('Õ', 'O')
					.replaceAll('Ö', 'Oe')
					.replaceAll('Ø', 'O')
					.replaceAll('Ù', 'U')
					.replaceAll('Ú', 'U')
					.replaceAll('Û', 'U')
					.replaceAll('Ü', 'Ue')
					.replaceAll('Ý', 'Y')
					.replaceAll('Þ', 'T')
					.replaceAll('ß', 'ss')
					.replaceAll('à', 'a')
					.replaceAll('á', 'a')
					.replaceAll('â', 'a')
					.replaceAll('ã', 'a')
					.replaceAll('ä', 'ae')
					.replaceAll('å', 'a')
					.replaceAll('æ', 'ae')
					.replaceAll('ç', 'c')
					.replaceAll('è', 'e')
					.replaceAll('é', 'e')
					.replaceAll('ê', 'e')
					.replaceAll('ë', 'e')
					.replaceAll('ì', 'i')
					.replaceAll('í', 'i')
					.replaceAll('î', 'i')
					.replaceAll('ï', 'i')
					.replaceAll('ð', 'd')
					.replaceAll('ñ', 'n')
					.replaceAll('ò', 'o')
					.replaceAll('ó', 'o')
					.replaceAll('ô', 'o')
					.replaceAll('õ', 'o')
					.replaceAll('ö', 'oe')
					.replaceAll('ø', 'o')
					.replaceAll('ù', 'u')
					.replaceAll('ú', 'u')
					.replaceAll('û', 'u')
					.replaceAll('ü', 'ue')
					.replaceAll('ý', 'y')
					.replaceAll('þ', 't')
					.replaceAll('ÿ', 'y')
					.replaceAll('Ā', 'A')
					.replaceAll('ā', 'a')
					.replaceAll('Ă', 'A')
					.replaceAll('ă', 'a')
					.replaceAll('Ą', 'A')
					.replaceAll('ą', 'a')
					.replaceAll('Ć', 'C')
					.replaceAll('ć', 'c')
					.replaceAll('Ĉ', 'C')
					.replaceAll('ĉ', 'c')
					.replaceAll('Ċ', 'C')
					.replaceAll('ċ', 'c')
					.replaceAll('Č', 'C')
					.replaceAll('č', 'c')
					.replaceAll('Ď', 'D')
					.replaceAll('ď', 'd')
					.replaceAll('Đ', 'D')
					.replaceAll('đ', 'd')
					.replaceAll('Ē', 'E')
					.replaceAll('ē', 'e')
					.replaceAll('Ĕ', 'E')
					.replaceAll('ĕ', 'e')
					.replaceAll('Ė', 'E')
					.replaceAll('ė', 'e')
					.replaceAll('Ę', 'E')
					.replaceAll('ę', 'e')
					.replaceAll('Ě', 'E')
					.replaceAll('ě', 'e')
					.replaceAll('Ĝ', 'G')
					.replaceAll('ĝ', 'g')
					.replaceAll('Ğ', 'G')
					.replaceAll('ğ', 'g')
					.replaceAll('Ġ', 'G')
					.replaceAll('ġ', 'g')
					.replaceAll('Ģ', 'G')
					.replaceAll('ģ', 'g')
					.replaceAll('Ĥ', 'H')
					.replaceAll('ĥ', 'h')
					.replaceAll('Ħ', 'H')
					.replaceAll('ħ', 'h')
					.replaceAll('Ĩ', 'I')
					.replaceAll('ĩ', 'i')
					.replaceAll('Ī', 'I')
					.replaceAll('ī', 'i')
					.replaceAll('Ĭ', 'I')
					.replaceAll('ĭ', 'i')
					.replaceAll('Į', 'I')
					.replaceAll('į', 'i')
					.replaceAll('İ', 'I')
					.replaceAll('ı', 'i')
					.replaceAll('Ĳ', 'IJ')
					.replaceAll('ĳ', 'ij')
					.replaceAll('Ĵ', 'J')
					.replaceAll('ĵ', 'j')
					.replaceAll('Ķ', 'K')
					.replaceAll('ķ', 'k')
					.replaceAll('ĸ', 'k')
					.replaceAll('Ĺ', 'K')
					.replaceAll('ĺ', 'l')
					.replaceAll('Ļ', 'K')
					.replaceAll('ļ', 'l')
					.replaceAll('Ľ', 'K')
					.replaceAll('ľ', 'l')
					.replaceAll('Ŀ', 'K')
					.replaceAll('ŀ', 'l')
					.replaceAll('Ł', 'K')
					.replaceAll('ł', 'l')
					.replaceAll('Ń', 'N')
					.replaceAll('ń', 'n')
					.replaceAll('Ņ', 'N')
					.replaceAll('ņ', 'n')
					.replaceAll('Ň', 'N')
					.replaceAll('ň', 'n')
					.replaceAll('ŉ', 'n')
					.replaceAll('Ŋ', 'N')
					.replaceAll('ŋ', 'n')
					.replaceAll('Ō', 'O')
					.replaceAll('ō', 'o')
					.replaceAll('Ŏ', 'O')
					.replaceAll('ŏ', 'o')
					.replaceAll('Ő', 'O')
					.replaceAll('ő', 'o')
					.replaceAll('Œ', 'OE')
					.replaceAll('œ', 'oe')
					.replaceAll('Ŕ', 'R')
					.replaceAll('ŕ', 'r')
					.replaceAll('Ŗ', 'R')
					.replaceAll('ŗ', 'r')
					.replaceAll('Ř', 'R')
					.replaceAll('ř', 'r')
					.replaceAll('Ś', 'S')
					.replaceAll('Ŝ', 'S')
					.replaceAll('Ş', 'S')
					.replaceAll('Š', 'S')
					.replaceAll('š', 's')
					.replaceAll('Ţ', 'T')
					.replaceAll('Ť', 'T')
					.replaceAll('Ŧ', 'T')
					.replaceAll('Ũ', 'U')
					.replaceAll('ũ', 'u')
					.replaceAll('Ū', 'U')
					.replaceAll('ū', 'u')
					.replaceAll('Ŭ', 'U')
					.replaceAll('ŭ', 'u')
					.replaceAll('Ů', 'U')
					.replaceAll('ů', 'u')
					.replaceAll('Ű', 'U')
					.replaceAll('ű', 'u')
					.replaceAll('Ų', 'U')
					.replaceAll('ų', 'u')
					.replaceAll('Ŵ', 'W')
					.replaceAll('ŵ', 'w')
					.replaceAll('Ŷ', 'Y')
					.replaceAll('ŷ', 'y')
					.replaceAll('Ÿ', 'Y')
					.replaceAll('Ź', 'Z')
					.replaceAll('ź', 'z')
					.replaceAll('Ż', 'Z')
					.replaceAll('ż', 'z')
					.replaceAll('Ž', 'Z')
					.replaceAll('ž', 'z')
					.replaceAll('ſ', 'ss')
					.replaceAll('ƒ', 'f')
					.replaceAll('Ș', 'S')
					.replaceAll('Ț', 'T')
					.replaceAll('Ё', 'YO')
					.replaceAll('А', 'A')
					.replaceAll('Б', 'B')
					.replaceAll('В', 'V')
					.replaceAll('Г', 'G')
					.replaceAll('Д', 'D')
					.replaceAll('Е', 'E')
					.replaceAll('Ж', 'ZH')
					.replaceAll('З', 'Z')
					.replaceAll('И', 'I')
					.replaceAll('Й', 'Y')
					.replaceAll('К', 'K')
					.replaceAll('Л', 'L')
					.replaceAll('М', 'M')
					.replaceAll('Н', 'N')
					.replaceAll('О', 'O')
					.replaceAll('П', 'P')
					.replaceAll('Р', 'R')
					.replaceAll('С', 'S')
					.replaceAll('Т', 'T')
					.replaceAll('У', 'U')
					.replaceAll('Ф', 'F')
					.replaceAll('Х', 'H')
					.replaceAll('Ц', 'C')
					.replaceAll('Ч', 'CH')
					.replaceAll('Ш', 'SH')
					.replaceAll('Щ', 'SCH')
					.replaceAll('Ъ', '')
					.replaceAll('Ы', 'Y')
					.replaceAll('Ь', '')
					.replaceAll('Э', 'E')
					.replaceAll('Ю', 'YU')
					.replaceAll('Я', 'YA')
					.replaceAll('а', 'a')
					.replaceAll('б', 'b')
					.replaceAll('в', 'v')
					.replaceAll('г', 'g')
					.replaceAll('д', 'd')
					.replaceAll('е', 'e')
					.replaceAll('ж', 'zh')
					.replaceAll('з', 'z')
					.replaceAll('и', 'i')
					.replaceAll('й', 'y')
					.replaceAll('к', 'k')
					.replaceAll('л', 'l')
					.replaceAll('м', 'm')
					.replaceAll('н', 'n')
					.replaceAll('о', 'o')
					.replaceAll('п', 'p')
					.replaceAll('р', 'r')
					.replaceAll('с', 's')
					.replaceAll('т', 't')
					.replaceAll('у', 'u')
					.replaceAll('ф', 'f')
					.replaceAll('х', 'h')
					.replaceAll('ц', 'c')
					.replaceAll('ч', 'ch')
					.replaceAll('ш', 'sh')
					.replaceAll('щ', 'sch')
					.replaceAll('ъ', '')
					.replaceAll('ы', 'y')
					.replaceAll('ый', 'iy')
					.replaceAll('ь', '')
					.replaceAll('э', 'e')
					.replaceAll('ю', 'yu')
					.replaceAll('я', 'ya')
					.replaceAll('ё', 'yo');
				
				return limpar;
				
			}
			
			//categorias
			let categorias_trigger = document.querySelector('.categorias_trigger');
			let categorias = document.querySelector('.categorias');
			let preview_categorias = document.querySelector('.preview_categorias');
			
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
				
				var get_imagem = '';
				var imagem = '';
				var pasta = '../../../../noticias-img/';

				if( 
					item_escolher_imagem_input.value
					&& item_escolher_imagem_input.value.length != 0 
				){ get_imagem = item_escolher_imagem_input.value; }

				const imagem_check = get_imagem.split("/");

				if(
					imagem_check[0] == 'http:' ||
					imagem_check[0] == 'https:'
				){

					imagem = get_imagem;
					
				}else{

					imagem = pasta + get_imagem;
					
				}

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ imagem +')' ;
				
				document.querySelector('.preview_img').src = imagem;
				
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
			
		
		/*Start - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		const form = document.querySelector('form');
		const submitButton = document.querySelector('button[type="submit"]');
		
		if (form && submitButton) {
			let formularioEnviado = false;
			
			form.addEventListener('submit', function(e) {
				if (formularioEnviado) {
					e.preventDefault();
					alert('O formulário já está sendo processado. Por favor, aguarde.');
					return false;
				}
				
				formularioEnviado = true;
				submitButton.disabled = true;
				submitButton.textContent = 'Gravando...';
				submitButton.style.opacity = '0.6';
				submitButton.style.cursor = 'not-allowed';
			});
		}
		/*End - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		</script>
		
	</body>
</html>