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
require $raiz_site .'model/chamamento_publico.php';
require $raiz_site .'model/downloads.php';
require $raiz_site .'model/editais.php';

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
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$pasta_nome = 'arquivos';
			$pasta = $raiz_site .'arquivos/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'arquivos.php';
			
			$anexos = '';
			
			foreach( $chamamento_publico_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					foreach( $editais_array as $edital ){
						
						if( $edital['modalidade_item_id'] == $item['id'] ){
							
							$anexos .= $edital['modalidade_arquivo_id'] .';';
							
						}
						
					}
				
					echo'
					<div class="lightbox chamamento_publico-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar chamamento público: '. $item['titulo'] .'
								<div 
									class="lightbox-fechar" 
									onClick="voltar()" 
									style="background-image:url( '. $raiz_admin .'img/fechar.svg );"
								></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Título: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											name="titulo" 
											required
											value="'. $item['titulo'] .'"
										/>
									</span>
								</div>
							</div>
						
							<div class="linha">
								<div class="col10">
									<span>Situação: </span>
								</div>
								<div class="col90">
									<span>
										<select name="situacao">
											<option value="aberto" '; if( $item['situacao'] == 'aberto' ){ echo'selected'; } echo'>Aberto</option>
											<option value="andamento" '; if( $item['situacao'] == 'andamento' ){ echo'selected'; } echo'>Em Andamento</option>
											<option value="finalizado" '; if( $item['situacao'] == 'finalizado' ){ echo'selected'; } echo'>Finalizado</option>
											<option value="cancelado" '; if( $item['situacao'] == 'cancelado' ){ echo'selected'; } echo'>Cancelado</option>
										</select>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Número: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											name="numero" 
											value="'. $item['numero'] .'"
										/>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Processo: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											name="processo" 
											value="'. $item['processo'] .'"
										/>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Encerramento: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											type="datetime-local"
											name="encerramento" 
											value="'. $item['encerramento'] .'"
										/>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Local: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											name="local" 
											value="'. $item['local'] .'"
										/>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Arquivos IDs: </span>
								</div>
								<div class="col90">
									<span>
										<input 
											class="item-escolher-arquivo-input input_arquivos"
											name="arquivos" 
											value="'. $anexos .'"
										/>
									</span>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								
								<div class="col10">Arquivos:</div>
								<div class="col90 anexos">
									';
										
										$anexos_array = explode( ';', trim( strip_tags( $anexos ) ) );
										array_pop( $anexos_array );
										//echo '<pre>'; print_r( $anexos_array ); echo'</pre>';
										//echo count( $anexos_array );
										
										for( $i = 0; $i < count( $anexos_array ); $i++ ){
											
											foreach( $downloads_array as $file ){

												if( $file['id'] == $anexos_array[ $i ] ){
													
													echo'
													<div 
														class="
															anexo
															anexo_'. $file['id'] .'
														"
													>
														<div class="anexo-nome">'. $file['arquivo'] .'</div>
														<div 
															class="anexo-excluir"
															onclick="excluirArquivo( '. $file['id'] .' )"
															title="Desvincular este arquivo."
														>'; require $raiz_admin .'img/fechar.svg'; echo'</div>
													</div>
													';
													
												}
												
											}
											
										}
										
									echo'
								</div>
								
							</div>
							
							<div class="linha">
								<div class="col10"></div>
								<div class="col90">
									<div 
										onclick="abrirArquivos()"
										style="cursor:pointer;"
										class="btn"
									>Adicionar outro arquivo.</div>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								<div class="col10">
									<span>Descrição: </span>
								</div>
								<div class="col90 editor-container">
									<textarea class="tinyMCE" name="editor_texto">'. $item['descricao'] .'</textarea>
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
			
			/*Login no TinyMCE com a conta do Google*/
			$chave_TinyMCE = '19qrwrck1ohw2pd7g0s9c5d6ijtxo6rws7l14ruuinbd62ix'; 
			
		?>
		
		<script
			type="text/javascript"
			src='https://cdn.tiny.cloud/1/<?php echo $chave_TinyMCE ?>/tinymce/6/tinymce.min.js'
			referrerpolicy="origin"
		></script>
		
		<script>
			
			tinymce.init({
				selector: '.tinyMCE',
				plugins: 'fullscreen image link media emoticons code',
				toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
				language: 'pt_BR',
			});
			
			function excluirArquivo( id ){
				
				console.log( 'id', id ); 
				
				let input_arquivos = document.querySelector('.input_arquivos').value;
				console.log( 'input_arquivos', input_arquivos ); 
				
				let input_arquivos_array = input_arquivos.split( id +";");
				console.log( 'input_arquivos_array', input_arquivos_array ); 
				
				let resultado = input_arquivos_array[0] + input_arquivos_array[1];
				console.log( 'resultado', resultado ); 
				
				document.querySelector( '.input_arquivos' ).value = resultado;
				document.querySelector( '.anexo_'+ id ).remove();
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=chamamento_publico';
				
			}
			
		</script>
		
	</body>
	
</html>