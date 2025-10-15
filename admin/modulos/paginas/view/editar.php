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
require $raiz_site .'model/paginas_anexos.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar paginas</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
	
	</head>
	<body>
		
		<style>
			<?php 
				require $raiz_admin .'routes/css-modulo.php'; 
			?>
			
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
				background: var(--azul) !important;
				color: white !important;
				border: none !important;
				padding: 0.8vw 1.5vw !important;
				border-radius: 0.3vw !important;
				cursor: pointer !important;
				font-size: 0.8vw !important;
				transition: all 0.3s ease !important;
				display: inline-block !important;
				margin-right: 1vw !important;
				margin-bottom: 1vw !important;
				text-align: center !important;
				white-space: nowrap !important;
				vertical-align: top !important;
			}
			
			.arquivo_escolhido_anexos:hover {
				background: var(--azul-escuro) !important;
			}
			
			.btn-anexo-servidor {
				background: var(--azul) !important;
				color: var(--branco) !important;
				display: inline-block !important;
				padding: 0.8vw 1.5vw !important;
				border-radius: 0.3vw !important;
				cursor: pointer !important;
				font-size: 0.8vw !important;
				text-align: center !important;
				transition: all 0.3s ease !important;
				margin-bottom: 1vw !important;
				white-space: nowrap !important;
				vertical-align: top !important;
			}
			
			.btn-anexo-servidor:hover {
				background: var(--azul-escuro) !important;
			}
			
			.anexos-info {
				background: var(--fundo_02);
				border: 0.1vw solid var(--cinza_claro);
				border-radius: 0.3vw;
				padding: 1vw;
				font-size: 0.7vw;
				line-height: 1.4;
				color: var(--fonte_padrao);
				margin-top: 1vw;
			}
			
			.info_pagina{
				display:none;
			}
		</style>
	
		<?php 
		
			require $raiz_admin .'view/escurecer.php'; 
			
			$pasta_nome = 'img';
			$pasta = $raiz_site .'img/';
			
			require 'imagens.php';
			require 'visualizar_pagina.php';
			
		?>
		
		<div class="box">
		
			<?php
				
				$editor_de_texto_valor = '';
				
				foreach( $paginas as $pag ){
					
					if( $pag['id'] == $_GET['id'] ){
						
						/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
						$editor_de_texto_json = json_encode( $pag['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
						//dd( $editor_de_texto_json );
						/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					
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
									<div class="col20">
										<span><div class="btn" onclick="abrir_lightbox()">Preview</div></span>
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
									<textarea id="editor" name="editor_texto"></textarea>
								</div>

								<div class="separador"></div>
								
								<!-- Start - Anexos Section -->
								<div class="linha">
									<div class="col100">
										<span>📎 Anexos da Página: </span>
									</div>
								</div>
								
								<div class="linha">
									
									<div class="col100">
									
										<label 
											class="arquivo_escolhido_anexos" 
											for="arquivo_anexos" 
											title="Clique aqui para selecionar os arquivos desejados."
										>📁 Escolher Anexos do Computador</label>
										
										<input 
											type="file" 
											name="arquivos_anexos[]" 
											id="arquivo_anexos" 
											class="btn"
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
									<div class="exibir-anexos" id="exibir_anexos_'. $pag['id'] .'">
										'; 
										
										// Carregar anexos existentes
										foreach( $paginas_anexos_array as $anexo ){
											if( $anexo['pagina'] == $pag['id'] ){
												echo '
												<div class="thumb-anexo" data-anexo-id="'. $anexo['id'] .'">
													<div 
														class="thumb-anexo-excluir"
														onclick="excluirAnexoExistente( '. $anexo['id'] .', this )"
														title="Excluir anexo"
													>❌</div>
													<div class="thumb-anexo-icon"></div>
													<div class="thumb-anexo-nome" title="'. htmlspecialchars($anexo['nome']) .'">'. htmlspecialchars($anexo['nome']) .'</div>
												</div>
												';
											}
										}
										
										echo '
									</div>
								</div>
								<!-- End - Anexos Section -->

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
			
		</div>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			
			console.log( editor_de_texto_json );
			
			/*Start - JODIT com tema dinâmico*/
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
				language: "pt_br",
				theme: <?php echo $temaEscuro ? '"dark"' : '"default"'; ?>
			});
			editor.value = editor_de_texto_json;
			/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			
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

			function abrir_lightbox(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-visualizar_pagina').classList.add('on');
				
			}

			function fechar_lightbox(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.item-visualizar_pagina').classList.remove('on');
				
			}
			
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
			
			// Função para abrir arquivos do servidor para anexo
			function abrirArquivosParaAnexo() {
				document.querySelector('.item-arquivos').classList.add("on");
				
				// Marcar que é para anexo
				window.anexoMode = true;
			}
			
			/*Start - SISTEMA DE ANEXOS*/
			let anexos_contador = 0;
			const pagina_id = <?php echo $_GET['id']; ?>;
			
			// Função para processar arquivos (local ou drag & drop) 
			function processarArquivos(files) {
				
				for(let i = 0; i < files.length; i++) {
					uploadAnexo(files[i]);
				}
			}
			
			// Função para fazer upload via AJAX
			function uploadAnexo(file) {
				
				let formData = new FormData();
				formData.append('arquivos_anexos[]', file);
				formData.append('pagina', pagina_id);
				
				let xhr = new XMLHttpRequest();
				
				xhr.open('POST', '../controller/enviar-anexo.php', true);
				
				xhr.onload = function() {
					if (xhr.status === 200) {
						try {
							let resposta = JSON.parse(xhr.responseText);
							
							if(resposta.sucesso) {
								// Adicionar anexo à exibição
								anexos_contador++;
								
								let html_anexo = `
								<div class="thumb-anexo" data-anexo-id="${resposta.anexo.id}">
									<div 
										class="thumb-anexo-excluir"
										onclick="excluirAnexoExistente( ${resposta.anexo.id}, this )"
										title="Excluir anexo"
									>❌</div>
									<div class="thumb-anexo-icon"></div>
									<div class="thumb-anexo-nome" title="${resposta.anexo.nome_original}">${resposta.anexo.nome_original}</div>
								</div>
								`;
								
								document.querySelector('.exibir-anexos').innerHTML += html_anexo;
								
								alert('Anexo enviado com sucesso!');
							} else {
								alert('Erro: ' + resposta.mensagem);
							}
						} catch(e) {
							console.error('Erro ao processar resposta:', e);
							alert('Erro ao processar resposta do servidor.');
						}
					} else {
						alert('Erro ao enviar arquivo. Código: ' + xhr.status);
					}
				};
				
				xhr.onerror = function() {
					alert('Erro de conexão ao enviar arquivo.');
				};
				
				xhr.send(formData);
			}
			
			// Função para excluir anexo existente
			function excluirAnexoExistente(anexo_id, elemento) {
				if(confirm('Tem certeza que deseja excluir este anexo?')) {
					
					let xhr = new XMLHttpRequest();
					xhr.open('POST', '../controller/excluir-anexo.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					
					xhr.onload = function() {
						if (xhr.status === 200) {
							try {
								let resposta = JSON.parse(xhr.responseText);
								
								if(resposta.sucesso) {
									// Remover elemento da tela
									elemento.closest('.thumb-anexo').remove();
									alert('Anexo excluído com sucesso!');
								} else {
									alert('Erro: ' + resposta.mensagem);
								}
							} catch(e) {
								console.error('Erro ao processar resposta:', e);
								alert('Erro ao processar resposta do servidor.');
							}
						} else {
							alert('Erro ao excluir anexo. Código: ' + xhr.status);
						}
					};
					
					xhr.onerror = function() {
						alert('Erro de conexão ao excluir anexo.');
					};
					
					xhr.send('id=' + anexo_id);
				}
			}
			
			// Event listener para o input file
			if( document.querySelector('#arquivo_anexos') ){
				document.querySelector('#arquivo_anexos').addEventListener('change', function(e) {
					e.preventDefault();
					e.stopPropagation();
					
					if(this.files.length > 0) {
						processarArquivos(this.files);
						
						// Limpar input após processar
						const inputFile = this;
						setTimeout(function() {
							inputFile.value = '';
						}, 100);
					}
				});
			}
			
			// Suporte para Drag & Drop
			if( document.querySelector('.exibir-anexos') ){
				
				let dropZone = document.querySelector('.exibir-anexos');
				
				// Prevenir comportamento padrão
				['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
					dropZone.addEventListener(eventName, preventDefaults, false);
					document.body.addEventListener(eventName, preventDefaults, false);
				});
				
				// Destacar área quando arrastar sobre ela
				['dragenter', 'dragover'].forEach(eventName => {
					dropZone.addEventListener(eventName, highlight, false);
				});
				
				['dragleave', 'drop'].forEach(eventName => {
					dropZone.addEventListener(eventName, unhighlight, false);
				});
				
				// Processar arquivos soltos
				dropZone.addEventListener('drop', handleDrop, false);
				
				function preventDefaults (e) {
					e.preventDefault();
					e.stopPropagation();
				}
				
				function highlight(e) {
					dropZone.classList.add('drag-over');
				}
				
				function unhighlight(e) {
					dropZone.classList.remove('drag-over');
				}
				
				function handleDrop(e) {
					let dt = e.dataTransfer;
					let files = dt.files;
					
					processarArquivos(files);
				}
			}
			
			// Função para adicionar arquivo do servidor como anexo
			function adicionarArquivoComoAnexo(nomeArquivo) {
				
				// Verificar se já existe
				const anexosExistentes = document.querySelectorAll('.thumb-anexo');
				for(let anexo of anexosExistentes) {
					const nomeExistente = anexo.querySelector('.thumb-anexo-nome');
					if(nomeExistente && nomeExistente.textContent.trim() === nomeArquivo) {
						alert('Este arquivo já foi adicionado como anexo.');
						return;
					}
				}
				
				// Enviar para o servidor
				let xhr = new XMLHttpRequest();
				xhr.open('POST', '../controller/enviar-anexo-servidor.php', true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				
				xhr.onload = function() {
					if (xhr.status === 200) {
						try {
							let resposta = JSON.parse(xhr.responseText);
							
							if(resposta.sucesso) {
								// Adicionar à lista visual
								anexos_contador++;
								
								let html_anexo = `
								<div class="thumb-anexo" data-anexo-id="${resposta.anexo.id}">
									<div 
										class="thumb-anexo-excluir"
										onclick="excluirAnexoExistente( ${resposta.anexo.id}, this )"
										title="Excluir anexo"
									>❌</div>
									<div class="thumb-anexo-icon"></div>
									<div class="thumb-anexo-nome" title="${nomeArquivo}">${nomeArquivo}</div>
								</div>
								`;
								
								document.querySelector('.exibir-anexos').innerHTML += html_anexo;
								alert('Arquivo do servidor adicionado com sucesso!');
							} else {
								alert('Erro: ' + resposta.mensagem);
							}
						} catch(e) {
							console.error('Erro ao processar resposta:', e);
							alert('Erro ao processar resposta do servidor.');
						}
					} else {
						alert('Erro ao adicionar arquivo. Código: ' + xhr.status);
					}
				};
				
				xhr.onerror = function() {
					alert('Erro de conexão ao adicionar arquivo.');
				};
				
				xhr.send('nome_arquivo=' + encodeURIComponent(nomeArquivo) + '&pagina=' + pagina_id);
			}
			/*End - SISTEMA DE ANEXOS*/
			
		</script>
		
	</body>
	
</html>