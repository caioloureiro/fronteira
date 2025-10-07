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
require $raiz_site .'model/esic.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar esic</title>
		
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
			
			/* Destaque para a resposta da prefeitura */
			.resposta-prefeitura {
				background: linear-gradient(135deg, #f8f9ff 0%, #e8f4fd 100%);
				border: 2px solid #0066cc;
				border-radius: 8px;
				padding: 15px;
				margin: 10px 0;
				box-shadow: 0 2px 8px rgba(0, 102, 204, 0.1);
			}
			
			.resposta-prefeitura-titulo {
				color: #0066cc !important;
				font-weight: bold !important;
				font-size: 16px !important;
				display: block;
				margin-bottom: 10px;
				text-shadow: 1px 1px 2px rgba(0, 102, 204, 0.1);
			}
			
			.resposta-prefeitura .jodit-container {
				border: 2px solid #0066cc !important;
				border-radius: 6px !important;
				box-shadow: 0 0 10px rgba(0, 102, 204, 0.2) !important;
			}
			
			.resposta-prefeitura .jodit-toolbar {
				background: linear-gradient(135deg, #0066cc 0%, #004499 100%) !important;
				border-bottom: 1px solid #004499 !important;
			}
			
			.resposta-prefeitura .jodit-toolbar button {
				color: white !important;
			}
			
			.resposta-prefeitura .jodit-toolbar button:hover {
				background: rgba(255, 255, 255, 0.1) !important;
			}
		</style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			$item_selecionado = null;
			
			foreach( $esic_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					$item_selecionado = $item;
				
					echo'
					<div class="lightbox esic-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar esic: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Órgão: </span>
								</div>
								<div class="col90">
									<input 
										name="orgao" 
										value="'. $item['orgao'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Título: </span>
								</div>
								<div class="col90">
									<input 
										name="titulo" 
										value="'. $item['titulo'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Código: </span>
								</div>
								<div class="col90">
									<input 
										name="codigo" 
										value="'. $item['codigo'] .'" 
									/>
								</div>
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
									<span>Endereço: </span>
								</div>
								<div class="col90">
									<textarea name="endereco">'. $item['endereco'] .'</textarea>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Cidade: </span>
								</div>
								<div class="col90">
									<input 
										name="cidade" 
										value="'. $item['cidade'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Estado: </span>
								</div>
								<div class="col90">
									<input 
										name="estado" 
										value="'. $item['estado'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Email: </span>
								</div>
								<div class="col90">
									<input 
										name="email" 
										type="email" 
										value="'. $item['email'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Telefone: </span>
								</div>
								<div class="col90">
									<input 
										name="telefone" 
										value="'. $item['telefone'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Telefone 2: </span>
								</div>
								<div class="col90">
									<input 
										name="telefone2" 
										value="'. $item['telefone2'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>CPF: </span>
								</div>
								<div class="col90">
									<input 
										name="cpf" 
										value="'. $item['cpf'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>CEP: </span>
								</div>
								<div class="col90">
									<input 
										name="cep" 
										value="'. $item['cep'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Tipo: </span>
								</div>
								<div class="col90">
									<input 
										name="tipo" 
										value="'. $item['tipo'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Status: </span>
								</div>
								<div class="col90">
									<span>
										<select name="status">
											<option value="">Selecione o status</option>
											<option value="Aguardando Departamento Responsável" '. ($item['status'] == 'Aguardando Departamento Responsável' ? 'selected' : '') .'>Aguardando Departamento Responsável</option>
											<option value="Indeferido" '. ($item['status'] == 'Indeferido' ? 'selected' : '') .'>Indeferido</option>
											<option value="Prorrogado" '. ($item['status'] == 'Prorrogado' ? 'selected' : '') .'>Prorrogado</option>
											<option value="Protocolo Registrado" '. ($item['status'] == 'Protocolo Registrado' ? 'selected' : '') .'>Protocolo Registrado</option>
											<option value="Resolvido" '. ($item['status'] == 'Resolvido' ? 'selected' : '') .'>Resolvido</option>
										</select>
									</span>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Identificação: </span>
								</div>
								<div class="col90">
									<input 
										name="identificacao" 
										value="'. $item['identificacao'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data: </span>
								</div>
								<div class="col90">
									<input 
										name="data" 
										type="datetime-local" 
										value="'. ($item['data'] ? date('Y-m-d\TH:i', strtotime($item['data'])) : '') .'" 
									/>
								</div>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto">
								<span>Mensagem: </span>
								<textarea id="editor_mensagem" name="mensagem"></textarea>
							</div>
							
							<div class="separador"></div>
							
							<div class="linha linha-auto resposta-prefeitura">
								<span class="resposta-prefeitura-titulo">🏛️ Resposta da Prefeitura: </span>
								<textarea id="editor_resposta" name="resposta"></textarea>
							</div>
							
							'. (!empty($item['anexo']) ? '
							<div class="linha">
								<div class="col10">
									<span>Anexo: </span>
								</div>
								<div class="col90">
									<input 
										name="anexo" 
										value="'. $item['anexo'] .'" 
									/>
									<div style="margin-top: 8px;">
										<a href="' . $raiz_site . 'formularios_arquivos/' . basename($item['anexo']) . '" target="_blank" style="color: #0066cc; text-decoration: none; padding: 5px 10px; background: #f0f8ff; border: 1px solid #0066cc; border-radius: 4px; display: inline-block;">
											📎 Visualizar Anexo
										</a>
									</div>
								</div>
							</div>
							' : '') .'

							<div class="separador"></div>
							
							<div class="linha-acao"> 
								<button type="submit">Gravar</button> 
								<div class="btn" onclick="voltar()">Cancelar</div>
							</div>
							
							<div class="separador"></div>
							
						</form>

					</div>
					';
					
					break; // Sair do loop após encontrar o item
				}
				
			}
			
		?>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor_mensagem = new Jodit("#editor_mensagem", {
				language: "pt_br", // Configurar para português brasileiro
			});
			
			const editor_resposta = new Jodit("#editor_resposta", {
				language: "pt_br", // Configurar para português brasileiro
				placeholder: "Digite aqui a resposta oficial da Prefeitura...",
				toolbarAdaptive: false,
				buttons: [
					'bold', 'italic', 'underline', '|',
					'ul', 'ol', '|',
					'font', 'fontsize', '|',
					'paragraph', '|',
					'link', '|',
					'align', '|',
					'undo', 'redo', '|',
					'fullsize'
				],
			});
			/*End - JODIT*/
			
			/*Start - RECEBE OS DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			<?php if ($item_selecionado): ?>
			let editor_mensagem_json = <?php echo json_encode($item_selecionado['mensagem'] ?? '', JSON_PRETTY_PRINT) ?>;
			let editor_resposta_json = <?php echo json_encode($item_selecionado['resposta'] ?? '', JSON_PRETTY_PRINT) ?>;
			
			// Aguardar o Jodit ser totalmente carregado e então definir os valores
			setTimeout(function() {
				editor_mensagem.value = editor_mensagem_json;
				editor_resposta.value = editor_resposta_json;
			}, 100);
			<?php endif; ?>
			/*End - RECEBE OS DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=esic';
				
			}
			
		</script>
		
	</body>
	
</html>