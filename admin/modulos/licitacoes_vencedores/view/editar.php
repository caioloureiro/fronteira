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
require $raiz_site .'model/licitacoes_vencedores.php';
require $raiz_site .'model/licitacoes.php';
$licitacoes_array = array_reverse( $licitacoes_array );
?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Editar licitacoes_vencedores</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<?php 
			
			$editor_de_texto_valor = '';
			
			foreach( $licitacoes_vencedores_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
				
					echo'
					<div class="lightbox licitacoes_vencedores-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar licitacoes_vencedores: '. $item['nome'] .'
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
									<span>Documento: </span>
								</div>
								<div class="col90">
									<input 
										name="documento" 
										required
										value="'. $item['documento'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Item: </span>
								</div>
								<div class="col90">
									<input 
										name="item" 
										value="'. $item['item'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Valor: </span>
								</div>
								<div class="col90">
									<input 
										name="valor" 
										placeholder="Não precisa colocar R$"
										title="Não precisa colocar R$"
										value="'. $item['valor'] .'" 
									/>
								</div>
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Licitação: </span>
								</div>
								<div class="col90">
									<span>
										<select class="licitacao" name="licitacao">
											<option value="0">Selecione a licitação</option>
											
											';
												
												foreach( $licitacoes_array as $conc ){
													
													echo'
													<option 
														value="'. $conc['id'] .'"
														'; if( $conc['id'] == $item['licitacao'] ){ echo 'selected'; } echo'
													>'. $conc['numero'] .' - '. $conc['nome'] .'</option>
													';
													
												}
												
											echo'
											
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
		
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script>
			
			tail.select( ".licitacao",{
				width: "100%",
				search: true,
			} );
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=licitacoes_vencedores';
				
			}
			
		</script>
		
	</body>
	
</html>