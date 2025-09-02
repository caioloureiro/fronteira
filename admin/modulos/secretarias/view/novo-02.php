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
		<title>Criar secretarias</title>
		
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
		</style>
	
		<?php 
			
			$pasta_nome = 'secretarias';
			$pasta = $raiz_site .'secretarias/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'imagens.php';
			
		?>
		
		<div class="lightbox secretarias-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova página de Secretaria
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );"
					></div>
					
				</div>
				
				<div class="linha linha-auto">

					<div class="col10">
						<span>Foto*: </span>
					</div>
					
					<?php
						$imagem_check = explode( '/', $_GET['arquivo'] );

						if(
							$imagem_check[0] == 'http:' ||
							$imagem_check[0] == 'https:'
						){

							$imagem = $_GET['arquivo'];
							
						}else{

							$imagem = $pasta. $_GET['arquivo'];
							
						}					
						
					?>

					<div class="col90">
						<div 
							class="escolher-imagem-btn item-escolher-imagem-btn" 
							onclick="abrir_item_imagens()" 
							style="background-image:url( <?php echo $imagem ?>)"
						></div>
					</div>
					<div class="linha">
						<div class="col10">
							<span>URL Imagem: </span>
						</div>
						<div class="col90">
							<input 
								name="foto" 
								class="item-escolher-imagem-input" 
								value="<?php echo $_GET['arquivo'] ?>"
							/>
						</div>
					</div>
					
				</div>
				
				<div class="separador"></div>
				
				<div class="linha">
					<div class="col10">
						<span>Página*: </span>
					</div>
					<div class="col90">
						<input name="pagina" />
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Título*: </span>
					</div>
					<div class="col90">
						<input name="titulo" />
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Representante: </span>
					</div>
					<div class="col90">
						<input name="secretario" />
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Endereço: </span>
					</div>
					<div class="col90">
						<input name="endereco" />
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Atendimento: </span>
					</div>
					<div class="col90">
						<input name="horario" />
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Google Maps: </span>
					</div>
					<div class="col90">
						<input name="localizacao" />
					</div>
				</div>
				
				<div class="linha">
					
					<div class="col10">
						<span>E-mail: </span>
					</div>
					<div class="col15">
						<input name="email" />
					</div>
				
					<div class="col05">
						<span>Telefone: </span>
					</div>
					<div class="col10">
						<input name="telefone" />
					</div>
					
				</div>
				
				<div class="linha">
				
					<div class="col10">
						<span>Site: </span>
					</div>
					<div class="col40">
						<input name="site" />
					</div>
				
					<div class="col10">
						<span>Facebook: </span>
					</div>
					<div class="col40">
						<input name="facebook" />
					</div>
					
				</div>
				
				<div class="linha">
				
					<div class="col10">
						<span>Instagram: </span>
					</div>
					<div class="col40">
						<input name="instagram" />
					</div>
				
					<div class="col10">
						<span>X (Twitter): </span>
					</div>
					<div class="col40">
						<input name="twitter" />
					</div>
					
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
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});

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
			
		</script>
		
	</body>
	
</html>