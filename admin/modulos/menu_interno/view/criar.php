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
require $raiz_site .'model/paginas.php';
require $raiz_site .'model/paginas_fixas.php';
require $raiz_site .'model/secretarias.php';

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
			.subpagina_alvo{
				display:none;
			}
		</style>
	
		<div class="lightbox menu_interno-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo Menu Interno
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
						<input name="nome" />
					</div>
				</div>
				
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
					<div class="col10">
						<span>
							<select name="target">
								<option value="_self">Mesma página</option>
								<option value="_blank">Nova página</option>
							</select>
						</span>
					</div>
					
					<div class="col10">
						<span>Página Alvo:</span>
					</div>
					<div class="col30">
						<span>
							<select 
								name="pagina_alvo" 
								class="pagina_alvo" 
							>
								<option value="">Escolher</option>
								
								<optgroup>
									<option disabled>Páginas:</option>
									<?php
										
										usort($paginas, function( $a, $b ){//Função responsável por ordenar

											$al = mb_strtolower($a['pagina']);
											$bl = mb_strtolower($b['pagina']);
											
											if ($al == $bl){
												return 0;
											}
											
											return ($bl < $al) ? +1 : -1;
											
										});
									
										foreach( $paginas as $pagina ){

											echo '<option>'. $pagina['pagina'] .'</option>';
											
										}
										
									?>
								</optgroup>
								
								<optgroup>
									<option disabled>Páginas do Sistema:</option>
									<?php
										
										usort($paginas_fixas, function( $a, $b ){//Função responsável por ordenar

											$al = mb_strtolower($a['pagina']);
											$bl = mb_strtolower($b['pagina']);
											
											if ($al == $bl){
												return 0;
											}
											
											return ($bl < $al) ? +1 : -1;
											
										});
									
										foreach( $paginas_fixas as $pagina_fixa ){

											echo '<option>'. $pagina_fixa['pagina'] .'</option>';
											
										}
										
									?>
								</optgroup>
								
							</select>
						</span>
					</div>
					
					<span class="subpagina_alvo">
					
						<div class="col10">
							<span>Subpágina Alvo:</span>
						</div>
						<div class="col30">
							<span>
								<select name="subpagina_alvo">
									<option value="">Escolher</option>
									
									<?php
										
										usort($secretarias_array, function( $a, $b ){//Função responsável por ordenar

											$al = mb_strtolower($a['pagina']);
											$bl = mb_strtolower($b['pagina']);
											
											if ($al == $bl){
												return 0;
											}
											
											return ($bl < $al) ? +1 : -1;
											
										});
									
										foreach( $secretarias_array as $sec ){

											echo '<option>'. $sec['pagina'] .'</option>';
											
										}
										
									?>
									
								</select>
							</span>
						</div>
						
					</span>
					
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
			
			let pagina_alvo = document.querySelector('.pagina_alvo');
			let subpagina_alvo = document.querySelector('.subpagina_alvo');
			
			pagina_alvo.addEventListener("change", function() {
				
				if( pagina_alvo.value == 'secretarias' ){ 
					subpagina_alvo.classList.add("on"); 
				}
				if( pagina_alvo.value != 'secretarias' ){ 
					subpagina_alvo.classList.remove("on"); 
					subpagina_alvo.value = "";
				}
				
			});
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=menu_interno';
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>