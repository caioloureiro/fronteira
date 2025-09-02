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
require $raiz_site .'model/menu_interno.php';
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
		<link rel="stylesheet" href="https://digitalmd.com.br/editor-de-texto/assets/estilo.css"/>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
	</head>
	<body>
		
		<style>
			<?php require $raiz_admin .'routes/css-modulo.php'; ?>
			.subpagina_alvo{
				display:none;
			}
		</style>
		
		<?php 
			
			foreach( $menu_interno_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox menu_interno-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar Menu Interno: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Nome: </span>
								</div>
								<div class="col90">
									<input 
										name="nome" 
										value="'. $item['nome'] .'"
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Link: </span>
								</div>
								<div class="col90">
									<input 
										name="link" 
										value="'. $item['link'] .'"
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
											<option 
												value="_self"
												'; if( $item['target'] == '_self' ){ echo'selected'; } echo'
											>Mesma página</option>
											<option 
												value="_blank"
												'; if( $item['target'] == '_blank' ){ echo'selected'; } echo'
											>Nova página</option>
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
											<optgroup>
												<option disabled>Páginas:</option>
												';
													
													usort($paginas, function( $a, $b ){//Função responsável por ordenar

														$al = mb_strtolower($a['pagina']);
														$bl = mb_strtolower($b['pagina']);
														
														if ($al == $bl){
															return 0;
														}
														
														return ($bl < $al) ? +1 : -1;
														
													});
												
													foreach( $paginas as $pagina ){

														echo '
														<option
															'; if( $item['pagina_alvo'] == $pagina['pagina'] ){ echo'selected'; } echo'
														>'. $pagina['pagina'] .'</option>
														';
														
													}
													
												echo'
											</optgroup>
											
											<optgroup>
												<option disabled>Páginas do Sistema:</option>
												';
													
													usort($paginas_fixas, function( $a, $b ){//Função responsável por ordenar

														$al = mb_strtolower($a['pagina']);
														$bl = mb_strtolower($b['pagina']);
														
														if ($al == $bl){
															return 0;
														}
														
														return ($bl < $al) ? +1 : -1;
														
													});
												
													foreach( $paginas_fixas as $pagina_fixa ){

														echo '
														<option
															'; if( $item['pagina_alvo'] == $pagina_fixa['pagina'] ){ echo'selected'; } echo'
														>'. $pagina_fixa['pagina'] .'</option>
														';
														
													}
													
												echo'
											</optgroup>
											
										</select>
									</span>
								</div>
								
								<span 
									class="
										subpagina_alvo
										'; if( $item['pagina_alvo'] == 'secretarias' ){ echo'on'; } echo'
									"
								>
								
									<div class="col10">
										<span>Subpágina Alvo:</span>
									</div>
									<div class="col30">
										<span>
											<select name="subpagina_alvo">
												<option value="">Escolher</option>
												
												';
													
													usort($secretarias_array, function( $a, $b ){//Função responsável por ordenar

														$al = mb_strtolower($a['pagina']);
														$bl = mb_strtolower($b['pagina']);
														
														if ($al == $bl){
															return 0;
														}
														
														return ($bl < $al) ? +1 : -1;
														
													});
												
													foreach( $secretarias_array as $sec ){

														echo '
														<option
															'; if( $item['subpagina_alvo'] == $sec['pagina'] ){ echo'selected'; } echo'
														>'. $sec['pagina'] .'</option>
														';
														
													}
													
												echo'
												
											</select>
										</span>
									</div>
									
								</span>
								
							</div>

							<div class="linha-acao"> 
								<button type="submit">Gravar</button> 
								<div class="btn" onclick="voltar()">Cancelar</div>
							</div>
							
							<div class="separador"></div>
							
						</form>

					</div>
					';
					
				}
				
			}
			
		?>
		
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
		
	</body>
	
</html>