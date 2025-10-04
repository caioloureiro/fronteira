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
require $raiz_site .'model/licitacoes.php';
require $raiz_site .'model/licitacoes_anexos.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar anexo</title>
		
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
			
			$editor_de_texto_valor = '';
			
			foreach( $licitacoes_anexos_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox anexo-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar anexo: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
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
								
								'; 
						
									$pasta_nome = 'uploads';
									$pasta = $raiz_site .'uploads/';
								
									require $raiz_admin .'view/escurecer.php'; 
									require 'arquivos.php';
									
								echo'
								
								<div class="col10">
									<span>Edital (URL): </span>
								</div>
								<div class="col25">
									<span><div class="btn" onclick="abrirArquivos()">Clique aqui para escolher o edital do servidor.</div></span>
								</div>
								<div class="col25">
									<span>
										<label 
											class="btn arquivo_escolhido" 
											for="arquivo" 
											title="Clique aqui para selecionar o arquivo desejado."
										>Escolher imagem do dispositivo</label>
										<input type="file" name="arquivo_subir" id="arquivo" />
										<div 
											class="enviar-arquivo-submit" 
											title="Clique aqui para ENVIAR a imagem."
											onclick="subirArquivo()"
											style="float: left;"
										>Enviar</div>
									</span>
								</div>
								<div class="col15">
									<span>Customizar link do arquivo:</span>
								</div>
								<div class="col25">
									<input 
										type="text" 
										name="arquivo" 
										class="item-escolher-arquivo-input"
										required
										value="'. $item['arquivo'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Licitação: </span>
								</div>
								<div class="col90">
									<span>
										<select class="licitacao" name="licitacao">
											<option value="0">Selecione o licitacao</option>
											
											';
												
												foreach( $licitacoes_array as $conc ){
													
													echo'
													<option 
														value="'. $conc['id'] .'"
														'; if( $item['licitacao'] == $conc['id'] ){ echo 'selected'; } echo'
													>'. $conc['categoria'] .' - '. $conc['numero'] .'</option>
													';
													
												}
												
											echo'
											
										</select>
									</span>
								</div>
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
		
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script>
			
			tail.select( ".licitacao",{
				width: "100%",
				search: true,
			} );

			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=licitacoes_anexos';
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			/*Start - Arquivo*/
			let arquivo = document.querySelector('#arquivo');
			let arquivo_valor = document.getElementById('arquivo');

			if( document.querySelector('#arquivo') ){
				
				arquivo.addEventListener('change', function() {
					
					var filename = arquivo.files[0].name;

					var arquivo_escolhido = document.querySelector('.arquivo_escolhido');

					if( this.files.length > 1 ){

						arquivo_escolhido.innerHTML = this.files.length +' arquivos selecionados.';
						
					}else{

						arquivo_escolhido.innerHTML = filename;
						
					}
					
				});

			}
			/*End - Arquivo*/
			
			function subirArquivo(){
				
				console.log( 'subirArquivo()' );
				//console.log( document.querySelector('[name="arquivo_subir"]').files[0] );
				
				if( document.querySelector('[name="arquivo_subir"]').files[0] ){
					
					var subirArquivo_pasta = '<?= $raiz_site ?>uploads/';
					
					var formData = new FormData();
					formData.append( 'arquivo_subir', document.querySelector('[name="arquivo_subir"]').value );
					formData.append( 'arquivo', document.querySelector('[name="arquivo_subir"]').files[0] );

					var xhr = new XMLHttpRequest();
					xhr.open( 'POST', '../controller/enviar-arquivo.php', true );

					xhr.onreadystatechange = function(){
						
						if( 
							xhr.status === 200 
							&& xhr.readyState == 4
						){
							
							//alert( xhr.responseText );
							document.querySelector('[name="arquivo_subir"]').value = '';
							document.querySelector('.item-escolher-arquivo-input').value = '';
							document.querySelector('.item-escolher-arquivo-input').value = 'uploads/'+ xhr.responseText;
							
						}
						
					};

					xhr.send( formData );
					
				}
				else{
					console.log( 'Nenhum arquivo selecionado.' );
				}
				
			}
			
		</script>
		
	</body>
	
</html>