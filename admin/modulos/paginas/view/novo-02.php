<?php
//

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

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>criar paginas</title>
		
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
			
		?>
		
		<div class="lightbox pagina-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova Página
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
			
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<input 
							name="titulo" 
							required 
						/>
					</div>
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
								<option value="0">Não</option>
								<option value="1">Sim</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="info_pagina">
					
					<div class="separador"></div>
					
					<div class="linha linha-auto">

						<div class="col10"><span>Imagem: </span></div>
						
						<div class="col90">
							<div 
								class="escolher-imagem-btn item-escolher-imagem-btn" 
								onclick="abrir_item_imagens()" 
								style="background-image:url(  )"
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
								<input name="representante" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Telefone: </span>
						</div>
						<div class="col10">
							<span>
								<input name="telefone" />
							</span>
						</div>
						<div class="col10">
							<span>E-mail: </span>
						</div>
						<div class="col30">
							<span>
								<input name="email" />
							</span>
						</div>
						<div class="col10">
							<span>Atendimento: </span>
						</div>
						<div class="col30">
							<span>
								<input name="horario" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Endereço: </span>
						</div>
						<div class="col90">
							<span>
								<input name="endereco" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Site: </span>
						</div>
						<div class="col90">
							<span>
								<input name="site" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Facebook: </span>
						</div>
						<div class="col90">
							<span>
								<input name="facebook" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Instagram: </span>
						</div>
						<div class="col90">
							<span>
								<input name="instagram" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Twitter: </span>
						</div>
						<div class="col90">
							<span>
								<input name="twitter" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Google Maps: </span>
						</div>
						<div class="col90">
							<span>
								<input name="localizacao" />
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
					<div class="exibir-anexos"></div>
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
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
			/*End - JODIT*/
			
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
			
			// Função para processar arquivos (local ou drag & drop)
			function processarArquivos(files) {
				
				let exibir_anexos = document.querySelector('.exibir-anexos');
				let arquivo_anexos = document.querySelector('#arquivo_anexos');
				
				for(let i = 0; i < files.length; i++) {
					
					let data_atual = new Date();
					let data_invertida = data_atual.getFullYear() + '-' + 
										String(data_atual.getMonth() + 1).padStart(2, '0') + '-' + 
										String(data_atual.getDate()).padStart(2, '0') + '-' + 
										String(data_atual.getHours()).padStart(2, '0') + '-' + 
										String(data_atual.getMinutes()).padStart(2, '0') + '-' + 
										String(data_atual.getSeconds()).padStart(2, '0') + '-';
					
					function limpar_caracteres(str) {
						return str.toLowerCase()
								  .normalize('NFD')
								  .replace(/[\u0300-\u036f]/g, '') // Remove acentos
								  .replace(/[^a-z0-9.-]/g, '') // Remove caracteres especiais, mantém pontos e hífens
								  .replace(/\s+/g, '') // Remove espaços
								  .replace(/-+/g, '-') // Remove hífens múltiplos
								  .trim();
					}
					
					anexos_contador++;
					
					let renomear = data_invertida + limpar_caracteres( files[i].name );
					let nome_original = files[i].name;
					
					let html_anexo = `
					<div class="thumb-anexo thumb_anexo_${anexos_contador}">
						<div 
							class="thumb-anexo-excluir"
							onclick="excluirAnexo( 'thumb_anexo_${anexos_contador}', '${renomear}' )"
							title="Excluir anexo"
						>❌</div>
						<div class="thumb-anexo-icon"></div>
						<div class="thumb-anexo-nome" title="${nome_original}">${nome_original}</div>
					</div>
					`;
					
					exibir_anexos.innerHTML += html_anexo;
				}
				
				// Não limpar o input aqui para evitar re-trigger de eventos
				// arquivo_anexos.value = '';
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
			
			// Função para excluir anexo
			function excluirAnexo(classe_thumb, nome_arquivo) {
				if(confirm('Tem certeza que deseja excluir este anexo?')) {
					document.querySelector('.' + classe_thumb).remove();
				}
			}
			
			// Função para adicionar arquivo do servidor como anexo
			function adicionarArquivoComoAnexo(nomeArquivo) {
				// Para criar.php, vamos adicionar o arquivo à lista local
				// que será enviada quando o formulário for submetido
				
				// Verificar se já existe
				const anexosExistentes = document.querySelectorAll('.thumb-anexo');
				for(let anexo of anexosExistentes) {
					const nomeExistente = anexo.querySelector('.thumb-anexo-nome');
					if(nomeExistente && nomeExistente.textContent.trim() === nomeArquivo) {
						alert('Este arquivo já foi adicionado como anexo.');
						return;
					}
				}
				
				// Adicionar à lista visual
				anexos_contador++;
				
				let html_anexo = `
				<div class="thumb-anexo thumb_anexo_${anexos_contador}">
					<div 
						class="thumb-anexo-excluir"
						onclick="excluirAnexo( 'thumb_anexo_${anexos_contador}', '${nomeArquivo}' )"
						title="Excluir anexo"
					>❌</div>
					<div class="thumb-anexo-icon"></div>
					<div class="thumb-anexo-nome" title="${nomeArquivo}">${nomeArquivo}</div>
				</div>
				`;
				
				document.querySelector('.exibir-anexos').innerHTML += html_anexo;
				alert('Arquivo do servidor adicionado com sucesso!');
			}
			/*End - SISTEMA DE ANEXOS*/
			
		</script>
		
	</body>
	
</html>