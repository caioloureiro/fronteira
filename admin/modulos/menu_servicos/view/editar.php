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
require $raiz_site .'model/menu_servicos.php';

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
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			foreach( $menu_servicos_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox menu_servicos-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar Menu de Serviço: '. $item['nome'] .'
								<div 
									class="lightbox-fechar" 
									onClick="voltar()" 
									style="background-image:url( '. $raiz_admin .'img/fechar.svg );"
								></div>
								
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
									<span>Nova Página? </span>
								</div>
								<div class="col10">
									<span>
										<select name="target">
											<option 
												value="_self"
												'; if( $item['target'] == '_self' ){ echo 'selected'; } echo'
											>Mesma página</option>
											<option 
												value="_blank"
												'; if( $item['target'] == '_blank' ){ echo 'selected'; } echo'
											>Nova página</option>
										</select>
									</span>
								</div>
								
								<div class="col05">
									<span>Realce: </span>
								</div>
								<div class="col05">
									<span>
										<input 
											type="checkbox"
											name="realce" 
											'; if( $item['realce'] == 1 ){ echo 'checked'; } echo'
										/>
									</span>
								</div>
								
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
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=menu_servicos';
				
			}
			
		</script>
		
	</body>
	
</html>