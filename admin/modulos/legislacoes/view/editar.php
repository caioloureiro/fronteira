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
require $raiz_site .'model/legislacoes.php';
require $raiz_site .'model/legislacoes_categorias.php';
require $raiz_site .'model/legislacoes_anexos.php';
require $raiz_site .'model/admin_user.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar legislacao</title>
		
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
				word-break: break-word;
				line-height: 1.2;
				max-height: 3vw;
				overflow: hidden;
				text-overflow: ellipsis;
				display: -webkit-box;
				-webkit-line-clamp: 2;
				line-clamp: 2;
				-webkit-box-orient: vertical;
				padding: 0 0.2vw;
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
		</style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $legislacoes_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox legislacao-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar legislacao: '. $item['nome'] .'
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
								<div class="col10">
									<span>Data: </span>
								</div>
								<div class="col20">
									<input 
										type="datetime-local" 
										name="data" 
										value="'. $item['data'] .'" 
										required
									/>
								</div>
								<div class="col10">
									<span>Número: </span>
								</div>
								<div class="col20">
									<input 
										type="text" 
										name="numero" 
										required
										value="'. $item['numero'] .'" 
									/>
								</div>
								<div class="col10">
									<span>Categoria: </span>
								</div>
								<div class="col30">
									<span>
										<select 
											name="categoria" 
											required
										>
											<option value="0">Selecione a categoria</option>
											
											';
												
												foreach( $legislacoes_categorias_array as $cat ){

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
									<span>Customizar link do edital:</span>
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
								<div class="col100">
									<span>Texto: </span>
								</div>
							</div>
							
							<div class="linha linha-auto">
								<textarea id="editor" name="editor_texto"></textarea>
							</div>

							<div class="separador"></div>
							
							<!-- Start - Anexos Section -->
							<div class="linha">
								<div class="col100">
									<span>📎 Anexos da Legislação: </span>
								</div>
							</div>
							
							';
								// Buscar anexos existentes usando o array do model
								$anexos_existentes = [];
								if(isset($legislacoes_anexos_array) && is_array($legislacoes_anexos_array)) {
									foreach($legislacoes_anexos_array as $anexo) {
										// Forçar comparação como inteiros e excluir o arquivo do edital
										if(isset($anexo['legislacao']) && isset($anexo['ativo']) && isset($anexo['arquivo']) &&
										   intval($anexo['legislacao']) == intval($item['id']) && 
										   intval($anexo['ativo']) == 1 && 
										   $anexo['arquivo'] != $item['arquivo']) {
											$anexos_existentes[] = $anexo;
										}
									}
								}
							echo'
							
							<div class="linha">
								
								<div class="col100">
								
									<input 
										type="text" 
										class="legislacao_id"
										name="legislacao_id" 
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

								<div class="exibir-anexos">';
								
								// Exibir anexos existentes
								foreach($anexos_existentes as $anexo) {
									$extensao = strtoupper(pathinfo($anexo['arquivo'], PATHINFO_EXTENSION));
									
									// Se o nome estiver vazio, extrair do arquivo removendo timestamp
									$nome_exibir = $anexo['nome'];
									if(empty($nome_exibir)) {
										$nome_exibir = preg_replace('/^\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2}-/', '', $anexo['arquivo']);
									}
									
									echo '
									<div class="thumb-anexo" data-anexo-id="'. $anexo['id'] .'">
										<div class="thumb-anexo-excluir" title="Excluir anexo">❌</div>
										<div class="thumb-anexo-content" style="padding: 0.5vw; text-align: center;">
											<div class="thumb-anexo-icon"></div>
											<div class="thumb-anexo-nome" style="font-size: 0.7vw; color: var(--fonte_padrao);">
												'. htmlspecialchars($nome_exibir) .'
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
									</div>
									';
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=legislacoes';
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			function abrirArquivosParaAnexo(){
				document.querySelector('.item-arquivos').classList.add("on");
				
				// Marcar que é para anexo
				window.anexoMode = true;
			}
			
			/*Start - SISTEMA DE ANEXOS*/
			let anexos_contador = 0;
			const legislacaoId = document.querySelector('.legislacao_id').value;
			
			// Função para processar arquivos (local ou drag & drop)
			function processarArquivos(files) {
				
				// Para editar.php, enviamos diretamente para o servidor
				for(let i = 0; i < files.length; i++) {
					enviarAnexo(files[i]);
				}
			}
			
			// Função para enviar anexo individual
			function enviarAnexo(file) {
				const formData = new FormData();
				formData.append('arquivos_anexos[]', file);
				formData.append('legislacao', legislacaoId);

				const xhr = new XMLHttpRequest();
				
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							try {
								console.log('Resposta do servidor:', xhr.responseText);
								const response = JSON.parse(xhr.responseText);
								if(response.sucesso) {
									console.log('Anexo enviado com sucesso!');
									// Aguardar um pouco antes de recarregar anexos
									setTimeout(function() {
										carregarAnexos();
									}, 500);
								} else {
									alert('Erro: ' + response.mensagem);
								}
							} catch(e) {
								console.error('Erro ao processar JSON:', e);
								console.error('Resposta recebida:', xhr.responseText);
								alert('Erro ao processar resposta do servidor: ' + e.message);
							}
						} else {
							alert('Erro ao enviar arquivo. Código: ' + xhr.status);
						}
					}
				};

				xhr.open('POST', '../controller/enviar-anexo.php', true);
				xhr.send(formData);
			}
			
			// Event listener para o input file
			if( document.querySelector('#arquivo_anexos') ){
				document.querySelector('#arquivo_anexos').addEventListener('change', function() {
					processarArquivos(this.files);
					this.value = ''; // Limpar input
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
			
			// Função para carregar anexos existentes
			function carregarAnexos() {
				const xhr = new XMLHttpRequest();
				xhr.open('GET', '../controller/listar-anexos.php?legislacao=' + legislacaoId, true);
				
				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						console.log('HTML recebido:', xhr.responseText);
						document.querySelector('.exibir-anexos').innerHTML = xhr.responseText;
						console.log('HTML inserido na página');
					}
				};
				
				xhr.send();
			}
			
			// Função para excluir anexo
			function excluirAnexo(idAnexo) {
				if (confirm('Tem certeza que deseja excluir este anexo?')) {
					const xhr = new XMLHttpRequest();
					xhr.open('POST', '../controller/excluir-anexo.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							try {
								const response = JSON.parse(xhr.responseText);
								if (response.sucesso) {
									carregarAnexos();
								} else {
									alert('Erro ao excluir anexo: ' + response.mensagem);
								}
							} catch(e) {
								console.error('Erro ao processar resposta:', e);
								console.error('Resposta recebida:', xhr.responseText);
								alert('Erro ao processar resposta do servidor');
							}
						}
					};
					
					xhr.send('anexo_id=' + idAnexo);
				}
			}
			
			// Função para adicionar arquivo do servidor como anexo
			function adicionarArquivoComoAnexo(nomeArquivo) {
				const xhr = new XMLHttpRequest();
				xhr.open('POST', '../controller/enviar-anexo-servidor.php', true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				
				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							try {
								const response = JSON.parse(xhr.responseText);
								if (response.sucesso) {
									console.log('Arquivo do servidor anexado com sucesso');
									carregarAnexos();
									alert('Arquivo anexado com sucesso!');
								} else {
									alert('Erro ao anexar arquivo: ' + response.mensagem);
								}
							} catch(e) {
								console.error('Erro ao processar resposta:', e);
								alert('Erro ao processar resposta do servidor');
							}
						} else {
							alert('Erro na comunicação com o servidor');
						}
					}
				};
				
				const params = 'arquivo_servidor=' + encodeURIComponent(nomeArquivo) + 
							  '&legislacao=' + legislacaoId;
				xhr.send(params);
			}
			
			// Carregar anexos existentes ao carregar a página
			// COMENTADO: Anexos já são carregados via PHP, só recarregar após upload/exclusão
			// document.addEventListener('DOMContentLoaded', function() {
			// 	carregarAnexos();
			// });
			
			// Event delegation para botões de excluir anexos (elementos dinâmicos)
			document.addEventListener('click', function(e) {
				// Verificar se clicou no botão de excluir anexo
				if (e.target.classList.contains('thumb-anexo-excluir')) {
					e.preventDefault();
					e.stopPropagation();
					
					// Pegar o ID do anexo do elemento pai
					const thumbAnexo = e.target.closest('.thumb-anexo');
					if (thumbAnexo) {
						const idAnexo = thumbAnexo.getAttribute('data-anexo-id');
						if (idAnexo) {
							excluirAnexo(idAnexo);
						}
					}
				}
			});
			/*End - SISTEMA DE ANEXOS*/
			
			function enviarArquivo(){
				
				let arquivo_subir = document.querySelector('[name="arquivo_subir"]');
				
				if( arquivo_subir.files.length > 0 ){
					
					let formData = new FormData();
					formData.append( 'arquivo_subir', arquivo_subir.files[0] );
					
					let xhr = new XMLHttpRequest();
					
					xhr.onreadystatechange = function(){
						
						if( xhr.readyState == 4 && xhr.status == 200 ){
							
							document.querySelector('[name="arquivo_subir"]').value = '';
							document.querySelector('.item-escolher-arquivo-input').value = '';
							document.querySelector('.item-escolher-arquivo-input').value = 'uploads/'+ xhr.responseText;
							
						}
						
					};

					xhr.open( 'POST', '../../../routes/enviar-arquivo.php' );
					xhr.send( formData );
					
				}
				else{
					console.log( 'Nenhum arquivo selecionado.' );
				}
				
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