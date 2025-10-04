<?php
//

$raiz_site = '../../../../';
$raiz_admin = '../../../';

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

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
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />

		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<?php
			
			$pasta_nome = 'usuarios';
			$pasta = $raiz_admin .'usuarios/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<div class="lightbox processo-novo on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Usuário
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
					
				</div>

				<div class="linha linha-auto">

					<div class="col10"><span>Imagem: </span></div>

					<div class="col20">
						<div 
							class="escolher-imagem-btn item-escolher-imagem-btn" 
						></div>
					</div>
					
					<div class="col25">
						<span><div class="btn" onclick="abrir_item_imagens()">Clique aqui para escolher a imagem do servidor.</div></span>
					</div>
					
					<div class="col30">
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
								style="float:left"
							>Enviar</div>
						</span>
					</div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>URL Imagem: </span>
					</div>
					<div class="col90">
						<input 
							name="foto" 
							class="item-escolher-imagem-input" 
							value=""
						/>
					</div>
				</div>
				
				<div class="separador"></div>
			
				<div class="linha"><div class="col10"><span>Nome: </span></div><div class="col90"><input name="nome" /></div></div>
				<div class="linha">
					<div class="col10"><span>Usuário:</span></div><div class="col20"><input name="usuario" /></div>
					<div class="col10"><span>Senha: </span></div><div class="col20"><input name="senha" /></div>
					<div class="col10"><span>E-mail: </span></div><div class="col30"><input type="email" name="email" /></div>
				</div>
				<div class="linha">
					<div class="col10"><span>Função: </span></div><div class="col20"><input name="funcao" /></div>
					<div class="col10"><span>Tipo:</span></div>
					<div class="col20">
						<span>
							<select name="tipo">
								<option value="normal">Normal</option>
								<option value="master">Master</option>
							</select>
						</span>
					</div>
				</div>

				<div class="separador"></div>
				
				<div class="linha-acao">
				
					<button type="submit">Gravar</button>
					<button onclick="voltar()">Cancelar</button>
					
				</div>
				
				<div class="separador"></div>
				
			</form>

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
			
			function subirArquivo(){
				
				console.log( 'subirArquivo()' );
				//console.log( document.querySelector('[name="arquivo_subir"]').files[0] );
				
				var subirArquivo_pasta = '<?= $pasta ?>';
				
				var formData = new FormData();
				formData.append( 'arquivo_subir', document.querySelector('[name="arquivo_subir"]').value );
				formData.append( 'arquivo', document.querySelector('[name="arquivo_subir"]').files[0] );
				formData.append( 'pasta', "<?= $pasta ?>" );

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
			
			function voltar(){
				
				window.history.back();
				
			}
			
			/*Start - Tail Select*/
			tail.select( ".select_padrao",{
				width: "100%",
				search: true,
			} );
			tail.select( ".select_autor",{
				width: "100%",
				search: true,
			} );
			/*End - Tail Select*/
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>