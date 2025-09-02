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
require $raiz_site .'model/galeria_noticias.php';

$pasta_nome = 'galeria';
$pasta = $raiz_site .'galeria/';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
	</head>
	<body>
		
		<style>
			<?php 
				require $raiz_admin .'routes/css-modulo.php'; 
			?>
			.itens_galeria{
				display:none;
			}
		</style>
		
		<?php 
			
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<div class="lightbox novo-01 on">

			<div class="lightbox-titulo">

				Montando galeria
				<div class="lightbox-fechar" onClick="voltar()"><?php require $raiz_admin .'img/fechar.svg'; ?></div>
				
			</div>
			
			<div class="linha linha-auto">
				<div class="comentario">
					<span>Escolha a notícia para anexar imagens.</span>
				</div>
			</div>
			
			<div class="linha">
				<div class="col10"><span>Notícia:</span></div>
				<div class="col90">
					<span>
						<select 
							class="noticia_id" 
							name="noticia_id"
							onchange="mostrar_itens_galeria()"
						>
							<option value="0">Selecione uma notícia</option>
							
							<?php
								
								$noticias_array = array_reverse( $noticias_array );
								
								foreach( $noticias_array as $not ){

									echo '<option value="'. $not['id'] .'">'. $not['titulo'] .'</option>';
									
								}
								
							?>
						</select>
					</span>
				</div>
			</div>
			
			<div class="itens_galeria">
			
				<div class="linha-acao">
					
					<div class="col20">

						<label 
							class="btn arquivo_escolhido" 
							for="arquivo" 
							title="Clique aqui para selecionar as imagens desejadas."
						>Escolher imagens do computador</label>
						
						<input 
							type="file" 
							name="arquivos_subir[]" 
							id="arquivo" 
							class="btn"
							multiple 
						/>
						
					</div>
					
					<div class="col20">

						<div 
							class="btn"
							onclick="abrirImagens()"
						>Escolher imagens do servidor</div>
						
					</div>
					
				</div>
				
				<div class="separador"></div>
				
				<div class="linha linha-auto">
					
					<div class="exibir"></div>
					
				</div>
				
				<div class="separador"></div>
				
				<div class="linha-acao">
				
					<div class="submenu-novo-btn" onclick="voltar()">Concluir</div>
					
				</div>
				
				<div class="separador"></div>
				
			</div>
			
		</div>
		
		<script>
			
			var valor;

			tail.select( ".noticia_id",{
				width: "100%",
				search: true,
			} );
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=galeria_noticias';
				
			}
			
			function abrirImagens(){
				
				document.querySelector('.item-imagens').classList.add("on");
				
			}
			
			function mostrar_itens_galeria(){
				
				//console.log( 'mostrar_itens_galeria'); 
				
				valor = document.querySelector('.noticia_id').value;
				//console.log( 'valor', valor ); 
				
				if( valor > 0 ){
					document.querySelector('.itens_galeria').classList.add("on");
				}
				else{
					document.querySelector('.itens_galeria').classList.remove("on");
				}
				
				//console.log( 'valor', valor ); 
				
			}
			
			/*Start - ARQUIVO REATIVO*/
			let arquivo = document.querySelector('#arquivo');
			let arquivo_valor = document.getElementById('arquivo');
			let exibir = document.querySelector('.exibir');
			var noticia_id = document.querySelector('.noticia_id').value;
			let exibir_capa = document.querySelector('.exibir_capa');
			
			let pasta = '<?php echo $raiz_site ?>galeria/';
			let html = '';
			let html_capa = '';
			
			const date = new Date();
			let dia_num = date.getDate();
			let dia = '';
			if( dia_num < 10 ){ dia = '0'+ dia_num; }else{ dia = dia_num; }
			let mes_num = date.getMonth() + 1;
			let mes = '';
			if( mes_num < 10 ){ mes = '0'+ mes_num; }else{ mes = mes_num; }
			let ano = date.getFullYear();
			let hora_num = date.getHours();
			let hora = '';
			if( hora_num < 10 ){ hora = '0'+ hora_num; }else{ hora = hora_num; }
			let min_num = date.getMinutes();
			let min = '';
			if( min_num < 10 ){ min = '0'+ min_num; }else{ min = min_num; }
			let sec = date.getSeconds();
			let data_invertida = ano+'-'+mes+'-'+dia+'-'+hora+'-'+min+'-';
			
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
			
			function inserir_thumb( filename, i ){
				
				console.log( 'inserir_thumb' );
				console.log( 'filename', filename );
				console.log( 'i', i );
			
				//let renomear = data_invertida + limpar_caracteres( this.files[i].name );
				//let renomear = data_invertida + limpar_caracteres( filename );
				var renomear = filename;
				
				html += ''+
				'<div class="thumb thumb_'+ i +'">'+
					'<div '+
						'class="thumb-excluir"'+
						'onclick="excluirArquivo( `thumb_'+ i +'`, `'+ renomear +'` )"'+
					'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492"><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052 L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116 c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/></svg></div>'+
					'<div '+
						'class="thumb-img"'+
						'style="background-image:url( '+ pasta + renomear +' )"'+
					'></div>'+
				'</div>'+
				'';
				
				exibir.innerHTML = html;
				
			}
			
			function enviarArquivo(file, noticia_id, index) {
				
				return new Promise((resolve, reject) => {
					
					const formData = new FormData();
					formData.append('arquivo', file);
					formData.append('noticia_id', noticia_id);

					const xhr = new XMLHttpRequest();
					xhr.open('POST', '../controller/enviar-arquivo.php', true);

					xhr.onload = function () {
						
						if (xhr.status === 200) {
							
							resolve({ filename: xhr.responseText, index });
							
						} 
						else {
							
							reject(`Erro ao enviar o arquivo: ${xhr.status}`);
							
						}
						
					};

					xhr.onerror = () => reject('Erro de conexão');
					xhr.send(formData);
					
				});
				
			}
			
			function uploadFile(files, noticia_id) {
				
				for (let i = 0; i < files.length; i++) {
					
					enviarArquivo(files[i], noticia_id, i)
					.then(({ filename, index }) => {
						
						console.log('Arquivo recebido:', filename);
						inserir_thumb(filename, index);
						
					})
					.catch((error) => {
						
						console.error(error);
						
					});
					
				}
				
			}
			
			function excluirArquivo( thumb, arquivo ){
				
				//console.log( 'thumb', thumb ); 
				
				let classe = '.'+ thumb;
				
				//console.log( 'classe', classe ); 
				
				document.querySelector( classe ).remove();
				
				//console.log( 'arquivo', arquivo ); 
				
				var formData_delete = new FormData();
				formData_delete.append( 'arquivo', arquivo );
				
				var xhr_delete = new XMLHttpRequest();
				xhr_delete.open( 'POST', '../controller/desvincular-imagem.php', true );
				
				xhr_delete.send( formData_delete );
				
			}
			
			if( document.querySelector('#arquivo') ){
				
				arquivo.addEventListener('change', function() {
					
					//var filename = arquivo.files[0].name;

					var arquivo_escolhido = document.querySelector('.arquivo_escolhido');
					
					//console.log( 'this.files', this.files ); 
					
					uploadFile( this.files, valor );

					arquivo_escolhido.innerHTML = this.files.length +' arquivos selecionados.';
					
				});

			}
			/*End - ARQUIVO REATIVO*/
			
		</script>
		
	</body>
</html>