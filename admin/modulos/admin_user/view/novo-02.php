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
		
			require $raiz_admin .'view/escurecer.php';
			require 'imagens.php';
			$pasta = $raiz_admin .'usuarios/';
			
		?>
		
		<div class="lightbox processo-novo on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Usuário
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
					
				</div>

				<div class="linha linha-auto">

					<div class="col10"><span>Imagem: </span></div>

					<div class="col90"><div class="escolher-imagem-btn item-escolher-imagem-btn" onclick="abrir_usuarios_imagens()" style="background-image:url( <?php echo $pasta.$_GET['arquivo'] ?>)"></div></div>
					<div class="linha"><div class="col10"><span>URL Foto: </span></div><div class="col90"><input name="foto" class="item-escolher-imagem-input" value="<?php echo $_GET['arquivo'] ?>"/></div></div>
					
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
			
			let usuarios_escolher_imagem_input = document.querySelector('.usuarios-escolher-imagem-input');
			let usuarios_escolher_imagem_btn = document.querySelector('.usuarios-escolher-imagem-btn');

			usuarios_escolher_imagem_input.addEventListener('keyup', function() {

				usuarios_escolher_imagem_btn.style.backgroundImage = 'url('+ usuarios_escolher_imagem_input.value +')' ;
				
			});

			function sair_usuarios_nova(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.usuarios-nova').classList.remove('on');
				
			}

			function abrir_usuarios_imagens(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-imagens').classList.add('on');
				
			}
			
			function abrir_imagens_txt(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.imagens_txt').classList.add('on');
				
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