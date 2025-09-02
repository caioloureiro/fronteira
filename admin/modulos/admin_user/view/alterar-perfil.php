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
require $raiz_site .'model/admin_user.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
				
				require $raiz_admin .'view/escurecer.php';
				require 'imagens.php';
				
				foreach( $admin_user_array as $usuario ){
					
					if( $usuario['id'] == $_GET['id'] ){
					
						echo'
						<div class="lightbox usuario-criar on">

							<form action="../controller/editar.php" method="POST">
							
								<input name="id" value="'. $usuario['id'] .'" style="display:none" />
							
								<div class="lightbox-titulo">

									Editar Usuário: '. $usuario['nome'] .'
									<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '.$raiz_admin .'img/fechar.svg );"></div>
									
								</div>
								
								<div class="linha linha-auto">

									<div class="col10"><span>Imagem: </span></div>

									<div class="col90"><div class="escolher-imagem-btn item-escolher-imagem-btn" onclick="abrir_item_imagens()" style="background-image:url( '. $raiz_admin .'usuarios/'. $usuario['foto'] .')"></div></div>
									<div class="linha"><div class="col10">Foto: </div><div class="col90"><input name="foto" class="item-escolher-imagem-input" value="'. $usuario['foto'] .'"/></div></div>
									
								</div>
							
								<div class="linha">

									<div class="col05"><span>Nome: </span></div>

									<div class="col45"><input name="nome" required value="'. $usuario['nome'] .'" /></div>

									<div class="col05"><span>Senha: </span></div>

									<div class="col45"><input name="senha" placeholder="Criar uma nova senha (opcional)." /></div>
									
								</div>

								<div class="linha">

									<div class="col05"><span>E-mail: </span></div>

									<div class="col45"><input name="email" type="email" required value="'. $usuario['email'] .'" /></div>

									<div class="col05"><span>Função: </span></div>

									<div class="col45"><input name="funcao" required value="'. $usuario['funcao'] .'" /></div>
									
								</div>

								<div class="linha">

									<div class="col05"><span>Login: </span></div>

									<div class="col45"><input name="usuario" required value="'. $usuario['usuario'] .'" /></div>

									<div class="col05"><span>Tipo: </span></div>

									<div class="col45">
									
										<span>
											<select name="tipo">
												<option value="">Escolha o tipo</option>
												<option '; if( $usuario['tipo'] == 'normal' ){ echo'selected="selected"'; } echo'>normal</option>
												<option '; if( $usuario['tipo'] == 'master' ){ echo'selected="selected"'; } echo'>master</option>
											</select>
										</span>
									
									</div>
									
								</div>

								<div class="linha-acao"> <button type="submit">Gravar</button> </div>
								
								<div class="separador"></div>
								
							</form>

						</div>
						';
					
					}
				
				}
				
			?>
			
		</div>
		
		<script>
			let item_escolher_imagem_input = document.querySelector('.item-escolher-imagem-input');
			let item_escolher_imagem_btn = document.querySelector('.item-escolher-imagem-btn');

			item_escolher_imagem_input.addEventListener('keyup', function() {

				item_escolher_imagem_btn.style.backgroundImage = 'url('+ item_escolher_imagem_input.value +')' ;
				
			});
			
			function sair_item_nova(){
				
				document.querySelector('.escurecer').classList.remove('on');
				document.querySelector('.item-nova').classList.remove('on');
				
			}

			function abrir_item_imagens(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.item-imagens').classList.add('on');
				
			}
			
			function abrir_imagens_txt(){
				
				document.querySelector('.escurecer').classList.add('on');
				document.querySelector('.imagens_txt').classList.add('on');
				
			}

			function voltar(){
				
				window.location.href = "<?php echo $raiz_admin ?>matriz";
				
			}
			
		</script>
		
	</body>
	
</html>