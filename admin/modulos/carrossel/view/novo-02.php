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
		<title>Painel de Controle</title>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<?php 
			
			$pasta_nome = 'carrossel';
			$pasta = $raiz_site .'carrossel/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<div class="lightbox exemplo-nova on">

			<div class="lightbox-titulo">

				Novo item para o Carrossel
				<div 
					class="lightbox-fechar" 
					onClick="voltar()" 
					style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
				></div>
				
			</div>
			
			<div class="linha linha-auto">
				<div class="comentario">Tamanho recomendado de imagem: 1920x480px para computadores - 800x480px para celulares.</div>
			</div>
			
			<div class="linha linha-auto">

				<div class="col10"><span>Imagem: </span></div>

				<div class="col20">
					<div 
						class="escolher-imagem-btn item-escolher-imagem-btn" 
						onclick="abrir_item_imagens()" 
					></div>
				</div>
				
				<div class="col70">
					<span>
						<label 
							class="btn arquivo_escolhido" 
							for="arquivo" 
							title="Clique aqui para selecionar o arquivo desejado."
						>Escolher imagem do dispositivo</label>
						<input type="file" name="arquivo_subir" id="arquivo" />
						<button 
							class="enviar-arquivo-submit" 
							title="Clique aqui para ENVIAR a imagem."
							onclick="subirArquivo()"
						>Enviar</button>
					</span>
				</div>
				
			</div>
			
			<div class="linha">
				<div class="col10">
					<span>URL Imagem: </span>
				</div>
				<div class="col90">
					<input 
						name="imagem" 
						class="item-escolher-imagem-input" 
						value=""
					/>
				</div>
			</div>
			
			<div class="separador"></div>
			
			<div class="linha">
				<div class="col10">
					<span>Link: </span>
				</div>
				<div class="col90">
					<input 
						name="link"
						value="#"
					/>
				</div>
			</div>

			<div class="linha">
				<div class="col10">
					<span>Nova página? </span>
				</div>
				<div class="col90">
					<span>
						<select name="target">
							<option value="_self" selected >Mesma página</option>
							<option value="_blank">Nova página</option>
						</select>
					</span>
				</div>
			</div>

			<div class="linha">
				<div class="col10">
					<span>Banner para celular? </span>
				</div>
				<div class="col05">
					<span>
						<input 
							name="mobile"
							value="0"
							type="radio"
							checked
						/>
					</span>
				</div>
				<div class="col05">
					<span>NÃO</span>
				</div>
				<div class="col05">
					<span>
						<input 
							name="mobile"
							value="1"
							type="radio"
						/>
					</span>
				</div>
				<div class="col05">
					<span>SIM</span>
				</div>
			</div>

			<div class="separador"></div>
			
			<div class="linha-acao">
			
				<button onclick="gravar()">Gravar</button>
				<div class="btn" onclick="voltar()">Cancelar</div>
				
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});
			
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
			
			function gravar(){
				
				console.log( 'gravar()' );
				
				var formData = new FormData();
				formData.append( 'imagem', document.querySelector('[name="imagem"]').value );
				formData.append( 'link', document.querySelector('[name="link"]').value );
				formData.append( 'target', document.querySelector('[name="target"]').value );
				formData.append( 'mobile', document.querySelector('[name="mobile"]:checked').value );

				var xhr = new XMLHttpRequest();
				xhr.open( 'POST', '../controller/criar.php', true );

				xhr.onreadystatechange = function(){
					
					if( 
						xhr.status === 200 
						&& xhr.readyState == 4
					){
						
						alert( xhr.responseText );
						window.location.href = '<?= $raiz_admin ?>matriz?pagina=carrossel';
						
					}
					
				};

				xhr.send( formData );
				
			}
			
			function subirArquivo(){
				
				console.log( 'subirArquivo()' );
				//console.log( document.querySelector('[name="arquivo_subir"]').files[0] );
				
				var subirArquivo_pasta = '<?= $raiz_site ?>carrossel/';
				
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
						document.querySelector('[name="imagem"]').value = xhr.responseText;
						document.querySelector('.arquivo_escolhido').innerHTML = 'Escolher imagem do dispositivo';
						item_escolher_imagem_btn.style.backgroundImage = 'url('+ subirArquivo_pasta + xhr.responseText +')' ;
						document.querySelector('.escolher-imagem-cards-box').innerHTML += ''+
						'<div onclick="'+
						'		let item_imagens = document.querySelector(`.item-imagens`);'+
						'		item_imagens.classList.remove(`on`);'+
						'		document.querySelector(`.item-escolher-imagem-input`).value = `'+ xhr.responseText +'` ;'+
						'		document.querySelector(`.item-escolher-imagem-btn`).style.backgroundImage = `url('+ subirArquivo_pasta + xhr.responseText +')` ;'+
						'	" class="escolher-imagem-cards-card">'+
						''+
						'	<div class="escolher-imagem-cards-imagem" style="background-image:url( '+ subirArquivo_pasta + xhr.responseText +' )"></div>'+
						'	<div class="escolher-imagem-cards-titulo" title="'+ xhr.responseText +'"><span>'+ xhr.responseText +'</span></div>'+
						'	'+
						'</div>'+
						'';
						
					}
					
				};

				xhr.send( formData );
				
			}
			
		</script>
		
	</body>
	
</html>