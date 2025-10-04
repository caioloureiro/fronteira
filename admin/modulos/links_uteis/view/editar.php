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
require $raiz_site .'model/links_uteis.php';

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar link</title>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $links_uteis_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox link-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar link: '. $item['nome'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Nome: </span>
								</div>
								<div class="col90">
									<input 
										name="nome" 
										required 
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
										required
										value="'. $item['target'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Nova página: </span>
								</div>
								<div class="col90">
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
							</div>

							<div class="separador"></div>
							
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=links_uteis';
				
			}
			
		</script>
		
	</body>
	
</html>