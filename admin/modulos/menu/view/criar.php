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
require $raiz_site .'model/menu.php';

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
		
		<style>
			<?php require $raiz_admin .'routes/css-modulo.php'; ?>
			
			.pai_label{
				display:none;
			}
			.pai_input{
				display:none;
			}
			.submenu_label{
				display:none;
			}
			.submenu_input{
				display:none;
			}
			
			.item_on{
				display:table;
			}
			
		</style>
	
		<div class="lightbox exemplo-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Menu
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
						<span>
							<input name="nome" />
						</span>
					</div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Link: </span>
					</div>
					<div class="col90">
						<span>
							<input name="link" />
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Nova Página: </span>
					</div>
					<div class="col05">
						<span>
							<select name="target">
								<option value="_self" selected >Não</option>
								<option value="_blank">Sim</option>
							</select>
						</span>
					</div>
					<div class="col05">
						<span>Nível: </span>
					</div>
					<div class="col10">
						<span>
							<select name="nivel" class="nivel">
								<option value="1" selected>Submenu</option>
								<option value="0" >Menu</option>
							</select>
						</span>
					</div>
					<div class="pai_label item_on col05">
						<span>Pai:</span>
					</div>
					<div class="pai_input item_on col45">
						<span>
							<select 
								name="pai"
								class="pai"
								title="O menu pai deve ter Nível de Menu e Possuir Submenu."
							>
								<option value="0" selected >Escolher pai</option>
								
								<?php
									
									foreach( $menu_array as $menu ){
										
										if(
											$menu['nivel'] == 0
											&& $menu['submenu'] == 1
										){
											echo'<option value="'. $menu['id'] .'">'. $menu['nome'] .'</option>';
										}
										
									}
									
								?>
								
							</select>
						</span>
					</div>
					<div class="submenu_label col10">
						<span>Possui Submenu? </span>
					</div>
					<div class="submenu_input col05">
						<span>
							<select name="submenu" class="submenu">
								<option value="0" selected >Não</option>
								<option value="1">Sim</option>
							</select>
						</span>
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
		
		<script>
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=menu';
				
			}
			
			let nivel = document.querySelector('.nivel');
			let pai_label = document.querySelector('.pai_label');
			let pai_input = document.querySelector('.pai_input');
			let submenu_label = document.querySelector('.submenu_label');
			let submenu_input = document.querySelector('.submenu_input');
			let submenu = document.querySelector('.submenu');
			let pai = document.querySelector('.pai');
			
			nivel.addEventListener("change", function() {
				
				console.log( 'nivel.value', nivel.value ); 
				
				if( nivel.value == 0 ){
					
					pai_label.classList.remove("item_on");
					pai_input.classList.remove("item_on");
					submenu_label.classList.add("item_on");
					submenu_input.classList.add("item_on");
					pai.value = 0;
					
				}
				
				if( nivel.value == 1 ){
					
					pai_label.classList.add("item_on");
					pai_input.classList.add("item_on");
					submenu_label.classList.remove("item_on");
					submenu_input.classList.remove("item_on");
					submenu.value = 0;
					
				}
				
			});
			
		</script>
		
	</body>
	
</html>