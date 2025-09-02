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
require $raiz_site .'model/menu_admin_categorias.php'; 

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
	
		<div class="lightbox modulos_admin-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo módulo
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
						<span>Pasta do módulo: </span>
					</div>
					<div class="col90">
						<input 
							name="pagina" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Ícone: </span>
					</div>
					<div class="col90">
						<span>
							<select name="imagem">
								<option>documento.svg</option>
								<option>upload.svg</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Tipo: </span>
					</div>
					<div class="col90">
						<span>
							<select name="tipo">
								<option>normal</option>
								<option>master</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Categoria: </span>
					</div>
					<div class="col90">
						<span>
							<select name="categoria_id">
								<?php
									
									$menu_admin_categorias_array = array_reverse( $menu_admin_categorias_array );
									
									foreach( $menu_admin_categorias_array as $item ){
										
										if( $item['id'] != 1 ){
											
											echo '<option value="'. $item['id'] .'">'. $item['nome'] .'</option>';
											
										}
										
									}
									
								?>
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=modulos_admin';
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>