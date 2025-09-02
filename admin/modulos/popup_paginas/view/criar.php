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
require $raiz_site .'model/paginas_fixas.php';
require $raiz_site .'model/noticias.php';
require $raiz_site .'model/secretarias.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar popup</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox popup-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo popup
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Tipo de Popup: </span>
					</div>
					<div class="col20">
						<span>
							<select name="tipo" required >
								<option value="texto">Texto</option>
								<option value="imagem">Imagem</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Tipo de Página: </span>
					</div>
					<div class="col20">
						<span>
							<select name="alvo" class="alvo" required >
								<option value="">Escolha o tipo de página</option>
								<option value="pagina">Página</option>
								<option value="pagina_fixa">Página em HTML</option>
								<option value="noticia">Notícia</option>
								<option value="secretaria">Secretaria</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha resultado off"></div>
				
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		
		<script>
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=popup_paginas';
				
			}
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/

			function ordenar(jsonArray, propriedade) {
				return jsonArray.sort((a, b) => {
					// Converte para string e trata case insensitive
					const valorA = String(a[propriedade]).toLowerCase();
					const valorB = String(b[propriedade]).toLowerCase();
					
					return valorA.localeCompare(valorB);
				});
			}
			
			let alvo = document.querySelector('.alvo');
			let resultado = document.querySelector('.resultado');
			let html = '';
			
			alvo.addEventListener("change", function() {
				
				console.log( 'alvo.value', alvo.value );
				resultado.classList.remove("off");
				
				if( alvo.value == '' ){
					
					html = '';
					resultado.innerHTML = '';
					resultado.classList.add("off");
					
				}
				
				if( alvo.value == 'pagina' ){
					
					resultado.innerHTML = '';
					html = '';
					
					var paginas = <?php echo json_encode( $paginas ); ?>;
					ordenar(paginas, 'titulo')
					//console.log( paginas );
					
					html = ''+
					'<div class="col10">'+
						'<span>Página: </span>'+
					'</div>'+
					'<div class="col90">'+
						'<span>'+
							'<select name="alvo_id" class="alvo_id">'+
								'<option value="">Escolha a página</option>'+
								'';
								
								for( var item in paginas ) {
						
									//console.log( paginas[item].titulo );
									html += '<option value="'+ paginas[item].id +'">'+ paginas[item].titulo +'</option>';
									
								}
								
								html += ''+
							'</select>'+
						'</span>'+
					'</div>'+
					'';
					
					resultado.innerHTML = html;
					
					tail.select( ".alvo_id",{
						width: "100%",
						search: true,
					} );
					
				}
				
				if( alvo.value == 'pagina_fixa' ){
					
					resultado.innerHTML = '';
					html = '';
					
					var paginas_fixas = <?php echo json_encode( $paginas_fixas ); ?>;
					ordenar(paginas_fixas, 'titulo')
					//console.log( paginas_fixas );
					
					html = ''+
					'<div class="col10">'+
						'<span>Página HTML: </span>'+
					'</div>'+
					'<div class="col90">'+
						'<span>'+
							'<select name="alvo_id" class="alvo_id">'+
								'<option value="">Escolha a página</option>'+
								'';
								
								for( var item in paginas_fixas ) {
						
									//console.log( paginas_fixas[item].titulo );
									html += '<option value="'+ paginas_fixas[item].id +'">'+ paginas_fixas[item].titulo +'</option>';
									
								}
								
								html += ''+
							'</select>'+
					'	</span>'+
					'</div>'+
					'';
					
					resultado.innerHTML = html;
					
					tail.select( ".alvo_id",{
						width: "100%",
						search: true,
					} );
					
				}
				
				if( alvo.value == 'noticia' ){
					
					resultado.innerHTML = '';
					html = '';
					
					var noticias_array = <?php echo json_encode( $noticias_array ); ?>;
					ordenar(noticias_array, 'titulo')
					//console.log( noticias_array );
					
					html = ''+
					'<div class="col10">'+
						'<span>Notícia: </span>'+
					'</div>'+
					'<div class="col90">'+
						'<span>'+
							'<select name="alvo_id" class="alvo_id">'+
								'<option value="">Escolha a notícia</option>'+
								'';
								
								for( var item in noticias_array ) {
						
									//console.log( noticias_array[item].titulo );
									html += '<option value="'+ noticias_array[item].id +'">'+ noticias_array[item].titulo +'</option>';
									
								}
								
								html += ''+
							'</select>'+
						'</span>'+
					'</div>'+
					'';
					
					resultado.innerHTML = html;
					
					tail.select( ".alvo_id",{
						width: "100%",
						search: true,
					} );
					
				}
				
				if( alvo.value == 'secretaria' ){
					
					resultado.innerHTML = '';
					html = '';
					
					var secretarias_array = <?php echo json_encode( $secretarias_array ); ?>;
					ordenar(secretarias_array, 'titulo')
					//console.log( secretarias_array );
					
					html = ''+
					'<div class="col10">'+
						'<span>Secretaria: </span>'+
					'</div>'+
					'<div class="col90">'+
						'<span>'+
							'<select name="alvo_id" class="alvo_id">'+
								'<option value="">Escolha a secretaria</option>'+
								'';
								
								for( var item in secretarias_array ) {
						
									//console.log( secretarias_array[item].titulo );
									html += '<option value="'+ secretarias_array[item].id +'">'+ secretarias_array[item].titulo +'</option>';
									
								}
								
								html += ''+
							'</select>'+
						'</span>'+
					'</div>'+
					'';
					
					resultado.innerHTML = html;
					
					tail.select( ".alvo_id",{
						width: "100%",
						search: true,
					} );
					
				}
				
			});
			
		</script>
		
	</body>
	
</html>