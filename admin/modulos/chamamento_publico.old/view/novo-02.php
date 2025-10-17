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
require $raiz_site .'model/downloads.php';

//dd( $_GET );

$arquivos = '';

if( 
	isset( $_GET['arquivos'] )
	&& $_GET['arquivos'] > 0 
){
	
	for( $i = 0; $i < $_GET['arquivos']; $i++ ){
		
		foreach( $downloads_array as $file ){

			if( $file['arquivo'] == $_GET[ 'arquivo'. $i ] ){
				
				$arquivos .= $file['id'] .';';
				
			}
			
		}
		
	}
	
}

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

		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php
			
			$pasta_nome = 'arquivos';
			$pasta = $raiz_site .'arquivos/';

			require $raiz_admin .'view/escurecer.php'; 
			require 'arquivos.php';
			
		?>
		
		<div class="lightbox chamamento_publico-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Criar Chamamento Público
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<span>
							<input 
								name="titulo" 
								required
							/>
						</span>
					</div>
				</div>
			
				<div class="linha">
					<div class="col10">
						<span>Situação: </span>
					</div>
					<div class="col90">
						<span>
							<select name="situacao">
								<option value="aberto" selected >Aberto</option>
								<option value="andamento">Em Andamento</option>
								<option value="finalizado">Finalizado</option>
								<option value="cancelado">Cancelado</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Número: </span>
					</div>
					<div class="col90">
						<span>
							<input name="numero" />
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Processo: </span>
					</div>
					<div class="col90">
						<span>
							<input name="processo" />
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Encerramento: </span>
					</div>
					<div class="col90">
						<span>
							<input 
								type="datetime-local"
								name="encerramento" 
							/>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Local: </span>
					</div>
					<div class="col90">
						<span>
							<input name="local" />
						</span>
					</div>
				</div>
				
				<div class="linha off">
					<div class="col10">
						<span>Arquivos IDs: </span>
					</div>
					<div class="col90">
						<span>
							<input 
								class="item-escolher-arquivo-input input_arquivos"
								name="arquivos" 
								value="<?php echo $arquivos ?>"
							/>
						</span>
					</div>
				</div>
				
				<div class="separador"></div>
				
				<div class="linha linha-auto">
					
					<div class="col10">Arquivos:</div>
					<div class="col90 anexos">
						
						<?php
						
							if( 
								isset( $_GET['arquivos'] )
								&& $_GET['arquivos'] > 0 
							){
								
								for( $i = 0; $i < $_GET['arquivos']; $i++ ){
									
									foreach( $downloads_array as $file ){

										if( $file['arquivo'] == $_GET[ 'arquivo'. $i ] ){
											
											echo'
											<div 
												class="
													anexo
													anexo_'. $file['id'] .'
												"
											>
												<div class="anexo-nome">'. $file['arquivo'] .'</div>
												<div 
													class="anexo-excluir"
													onclick="excluirArquivo( '. $file['id'] .' )"
													title="Desvincular este arquivo."
												>'; require $raiz_admin .'img/fechar.svg'; echo'</div>
											</div>
											';
											
										}
										
									}
									
								}
								
							}
						
						?>
						
					</div>
					
				</div>
				
				<div class="linha">
					<div class="col10"></div>
					<div class="col90">
						<div 
							onclick="abrirArquivos()"
							style="cursor:pointer;"
							class="btn"
						>
							<div class="anexo-nome">Adicionar outro arquivo.</div>
						</div>
					</div>
				</div>
				
				<div class="separador"></div>
				
				<div class="linha linha-auto">
					<div class="col10">
						<span>Descrição: </span>
					</div>
					<div class="col90 editor-container">
						<textarea class="tinyMCE" name="editor_texto">CONTEÚDO</textarea>
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
		
		<?php 
			/*Login no TinyMCE com a conta do Google*/
			$chave_TinyMCE = '19qrwrck1ohw2pd7g0s9c5d6ijtxo6rws7l14ruuinbd62ix'; 
		?>
		
		<script
			type="text/javascript"
			src='https://cdn.tiny.cloud/1/<?php echo $chave_TinyMCE ?>/tinymce/6/tinymce.min.js'
			referrerpolicy="origin"
		></script>
		
		<script>
			
			tinymce.init({
				selector: '.tinyMCE',
				plugins: 'fullscreen image link media emoticons code',
				toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
				language: 'pt_BR',
			});
			
			function excluirArquivo( id ){
				
				//console.log( 'id', id ); 
				
				let input_arquivos = document.querySelector('.input_arquivos').value;
				//console.log( 'input_arquivos', input_arquivos ); 
				
				let input_arquivos_array = input_arquivos.split( id +";");
				//console.log( 'input_arquivos_array', input_arquivos_array ); 
				
				let resultado = input_arquivos_array[0] + input_arquivos_array[1];
				//console.log( 'resultado', resultado ); 
				
				document.querySelector( '.input_arquivos' ).value = resultado;
				document.querySelector( '.anexo_'+ id ).remove();
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			function voltar(){
				
				window.location = '<?php echo $raiz_admin ?>matriz?pagina=chamamento_publico';
				
			}
			
		
		/*Start - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		const form = document.querySelector('form');
		const submitButton = document.querySelector('button[type="submit"]');
		
		if (form && submitButton) {
			let formularioEnviado = false;
			
			form.addEventListener('submit', function(e) {
				if (formularioEnviado) {
					e.preventDefault();
					alert('O formulário já está sendo processado. Por favor, aguarde.');
					return false;
				}
				
				formularioEnviado = true;
				submitButton.disabled = true;
				submitButton.textContent = 'Gravando...';
				submitButton.style.opacity = '0.6';
				submitButton.style.cursor = 'not-allowed';
			});
		}
		/*End - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		</script>
		
	</body>
	
</html>