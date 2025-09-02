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
require $raiz_site .'model/popup_paginas.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar popup</title>
		
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
			
			foreach( $popup_paginas_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					$alvo_nome = '';

					if( $item['alvo'] == 'pagina' ){ 
						require $raiz_site .'model/paginas.php';
						foreach( $paginas as $get ){
							if( $get['id'] == $item['alvo_id'] ){
								$alvo_nome = $get['titulo'];
							}
						}
					}
					if( $item['alvo'] == 'pagina_fixa' ){ 
						require $raiz_site .'model/paginas_fixas.php'; 
						foreach( $paginas_fixas as $get ){
							if( $get['id'] == $item['alvo_id'] ){
								$alvo_nome = $get['titulo'];
							}
						}
					}
					if( $item['alvo'] == 'noticia' ){ 
						require $raiz_site .'model/noticias.php'; 
						foreach( $noticias_array as $get ){
							if( $get['id'] == $item['alvo_id'] ){
								$alvo_nome = $get['titulo'];
							}
						}
					}
					if( $item['alvo'] == 'secretaria' ){ 
						require $raiz_site .'model/secretarias.php'; 
						foreach( $secretarias_array as $get ){
							if( $get['id'] == $item['alvo_id'] ){
								$alvo_nome = $get['titulo'];
							}
						}
					}
				
					echo'
					<div class="lightbox popup-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar popup da página: '. $alvo_nome .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Tipo de Popup: </span>
								</div>
								<div class="col20">
									<span>
										<select name="tipo" required >
											<option '; if( $item['tipo'] == 'texto' ){ echo'selected'; } echo' value="texto">Texto</option>
											<option '; if( $item['tipo'] == 'imagem' ){ echo'selected'; } echo' value="imagem">Imagem</option>
										</select>
									</span>
								</div>
							</div>
							
							<div class="separador"></div>

							<div class="linha linha-auto">
								<textarea id="editor" name="editor_texto">'. $item['conteudo'] .'</textarea>
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
			
		</script>
		
	</body>
	
</html>