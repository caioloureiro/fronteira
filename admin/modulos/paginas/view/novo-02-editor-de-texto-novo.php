<?php
//

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
		<title>criar paginas</title>
		
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto-novo/assets/estilo.css"/>
		
	</head>
	<body>
		
		<style>
			<?php 
				require $raiz_admin .'routes/css-modulo.php'; 
			?>
			.info_pagina{
				display:none;
			}
		</style>
	
		<?php 
		
			require $raiz_admin .'view/escurecer.php'; 
			
			$pasta_nome = 'img';
			$pasta = $raiz_site .'img/';
			require 'imagens.php';
			
		?>
		
		<div class="lightbox pagina-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova Página
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
			
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<input 
							name="titulo" 
							required 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Informações da página: </span>
					</div>
					<div class="col10">
						<span>
							<select 
								class="info" 
								name="info"
							>
								<option value="0">Não</option>
								<option value="1">Sim</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="info_pagina">
					
					<div class="separador"></div>
					
					<div class="linha linha-auto">

						<div class="col10"><span>Imagem: </span></div>
						
						<div class="col90">
							<div 
								class="escolher-imagem-btn item-escolher-imagem-btn" 
								onclick="abrir_item_imagens()" 
								style="background-image:url(  )"
							></div>
						</div>
						<div class="linha">
							<div class="col10">
								<span>URL Imagem: </span>
							</div>
							<div class="col90">
								<input 
									name="imagem" 
									class="item-escolher-imagem-input" 
								/>
							</div>
						</div>
						
					</div>
					
					<div class="separador"></div>
					
					<div class="linha">
						<div class="col10">
							<span>Representante: </span>
						</div>
						<div class="col90">
							<span>
								<input name="representante" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Telefone: </span>
						</div>
						<div class="col10">
							<span>
								<input name="telefone" />
							</span>
						</div>
						<div class="col10">
							<span>E-mail: </span>
						</div>
						<div class="col30">
							<span>
								<input name="email" />
							</span>
						</div>
						<div class="col10">
							<span>Atendimento: </span>
						</div>
						<div class="col30">
							<span>
								<input name="horario" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Endereço: </span>
						</div>
						<div class="col90">
							<span>
								<input name="endereco" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Site: </span>
						</div>
						<div class="col90">
							<span>
								<input name="site" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Facebook: </span>
						</div>
						<div class="col90">
							<span>
								<input name="facebook" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Instagram: </span>
						</div>
						<div class="col90">
							<span>
								<input name="instagram" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Twitter: </span>
						</div>
						<div class="col90">
							<span>
								<input name="twitter" />
							</span>
						</div>
					</div>
					
					<div class="linha">
						<div class="col10">
							<span>Google Maps: </span>
						</div>
						<div class="col90">
							<span>
								<input name="localizacao" />
							</span>
						</div>
					</div>
					
				</div>
				
				<div class="separador"></div>

				<div class="linha linha-auto">
					<div class="col10">
						<span>Texto: </span>
					</div>
					<div class="col90">
						<div class="editor-container editor_de_texto"></div>
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
		
		<script src="https://digitalmd.com.br/editor-de-texto-novo/assets/motor.js"></script>
		
		<script>
			
			let info = document.querySelector('.info');
			let info_pagina = document.querySelector('.info_pagina');
			
			info.addEventListener('change', function() {
				
				if( info.value == '0' ){
					info_pagina.classList.remove("on");
				}
				if( info.value == '1' ){
					info_pagina.classList.add("on");
				}
				
			});
			
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