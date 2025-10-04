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

require $raiz_site .'model/licitacoes.php';
$licitacoes_array = array_reverse( $licitacoes_array );

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar Licitações Anexos</title>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox licitacoes_vencedores-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo vencedor
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
						<span>Documento: </span>
					</div>
					<div class="col90">
						<input 
							name="documento" 
							required
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
								
								<?php
									
									foreach( $licitacoes_array as $conc ){
										
										echo'<option value="'. $conc['id'] .'">'. $conc['numero'] .' - '. $conc['nome'] .'</option>';
										
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