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

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar convênio</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox convenio-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo convênio
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
					<div class="col20">
						<span>
							<select 
								name="categoria" 
								required
							>
								<option value="convenio">Convênio</option>
							</select>
						</span>
					</div>
				</div>

				<div class="linha">
					<div class="col10">
						<span>Data: </span>
					</div>
					<div class="col20">
						<input 
							type="date" 
							name="data" 
							value="<?php echo date('Y-m-d'); ?>"
							required
						/>
					</div>
					<div class="col10">
						<span>Data de início: </span>
					</div>
					<div class="col20">
						<input 
							type="date" 
							name="data_inicio" 
							value="<?php echo date('Y-m-d'); ?>"
							required
						/>
					</div>
				</div>

				<div class="linha">
					<div class="col10">
						<span>Data de término: </span>
					</div>
					<div class="col20">
						<input 
							type="date" 
							name="data_fim" 
						/>
					</div>
				</div>

				<div class="linha">
					<div class="col10">
						<span>Valor: </span>
					</div>
					<div class="col20">
						<input 
							type="text" 
							name="valor" 
							placeholder="R$ 0,00"
						/>
					</div>
					<div class="col10">
						<span>Contratado: </span>
					</div>
					<div class="col20">
						<input 
							type="text" 
							name="contratado" 
						/>
					</div>
				</div>

				<div class="linha">
					<div class="col10">
						<span>Documento: </span>
					</div>
					<div class="col20">
						<input 
							type="text" 
							name="contratado_documento" 
							placeholder="CNPJ/CPF"
						/>
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

				<div class="linha linha-auto">
					<div class="col10">
						<span>Ementa: </span>
					</div>
					<div class="col90">
						<textarea 
							name="ementa"
						></textarea>
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=convenios';
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
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
			
			// Máscara para valor monetário
			document.querySelector('[name="valor"]').addEventListener('input', function(e) {
				let value = e.target.value.replace(/\D/g, '');
				value = (value / 100).toFixed(2) + '';
				value = value.replace(".", ",");
				value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
				e.target.value = 'R$ ' + value;
			});
			
		</script>
		
	</body>
	
</html>