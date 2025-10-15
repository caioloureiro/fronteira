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
require $raiz_site .'model/legislacoes_categorias.php';
require $raiz_site .'model/admin_user.php';

usort($legislacoes_categorias_array, function( $a, $b ){ //Função responsável por ordenar
	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	if ($al == $bl){ return 0; }
	return ($bl < $al) ? +1 : -1; // < ASC; > DESC
});


?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar legislação</title>
		
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
	
		<div class="lightbox legislacao-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo legislação
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Nome: </span>
					</div>
					<div class="col90">
						<input 
							name="nome" 
							required
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
							value="<?php echo date('Y-m-d\TH:i'); ?>"
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
								
								<?php
									
									foreach( $legislacoes_categorias_array as $cat ){

										echo '
										<option 
											value="'. $cat['nome'] .'"
										>'. $cat['nome'] .'</option>
										';
										
									}
									
								?>
								
							</select>
						</span>
					</div>
				</div>

				<div class="linha">
					
					<?php 
			
						$pasta_nome = 'uploads';
						$pasta = $raiz_site .'uploads/';
					
						require $raiz_admin .'view/escurecer.php'; 
						require 'arquivos.php';
						
					?>
					
					<div class="col10">
						<span>Arquivo (URL): </span>
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
							name="arquivo" 
							class="item-escolher-arquivo-input"
							required
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
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
				theme: <?php echo $temaEscuro ? '"dark"' : '"default"'; ?>, // Aplicar tema baseado na configuração do usuário
			});
			/*End - JODIT*/
			
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