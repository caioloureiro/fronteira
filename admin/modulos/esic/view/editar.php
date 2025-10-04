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
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $esic_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
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
							
							<div class="linha linha-auto">
								<span>Resposta: </span>
								<textarea id="editor_resposta" name="resposta"></textarea>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Anexo: </span>
								</div>
								<div class="col90">
									<input 
										name="anexo" 
										value="'. $item['anexo'] .'" 
									/>
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor_mensagem = new Jodit("#editor_mensagem", {
				language: "pt_br", // Configurar para português brasileiro
			});
			
			const editor_resposta = new Jodit("#editor_resposta", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			/*Start - RECEBE OS DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_mensagem_json = <?php echo json_encode($item['mensagem'] ?? '', JSON_PRETTY_PRINT) ?>;
			let editor_resposta_json = <?php echo json_encode($item['resposta'] ?? '', JSON_PRETTY_PRINT) ?>;
			
			document.querySelector('#editor_mensagem').value = editor_mensagem_json;
			document.querySelector('#editor_resposta').value = editor_resposta_json;
			/*End - RECEBE OS DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=esic';
				
			}
			
		</script>
		
	</body>
	
</html>