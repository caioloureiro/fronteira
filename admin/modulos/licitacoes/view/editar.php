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
require $raiz_site .'model/licitacoes_categorias.php';
require $raiz_site .'model/licitacoes_situacao.php';
require $raiz_site .'model/licitacoes_anexos.php';
require $raiz_site .'model/admin_user.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar licitacao</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style>
			<?php require $raiz_admin .'routes/css-modulo.php'; ?>
			
			/* CSS Específico para Anexos */
			
			/* Ícone X superior - tema responsivo */
			<?php
			foreach( $admin_user_array as $cfg ){
				if( $cfg['tema'] == 'escuro' && $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $cfg['usuario'] ){ 
					echo '.lightbox-fechar { filter: brightness(0) invert(1); }';
				}
			}
			?>
			
			.exibir-anexos {
				width: 100%;
				height: auto;
				min-height: 4vw;
				float: left;
				background-color: var(--fundo_02);
				border: 0.2vw dashed var(--azul);
				border-radius: 0.5vw;
				padding: 1vw;
				margin: 0vw;
				box-sizing: border-box;
				-webkit-box-sizing: border-box;
				transition: all 0.3s ease;
			}
			
			.exibir-anexos.drag-over {
				border-color: var(--azul);
				background-color: var(--azul_transp);
			}
			
			.exibir-anexos:empty::before {
				content: "Arraste seus arquivos aqui";
				color: var(--fonte_padrao);
				font-style: italic;
				width: 100%;
				height: 4vw;
				line-height: 4vw;
				text-align: center;
				float: left;
			}
			
			.thumb-anexo {
				position: relative;
				width: 8vw;
				height: 9vw;
				border: 0.1vw solid var(--cinza_claro);
				border-radius: 0.5vw;
				background-color: var(--fundo_02);
				float: left;
				margin: 0.5vw;
				box-sizing: border-box;
				-webkit-box-sizing: border-box;
				transition: transform 0.2s ease;
			}
			
			.thumb-anexo:hover {
				transform: translateY(-0.2vw);
			}
			
			.thumb-anexo-excluir {
				position: absolute;
				top: 0.3vw;
				right: 0.3vw;
				width: 1.2vw;
				height: 1.2vw;
				background-color: var(--vermelho);
				border-radius: 50%;
				cursor: pointer;
				color: white;
				font-size: 0.7vw;
				line-height: 1.2vw;
				text-align: center;
				transition: background-color 0.2s ease;
			}
			
			.thumb-anexo-excluir:hover {
				background-color: var(--vermelho);
				opacity: 0.8;
			}
			
			.thumb-anexo-icon {
				width: 3vw;
				height: 3vw;
				background-image: url('<?php echo $raiz_site ?>img/pdf.svg');
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
				margin-bottom: 0.5vw;
			}
			
			.thumb-anexo-nome {
				font-size: 0.7vw;
				text-align: center;
				color: var(--fonte_padrao);
				word-break: break-all;
				line-height: 1.2;
			max-height: 3vw;
			overflow: hidden;
		}
		
		#arquivo_anexos {
			display: none;
		}
		
		.arquivo_escolhido_anexos {
			display: inline-block !important;
			margin-right: 1vw !important;
			margin-bottom: 1vw !important;
			white-space: nowrap !important;
			vertical-align: top !important;
			background: var(--azul) !important;
			color: white !important;
			border: none !important;
			padding: 0.8vw 1.5vw !important;
			border-radius: 0.4vw !important;
			cursor: pointer !important;
			font-weight: 500 !important;
			font-size: 0.9vw !important;
		}
		
		.arquivo_escolhido_anexos:hover {
			background: var(--azul_escuro) !important;
		}
		
		.btn-anexo-servidor {
			display: inline-block !important;
			margin-bottom: 1vw !important;
			white-space: nowrap !important;
			vertical-align: top !important;
			background: var(--azul) !important;
			color: white !important;
			border: none !important;
			padding: 0.8vw 1.5vw !important;
			border-radius: 0.4vw !important;
			cursor: pointer !important;
			font-weight: 500 !important;
			font-size: 0.9vw !important;
		}
		
		.btn-anexo-servidor:hover {
			background: var(--azul_escuro) !important;
		}
		
		.anexos-info {
			background: var(--fundo_02);
			padding: 1vw;
			border-radius: 0.4vw;
			border: 0.1vw solid var(--cinza_claro);
			font-size: 0.8vw;
			line-height: 1.4;
			margin-top: 1vw;
			color: var(--fonte_padrao);
		}
	</style>		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $licitacoes_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox licitacao-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar licitacao: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Nome: </span>
								</div>
								<div class="col40">
									<input 
										name="nome" 
										required
										value="'. $item['nome'] .'"
									/>
								</div>
								<div class="col10">
									<span>Número: </span>
								</div>
								<div class="col40">
									<input 
										type="text" 
										name="numero" 
										required
										value="'. $item['numero'] .'"
									/>
								</div>
							</div>

							<div class="linha">
								<div class="col10">
									<span>Publicação: </span>
								</div>
								<div class="col20">
									<input 
										type="datetime-local" 
										name="publicacao" 
										value="'. $item['publicacao'] .'"
										required
									/>
								</div>
								<div class="col10">
									<span>Abertura: </span>
								</div>
								<div class="col20">
									<input 
										type="datetime-local" 
										name="abertura" 
										value="'. $item['abertura'] .'"
										required
									/>
								</div>
							</div>

							<div class="linha">
								<div class="col10">
									<span>Categoria: </span>
								</div>
								<div class="col20">
									<span>
										<select 
											name="categoria" 
											required
										>
											<option value="0">Selecione a categoria</option>
											
											';
												
												foreach( $licitacoes_categorias_array as $cat ){

													echo '
													<option 
														value="'. $cat['nome'] .'"
														'; if( $cat['nome'] == $item['categoria'] ){ echo 'selected'; } echo'
													>'. $cat['nome'] .'</option>
													';
													
												}
												
											echo'
											
										</select>
									</span>
								</div>
							
								<div class="col10">
									<span>Situação: </span>
								</div>
								<div class="col20">
									<span>
										<select 
											name="situacao" 
											required
										>
											<option value="0">Selecione a situação</option>
											
											';
												
												foreach( $licitacoes_situacao_array as $sit ){

													echo '
													<option 
														value="'. $sit['nome'] .'"
														'; if( $sit['nome'] == $item['situacao'] ){ echo 'selected'; } echo'
													>'. $sit['nome'] .'</option>
													';
													
												}
												
											echo'
											
										</select>
									</span>
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
									<span>Edital: </span>
								</div>
								<div class="col25">
									<span><div class="btn" onclick="abrirArquivos()">Clique aqui para escolher o arquivo do servidor.</div></span>
								</div>
								<div class="col25">
									<span>
										<label 
											class="btn arquivo_escolhido" 
											for="arquivo" 
											title="Clique aqui para selecionar o arquivo desejado."
										>Escolher arquivo do dispositivo</label>
										<input type="file" name="arquivo_subir" id="arquivo" />
										<div 
											class="enviar-arquivo-submit" 
											title="Clique aqui para ENVIAR o arquivo."
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
									name="edital" 
									class="item-escolher-arquivo-input"
									value="'. $item['edital'] .'"
								/>
							</div>
						</div>

						<!-- Start - Anexos Section -->
							<div class="linha">
								<div class="col100">
									<span>📎 Anexos da Licitação: </span>
								</div>
							</div>
							
						';
							// Buscar anexos existentes usando o array do model
							$anexos_existentes = [];
							if(isset($licitacoes_anexos_array)) {
								foreach($licitacoes_anexos_array as $anexo) {
									// Forçar comparação como inteiros e excluir o arquivo do edital
									if(intval($anexo['licitacao']) == intval($item['id']) && 
									   intval($anexo['ativo']) == 1) {
										
										// Excluir se o arquivo do anexo for igual ao arquivo do edital
										$arquivo_anexo = str_replace('uploads/', '', $anexo['arquivo']);
										$arquivo_edital = str_replace('uploads/', '', $item['edital']);
										
									   if($arquivo_anexo != $arquivo_edital) {
											$anexos_existentes[] = $anexo;
									   }
									}
								}
						}
					echo'
					
					<div class="linha">
						
						<div class="col100">
						
							<input 
								type="text" 
								class="licitacao_id"
								name="licitacao_id" 
								value="'. $item['id'] .'" 
								style="display:none;"
							/>
							
							<label 
								class="arquivo_escolhido_anexos" 
								for="arquivo_anexos" 
								title="Clique aqui para selecionar os arquivos desejados."
							>📁 Escolher Anexos do Computador</label>
							
							<input 
								type="file" 
								name="arquivos_anexos[]" 
								id="arquivo_anexos" 
								multiple 
								accept=".pdf,.zip,.rar,.7z,.doc,.xls,.ppt,.docx,.xlsx,.pptx"
							/>
							
							<div class="btn-anexo-servidor" 
								onclick="abrirArquivosParaAnexo()" 
								title="Selecionar arquivo já existente no servidor"
							>🗃️ Anexar Arquivo do Servidor</div>
							
						</div>
						
					</div>

					<div class="separador"></div>
					
					<div class="linha linha-auto">
						<div class="col100">
							<div class="anexos-info">
								<strong>ℹ️ Instruções:</strong><br>
								• Arraste ou clique para enviar múltiplos arquivos<br>
								• Formatos aceitos: PDF, ZIP, RAR, 7Z, DOC, XLS, PPT, DOCX, XLSX, PPTX<br>
								• Tamanho máximo: 200MB por arquivo<br>
								• Para excluir, clique no ❌ no canto superior direito
							</div>
						</div>
					</div>

					<div class="separador"></div>
					
					<div class="linha linha-auto">

						<div class="exibir-anexos">';								// Exibir anexos existentes
								foreach($anexos_existentes as $anexo) {
									$extensao = strtoupper(pathinfo($anexo['arquivo'], PATHINFO_EXTENSION));
									echo '
									<div class="thumb-anexo" data-anexo-id="'. $anexo['id'] .'">
										<div class="thumb-anexo-excluir" onclick="excluirAnexoExistente('. $anexo['id'] .')">❌</div>
										<div class="thumb-anexo-content" style="padding: 0.5vw; text-align: center;">
											<div class="thumb-anexo-icon"></div>
											<div class="thumb-anexo-nome" style="font-size: 0.7vw; color: var(--fonte_padrao);">
												'. htmlspecialchars($anexo['nome']) .'
											</div>
											<div style="font-size: 0.6vw; color: var(--cinza-escuro); margin-top: 0.3vw;">
												'. date('d/m/Y', strtotime($anexo['created_at'])) .'
											</div>
											<a href="'. $raiz_site . 'uploads/' . $anexo['arquivo'] .'" 
												target="_blank" 
												style="
													display: inline-block;
													background: var(--verde-escuro);
													color: var(--branco);
													padding: 0.2vw 0.4vw;
													border-radius: 0.1vw;
													text-decoration: none;
													font-size: 0.6vw;
													margin-top: 0.3vw;
												"
											>Ver</a>
										</div>
									</div>';
								}
								
								echo '
								</div>
								
							</div>

							<div class="separador"></div>
							<!-- End - Anexos Section -->

							<div class="linha linha-auto">
								<div class="col10">
									<span>Objeto: </span>
								</div>
								<div class="col90">
									<span>
										<textarea name="objeto">'. $item['objeto'] .'</textarea>
									</span>
								</div>
							</div>

							<div class="linha linha-auto">
								<div class="col10">
									<span>Mensagem: </span>
								</div>
								<div class="col90">
									<span>
										<textarea name="mensagem">'. $item['mensagem'] .'</textarea>
									</span>
								</div>
							</div>

							<div class="linha">
								<div class="col100">
									<span>Texto: </span>
								</div>
							</div>
							
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
					';
					
				}
				
			}
			
		?>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			// Detectar tema do usuário via PHP
			<?php
			$temaEscuro = false;
			foreach( $admin_user_array as $cfg ){
				if( $cfg['tema'] == 'escuro' && $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $cfg['usuario'] ){ 
					$temaEscuro = true;
					break;
				}
			}
			?>
			
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
				theme: <?php echo $temaEscuro ? '"dark"' : '"default"'; ?>, // Aplicar tema baseado na configuração do usuário
			});
			
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			
			//console.log( editor_de_texto_json );
			
			document.querySelector('#editor').value = editor_de_texto_json;
			//document.querySelector('.editor_de_texto #text-input').innerHTML = editor_de_texto_json;
			editor.value = editor_de_texto_json;
			/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=licitacoes';
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			function abrirArquivosParaAnexo(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
				// Marcar que é para anexo
				window.anexoMode = true;
				
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

			// === SISTEMA DE ANEXOS (SIMPLIFICADO COMO CRIAR.PHP) ===
			
			const licitacaoId = <?= intval($item['id']) ?>;

			// Função para excluir anexo existente
			function excluirAnexoExistente(anexoId) {
				if (confirm('Tem certeza que deseja excluir este anexo?')) {
					
					const xhr = new XMLHttpRequest();
					
					xhr.onreadystatechange = function() {
						if (xhr.readyState === 4) {
							if (xhr.status === 200) {
								try {
									const resposta = JSON.parse(xhr.responseText);
									if (resposta.sucesso) {
										// Remover elemento da interface
										const elemento = document.querySelector(`[data-anexo-id="${anexoId}"]`);
										if (elemento) {
											elemento.remove();
										}
										alert('Anexo excluído com sucesso!');
									} else {
										alert('Erro: ' + resposta.mensagem);
									}
								} catch (e) {
									console.error('Erro ao processar resposta:', xhr.responseText);
									alert('Erro ao processar resposta do servidor');
								}
							} else {
								alert('Erro ao excluir arquivo. Código: ' + xhr.status);
							}
						}
					};
					
					xhr.open('POST', '../controller/excluir-anexo.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.send('anexo_id=' + anexoId);
				}
			}

			// Configurar drag & drop na área de anexos
			document.addEventListener('DOMContentLoaded', function() {
				const exibirAnexos = document.querySelector('.exibir-anexos');
				const inputAnexos = document.getElementById('arquivo_anexos');
				
				if (exibirAnexos && inputAnexos) {
					// Drag & Drop events
					exibirAnexos.addEventListener('dragover', function(e) {
						e.preventDefault();
						this.classList.add('drag-over');
					});
					
					exibirAnexos.addEventListener('dragleave', function(e) {
						e.preventDefault();
						this.classList.remove('drag-over');
					});
					
					exibirAnexos.addEventListener('drop', function(e) {
						e.preventDefault();
						this.classList.remove('drag-over');
						
						const files = e.dataTransfer.files;
						if (files.length > 0) {
							inputAnexos.files = files;
							processarAnexos(files);
						}
					});
					
					// Mudança no input
					inputAnexos.addEventListener('change', function() {
						if (this.files.length > 0) {
							processarAnexos(this.files);
						}
					});
				}
			});

			// Processar anexos selecionados
			function processarAnexos(files) {
				Array.from(files).forEach(file => {
					enviarAnexo(file);
				});
			}

			// Enviar anexo individual
			function enviarAnexo(file) {
				const formData = new FormData();
				formData.append('anexo', file);
				formData.append('licitacao_id', licitacaoId);

				const xhr = new XMLHttpRequest();
				
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							try {
								const resposta = JSON.parse(xhr.responseText);
								if (resposta.sucesso) {
									// Recarregar página para mostrar novo anexo
									location.reload();
								} else {
									alert('Erro: ' + resposta.mensagem);
								}
							} catch (e) {
								console.error('Erro ao processar resposta:', xhr.responseText);
								alert('Erro ao processar resposta do servidor');
							}
						} else {
							alert('Erro ao enviar arquivo. Código: ' + xhr.status);
						}
					}
				};

				xhr.open('POST', '../controller/enviar-anexo.php', true);
				xhr.send(formData);
			}
			
			function adicionarArquivoComoAnexo(nomeArquivo) {
				// Verificar se o arquivo já está sendo usado como edital
				const editalAtual = document.querySelector('[name="edital"]').value;
				const arquivoEdital = editalAtual.replace('uploads/', '');
				const arquivoAnexo = nomeArquivo.replace('uploads/', '');
				
				if(arquivoAnexo === arquivoEdital && arquivoEdital !== '') {
					alert('❌ ERRO: Este arquivo já está sendo usado como EDITAL da licitação.\n\nO EDITAL não pode ser adicionado como anexo.');
					return;
				}
				
				// Verificar se o arquivo já existe como anexo
				const anexosExistentes = document.querySelectorAll('.thumb-anexo-nome');
				for(let anexo of anexosExistentes) {
					if(anexo.textContent.trim() === nomeArquivo) {
						alert('Este arquivo já foi adicionado como anexo.');
						return;
					}
				}
				
				// Criar um objeto FormData para enviar o arquivo do servidor como anexo
				const formData = new FormData();
				formData.append('arquivo_servidor', nomeArquivo);
				formData.append('licitacao_id', licitacaoId);

				const xhr = new XMLHttpRequest();
				
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							try {
								const response = JSON.parse(xhr.responseText);
								if(response.sucesso) {
									alert('Arquivo anexado com sucesso!');
									// Recarregar a página para mostrar o novo anexo
									location.reload();
								} else {
									alert('Erro: ' + response.mensagem);
								}
							} catch(e) {
								alert('Erro ao processar resposta do servidor');
							}
						} else {
							alert('Erro ao anexar arquivo. Código: ' + xhr.status);
						}
					}
				};

				xhr.open('POST', '../controller/enviar-anexo-servidor.php', true);
				xhr.send(formData);
			}
			
		</script>
		
	</body>
	
</html>