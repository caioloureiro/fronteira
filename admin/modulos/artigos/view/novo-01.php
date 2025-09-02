<?php
//

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require '../../../model/conexao-off.php';

}else{
	
	require '../../../model/conexao-on.php';
	
}

require '../../../controller/funcoes.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		
	</head>
	<body>
		
		<style><?php require '../../../routes/css-modulo.php'; ?></style>
		
		<div class="lightbox novo-01 on">

			<div class="lightbox-titulo">

				Deseja enviar a imagem para o servidor?
				<div class="lightbox-fechar" onClick="voltar()"></div>
				
			</div>
			
			<div class="linha-acao">
				
				<form action="../controller/enviar-arquivo.php" method="POST" enctype="multipart/form-data">

					<label class="btn arquivo_escolhido" for="arquivo" title="Clique aqui para selecionar o arquivo desejado.">Escolher imagem do computador</label>

					<input type="file" name="arquivo_subir" id="arquivo" />

					<button type="submit" class="enviar-arquivo-submit" title="Clique aqui para ENVIAR.">Enviar imagem</button>
					
				</form>
				
			</div>
			
			<div class="linha-acao">
			
				<a href="novo-02?arquivo=ignorado"><button>Ignorar esta etapa</button></a>
				<div class="submenu-novo-btn" onclick="voltar()">Cancelar</div>
				
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			function voltar(){
				
				window.history.back();
				
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
			
		</script>
		
	</body>
	
</html>