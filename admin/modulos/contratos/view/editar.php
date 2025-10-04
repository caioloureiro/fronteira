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
require $raiz_site .'model/contratos.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar contrato</title>
		
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
			
			foreach( $contratos_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['texto'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox contrato-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar contrato: '. $item['nome'] .'
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
									<span>Número: </span>
								</div>
								<div class="col90">
									<input 
										name="numero" 
										value="'. $item['numero'] .'"
										placeholder="Ex: 4830/2018"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Categoria: </span>
								</div>
								<div class="col90">
									<input 
										name="categoria" 
										value="'. $item['categoria'] .'"
										placeholder="Ex: Contrato"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data: </span>
								</div>
								<div class="col90">
									<input 
										type="date"
										name="data" 
										value="'. (!empty($item['data']) ? date('Y-m-d', strtotime($item['data'])) : '') .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data Início: </span>
								</div>
								<div class="col90">
									<input 
										type="date"
										name="data_inicio" 
										value="'. (!empty($item['data_inicio']) ? date('Y-m-d', strtotime($item['data_inicio'])) : '') .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Data Fim: </span>
								</div>
								<div class="col90">
									<input 
										type="date"
										name="data_fim" 
										value="'. (!empty($item['data_fim']) ? date('Y-m-d', strtotime($item['data_fim'])) : '') .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Valor: </span>
								</div>
								<div class="col90">
									<input 
										name="valor" 
										value="'. $item['valor'] .'"
										placeholder="Ex: 1500,00"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Contratado: </span>
								</div>
								<div class="col90">
									<input 
										name="contratado" 
										value="'. $item['contratado'] .'"
										placeholder="Ex: Viação Ouro e Prata S/A"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Documento Contratado: </span>
								</div>
								<div class="col90">
									<input 
										name="contratado_documento" 
										value="'. $item['contratado_documento'] .'"
										placeholder="Ex: CNPJ ou CPF"
									/>
								</div>
							</div>
							
							<div class="separador"></div>

							<div class="linha linha-auto">
								<div class="col100">
									<span>Ementa: </span>
								</div>
							</div>
							
							<div class="linha linha-auto">
								<textarea name="ementa" placeholder="Breve descrição do contrato">'. $item['ementa'] .'</textarea>
							</div>

							<div class="separador"></div>
							
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
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			//console.log( editor_de_texto_json );
			
			document.querySelector('#editor').value = editor_de_texto_json;
			/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=contratos';
				
			}
			
		</script>
		
	</body>
	
</html>