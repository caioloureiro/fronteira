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
require $raiz_site .'model/licitacoes_categorias.php';
require $raiz_site .'model/licitacoes_situacao.php';
require $raiz_site .'model/admin_user.php';

usort($licitacoes_categorias_array, function( $a, $b ){ //Função responsável por ordenar
	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	if ($al == $bl){ return 0; }
	return ($bl < $al) ? +1 : -1; // < ASC; > DESC
});
usort($licitacoes_situacao_array, function( $a, $b ){ //Função responsável por ordenar
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
		<title>Criar licitação</title>
		
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
			
			/* Ícone X superior - tema responsivo */
			<?php
			foreach( $admin_user_array as $cfg ){
				if( $cfg['tema'] == 'escuro' && $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $cfg['usuario'] ){ 
					echo '.lightbox-fechar { filter: brightness(0) invert(1); }';
				}
			}
			?>
			
			/* Estilos para o sistema de anexos */
			.anexos-info {
				background: #f8f9fa;
				border: 1px solid #dee2e6;
				border-radius: 6px;
				padding: 12px;
				font-size: 13px;
				color: #495057;
				line-height: 1.4;
			}
			
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
				margin-bottom: 10px;
			}
			
			.thumb-anexo-nome {
				font-size: 11px;
				text-align: center;
				color: #495057;
				word-break: break-all;
				line-height: 1.2;
				max-height: 40px;
				overflow: hidden;
			}
			
			#arquivo_anexos {
				display: none;
			}
			
			.arquivo_escolhido_anexos {
				background: #007bff !important;
				color: white !important;
				border: none !important;
				padding: 10px 20px !important;
				border-radius: 6px !important;
				cursor: pointer !important;
				font-weight: 500 !important;
			}
			
			.arquivo_escolhido_anexos:hover {
				background: #0056b3 !important;
			}
			
			/* Estilos para arquivo de edital selecionado */
			#arquivo-selecionado-edital {
				width: 100%;
				height: auto;
				background-color: var(--fundo_02);
				background-image: none;
				border: 0.1vw solid var(--cinza_claro);
				border-radius: 0.3vw;
				float: left;
				margin-top: 0.3vw;
				margin-bottom: 0vw;
				padding-left: 0.5vw;
				box-sizing: border-box;
				-webkit-box-sizing: border-box;
				overflow:hidden;
			}
			
			#arquivo-selecionado-edital .nome-arquivo {
				width: auto;
				height: auto;
				color: var(--fonte_padrao);
				font-weight: normal;
				font-size: 0.8vw;
				line-height: 1.5vw;
				float: left;
				margin: 0vw;
				overflow: hidden;
				text-overflow: ellipsis;
				white-space: nowrap;
			}
			
			#arquivo-selecionado-edital .excluir-arquivo {
				width: auto;
				height: auto;
				cursor: pointer;
				font-size: 0.9vw;
				line-height: 1.5vw;
				color: var(--vermelho);
				float: right;
				margin: 0vw;
				margin-left: 0.5vw;
				background-color: var(--teste00);
				border: none;
				border-radius: 0.2vw;
				transition: all 0.2s ease;
				overflow:hidden;
			}
			
			#arquivo-selecionado-edital .excluir-arquivo:hover {
				color: var(--vermelho);
				background-color: var(--vermelho_transp);
			}
			
			/* Estilo para coluna fixa */
			.col25 {
				display:block
			}
		</style>
	
		<div class="lightbox licitacao-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova licitação
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
					<div class="col40">
						<input 
							name="nome" 
							required
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
							value="<?php echo date('Y-m-d\TH:i'); ?>"
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
							value="<?php echo date('Y-m-d\TH:i'); ?>"
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
								
								<?php
									
									foreach( $licitacoes_categorias_array as $cat ){

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
								
								<?php
									
									foreach( $licitacoes_situacao_array as $sit ){

										echo '
										<option 
											value="'. $sit['nome'] .'"
										>'. $sit['nome'] .'</option>
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
								id="btn-enviar-edital"
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
							style="display: none;"
							required
						/>
						<div id="arquivo-selecionado-edital" style="display: none;">
							<span class="nome-arquivo"></span>
							<span class="excluir-arquivo" onclick="excluirEdital()" title="Remover arquivo">🗑️</span>
						</div>
					</div>
				</div>

				<div class="linha linha-auto">
					<div class="col10">
						<span>Objeto: </span>
					</div>
					<div class="col90">
						<span>
							<textarea name="objeto"></textarea>
						</span>
					</div>
				</div>

				<div class="linha linha-auto">
					<div class="col10">
						<span>Mensagem: </span>
					</div>
					<div class="col90">
						<span>
							<textarea name="mensagem"></textarea>
						</span>
					</div>
				</div>

				<div class="linha">
					<div class="col100">
						<span>📎 Anexos da Licitação: </span>
					</div>
				</div>
				
				<div class="linha-acao">
					
					<div class="col30">
					
						<input 
							type="text" 
							class="licitacao_id"
							name="licitacao_id" 
							value="nova" 
							style="display:none;"
						/>
						
						<label 
							class="btn arquivo_escolhido_anexos" 
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
						
						<div class="btn" 
							onclick="abrirArquivosParaAnexo()" 
							style="
								background: var(--azul); 
								color: var(--branco); 
								margin-top: 0.5vw;
							"
							title="Selecionar arquivo já existente no servidor"
						>🗃️ Anexar Arquivo do Servidor</div>
						
					</div>
					
					<div class="col70">
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

				<div class="separador"></div>

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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
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
			/*End - JODIT*/
			
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
							
							// Mostrar o arquivo selecionado
							mostrarArquivoSelecionado(xhr.responseText);
							
						}
						
					};

					xhr.send( formData );
					
				}
				else{
					console.log( 'Nenhum arquivo selecionado.' );
				}
				
			}
			
			// Função para mostrar arquivo selecionado
			function mostrarArquivoSelecionado(nomeArquivo) {
				console.log('=== MOSTRANDO ARQUIVO ===');
				console.log('Nome recebido:', nomeArquivo);
				
				let arquivoSelecionado = document.getElementById('arquivo-selecionado-edital');
				
				if (!arquivoSelecionado) {
					console.error('Elemento #arquivo-selecionado-edital não encontrado!');
					return;
				}
				
				let nomeArquivoSpan = arquivoSelecionado.querySelector('.nome-arquivo');
				let botaoEnviar = document.getElementById('btn-enviar-edital');
				
				console.log('Div encontrada:', arquivoSelecionado);
				console.log('Span encontrado:', nomeArquivoSpan);
				
				if (arquivoSelecionado && nomeArquivoSpan) {
					// Mostrar o nome renomeado completo (com prefixo de data)
					console.log('Nome final (renomeado):', nomeArquivo);
					
					nomeArquivoSpan.textContent = nomeArquivo;
					arquivoSelecionado.style.display = 'block';
					
					console.log('Arquivo exibido com sucesso!');
				} else {
					console.log('ERRO: Elementos não encontrados!');
				}
			}
			
			// Função para mostrar arquivo selecionado do servidor
			function mostrarArquivoSelecionadoServidor(nomeArquivo) {
				console.log('=== MOSTRANDO ARQUIVO DO SERVIDOR ===');
				console.log('Nome recebido:', nomeArquivo);
				
				let arquivoSelecionado = document.getElementById('arquivo-selecionado-edital');
				
				if (!arquivoSelecionado) {
					console.error('Elemento #arquivo-selecionado-edital não encontrado!');
					return;
				}
				
				let nomeArquivoSpan = arquivoSelecionado.querySelector('.nome-arquivo');
				let botaoEnviar = document.getElementById('btn-enviar-edital');
				
				if (arquivoSelecionado && nomeArquivoSpan) {
					nomeArquivoSpan.textContent = nomeArquivo;
					arquivoSelecionado.style.display = 'block';
					
					console.log('Arquivo do servidor exibido!');
				} else {
					console.log('ERRO: Elementos não encontrados!');
				}
			}
			
			// Função para excluir arquivo de edital
			function excluirEdital() {
				// Obter nome do arquivo atual
				let arquivoSelecionado = document.getElementById('arquivo-selecionado-edital');
				if (!arquivoSelecionado) return;
				
				let nomeArquivoSpan = arquivoSelecionado.querySelector('.nome-arquivo');
				let nomeArquivo = nomeArquivoSpan ? nomeArquivoSpan.textContent : '';
				
				if (nomeArquivo) {
					// Fazer requisição para excluir arquivo físico
					let formData = new FormData();
					formData.append('arquivo_nome', nomeArquivo);
					
					let xhr_delete = new XMLHttpRequest();
					xhr_delete.open('POST', '../controller/excluir-arquivo-edital.php', true);
					
					xhr_delete.onload = function () {
						if (xhr_delete.status === 200) {
							console.log('Arquivo físico excluído:', xhr_delete.responseText);
						}
					};
					
					xhr_delete.send(formData);
				}
				
				// Limpar o input
				let inputArquivo = document.querySelector('.item-escolher-arquivo-input');
				if (inputArquivo) {
					inputArquivo.value = '';
				}
				
				// Limpar input file
				let inputFile = document.getElementById('arquivo');
				if (inputFile) {
					inputFile.value = '';
				}
				
				// Ocultar a exibição do arquivo
				if (arquivoSelecionado) {
					arquivoSelecionado.style.display = 'none';
					
					// Limpar o nome do arquivo
					if (nomeArquivoSpan) {
						nomeArquivoSpan.textContent = '';
					}
				}
				
				console.log('Arquivo de edital removido');
			}
			
			/*Start - SISTEMA DE ANEXOS*/
			let arquivo_anexos = document.querySelector('#arquivo_anexos');
			let exibir_anexos = document.querySelector('.exibir-anexos');
			let licitacao_id = document.querySelector('.licitacao_id').value;
			let anexos_contador = 0;

			const date = new Date();
			let dia = date.getDate();
			let mes_num = date.getMonth() + 1;
			let mes = '';
			if( mes_num < 10 ){ mes = '0'+ mes_num; }else{ mes = mes_num; }
			let ano = date.getFullYear();
			let hora_num = date.getHours();
			let hora = '';
			if( hora_num < 10 ){ hora = '0'+ hora_num; }else{ hora = hora_num; }
			let min_num = date.getMinutes();
			let min = '';
			if( min_num < 10 ){ min = '0'+ min_num; }else{ min = min_num; }
			let sec = date.getSeconds();
			let data_invertida = ano+'-'+mes+'-'+dia+'-'+hora+'-'+min+'-';

			function limpar_caracteres( limpar ){
				
				limpar = limpar.replaceAll(' ', '-')
					.replaceAll("'", '')
					.replaceAll('&#039', '')
					.replaceAll('&Auml', 'A')
					.replaceAll('&Ouml', 'Oe')
					.replaceAll('&Uuml', 'Ue')
					.replaceAll('&amp', '')
					.replaceAll('&auml', 'ae')
					.replaceAll('&gt', '')
					.replaceAll('&lt', '')
					.replaceAll('&ouml', 'oe')
					.replaceAll('&quot', '')
					.replaceAll('&uuml', 'ue')
					.replaceAll('À', 'A')
					.replaceAll('Á', 'A')
					.replaceAll('Â', 'A')
					.replaceAll('Ã', 'A')
					.replaceAll('Ä', 'Ae')
					.replaceAll('Å', 'A')
					.replaceAll('Æ', 'Ae')
					.replaceAll('Ç', 'C')
					.replaceAll('È', 'E')
					.replaceAll('É', 'E')
					.replaceAll('Ê', 'E')
					.replaceAll('Ë', 'E')
					.replaceAll('Ì', 'I')
					.replaceAll('Í', 'I')
					.replaceAll('Î', 'I')
					.replaceAll('Ï', 'I')
					.replaceAll('Ð', 'D')
					.replaceAll('Ñ', 'N')
					.replaceAll('Ò', 'O')
					.replaceAll('Ó', 'O')
					.replaceAll('Ô', 'O')
					.replaceAll('Õ', 'O')
					.replaceAll('Ö', 'Oe')
					.replaceAll('Ø', 'O')
					.replaceAll('Ù', 'U')
					.replaceAll('Ú', 'U')
					.replaceAll('Û', 'U')
					.replaceAll('Ü', 'Ue')
					.replaceAll('Ý', 'Y')
					.replaceAll('Þ', 'T')
					.replaceAll('ß', 'ss')
					.replaceAll('à', 'a')
					.replaceAll('á', 'a')
					.replaceAll('â', 'a')
					.replaceAll('ã', 'a')
					.replaceAll('ä', 'ae')
					.replaceAll('å', 'a')
					.replaceAll('æ', 'ae')
					.replaceAll('ç', 'c')
					.replaceAll('è', 'e')
					.replaceAll('é', 'e')
					.replaceAll('ê', 'e')
					.replaceAll('ë', 'e')
					.replaceAll('ì', 'i')
					.replaceAll('í', 'i')
					.replaceAll('î', 'i')
					.replaceAll('ï', 'i')
					.replaceAll('ð', 'd')
					.replaceAll('ñ', 'n')
					.replaceAll('ò', 'o')
					.replaceAll('ó', 'o')
					.replaceAll('ô', 'o')
					.replaceAll('õ', 'o')
					.replaceAll('ö', 'oe')
					.replaceAll('ø', 'o')
					.replaceAll('ù', 'u')
					.replaceAll('ú', 'u')
					.replaceAll('û', 'u')
					.replaceAll('ü', 'ue')
					.replaceAll('ý', 'y')
					.replaceAll('þ', 't')
					.replaceAll('ÿ', 'y');
				
				return limpar;
				
			}

			function uploadAnexo( files ){
				
				console.log( 'Enviando anexos:', files.length ); 
				
				for( let i = 0; i < files.length; i++ ){ 

					var formData = new FormData();
					formData.append( 'arquivo', files[i] );
					formData.append( 'licitacao_id', licitacao_id );
					
					var xhr = new XMLHttpRequest();
					xhr.open( 'POST', '../controller/enviar-anexo.php', true );
					
					xhr.onload = function () {
						
						if ( xhr.status === 200 ) {

							console.log( 'Resposta do servidor:', xhr.responseText );
							
							// Atualizar mensagem do botão
							let arquivo_escolhido_anexos = document.querySelector('.arquivo_escolhido_anexos');
							arquivo_escolhido_anexos.innerHTML = '✅ Anexos enviados com sucesso!';
							
							setTimeout(function() {
								arquivo_escolhido_anexos.innerHTML = '📁 Escolher Anexos do Computador';
							}, 2000);
							
						}
						
					};
					
					xhr.send( formData );
					
				}
				
			};
			
			function excluirAnexo( thumb, arquivo ){
				
				console.log( 'Excluindo anexo:', arquivo ); 
				
				let classe = '.'+ thumb;
				
				document.querySelector( classe ).remove();
				
				var formData_delete = new FormData();
				formData_delete.append( 'arquivo', arquivo );
				
				var xhr_delete = new XMLHttpRequest();
				xhr_delete.open( 'POST', '../controller/excluir-anexo.php', true );
				
				xhr_delete.onload = function () {
					
					if ( xhr_delete.status === 200 ) {

						console.log( 'Anexo excluído:', xhr_delete.responseText );
						
					}
					
				};
				
				xhr_delete.send( formData_delete );
				
			}

			if( document.querySelector('#arquivo_anexos') ){
				
				arquivo_anexos.addEventListener('change', function() {
					processarArquivos(this.files);
				});

			}
			
			// Função para processar arquivos (tanto de drag & drop quanto de seleção)
			function processarArquivos(files) {
				
				console.log( 'Arquivos selecionados:', files.length ); 
				
				var arquivo_escolhido_anexos = document.querySelector('.arquivo_escolhido_anexos');
				
				uploadAnexo( files );

				if( files.length > 1 ){
					arquivo_escolhido_anexos.innerHTML = '📤 Enviando ' + files.length + ' arquivos...';
				}
				else{
					arquivo_escolhido_anexos.innerHTML = '📤 Enviando arquivo...';
				}
				
				for( let i = 0; i < files.length; i++ ){ 
					
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
						<div class="thumb-anexo-nome" title="${renomear}">${renomear}</div>
					</div>
					`;
					
					exibir_anexos.innerHTML += html_anexo;
				}
				
				// Limpar o input para permitir selecionar os mesmos arquivos novamente
				arquivo_anexos.value = '';
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
			/*End - SISTEMA DE ANEXOS*/
			
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
				
				// Adicionar à lista visual usando a mesma função que o sistema atual
				const fakeFile = {
					name: nomeArquivo,
					size: 0,
					type: 'application/octet-stream',
					fromServer: true
				};
				
				adicionarThumbAnexo(fakeFile, nomeArquivo);
				alert('Arquivo do servidor adicionado com sucesso!');
			}
			
		</script>
		
	</body>
	
</html>