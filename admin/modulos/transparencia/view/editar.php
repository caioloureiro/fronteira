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
require $raiz_site .'model/transparencia.php';
require $raiz_site .'model/transparencia_grupos.php';
require $raiz_site .'model/editais.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar transparencia</title>
		
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
			
			foreach( $transparencia_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['descricao'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox transparencia-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar transparencia: '. $item['titulo'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Título: </span>
								</div>
								<div class="col90">
									<input 
										name="titulo" 
										required 
										value="'. $item['titulo'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Grupo: </span>
								</div>
								<div class="col90">
									<span>
										<select
											name="grupo_id" 
											required 
										>
											';
											
											usort($transparencia_grupos_array, function( $a, $b ){//Função responsável por ordenar

												$al = mb_strtolower($a['nome']);
												$bl = mb_strtolower($b['nome']);
												
												if ($al == $bl){
													return 0;
												}
												
												return ($bl < $al) ? +1 : -1;
												
											});
											
											foreach( $transparencia_grupos_array as $grupo ){
											
												echo'
												<option 
													value="'. $grupo['id'] .'"
													';
													
													if( $item['grupo_id'] == $grupo['id'] ){ echo' selected '; }
													
													echo'
												>'. $grupo['nome'] .'</option>
												';
												
											}
											
											echo'
										</select>
									</span>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								<textarea id="editor" name="editor_texto"></textarea>
							</div>
							
							<div class="separador"></div>
							
							<hr/>
							
							<div class="linha linha-auto">
								<span><h3>EDITAIS ANEXADOS</h3></span>
							</div>
							
							<div class="linha-acao">
								
								<div class="col20">

									<div 
										class="btn"
										onclick="abrirEditais()"
									>Escolher editais</div>
									
								</div>
								
							</div>
				
							<div class="linha linha-auto">
								<span>
									
									<table class="classe">

										<thead>
											<tr>
												<th>Arquivos</th>
												<th style="width:10vw">Ação</th>
											</tr>
										</thead>
										
										<tbody>
											';
											
											usort($editais_array, function( $a, $b ){//Função responsável por ordenar

												$al = mb_strtolower($a['arquivo']);
												$bl = mb_strtolower($b['arquivo']);
												
												if ($al == $bl){
													return 0;
												}
												
												return ($bl < $al) ? +1 : -1;
												
											});
											
											foreach( $editais_array as $edital ){
												
												if( $edital['item_id'] == $item['id'] ){
													
													echo'
													<tr>
														<td>'. $edital['arquivo'] .'</td>
														<td>
															
															<a href="#"><div class="btn icone" title="Desvincular edital.">'; require $raiz_admin .'img/fechar.svg'; echo'</div></a>
															
														</td>
													</tr>
													';
													
												}
												
											}
											
											echo'
										</tbody>
										
									</table>
									
								</span>
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
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=transparencia';
				
			}
			
		</script>
		
	</body>
	
</html>