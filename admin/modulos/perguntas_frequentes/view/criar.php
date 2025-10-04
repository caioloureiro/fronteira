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
require $raiz_site .'model/perguntas_frequentes_categorias.php';

usort($perguntas_frequentes_categorias_array, function( $a, $b ){ //Função responsável por ordenar
	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	if ($al == $bl){ return 0; }
	return ($bl < $al) ? +1 : -1; // < ASC; > DESC
});

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar perguntas_frequentes</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox perguntas_frequentes-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova pergunta
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Pergunta: </span>
					</div>
					<div class="col90">
						<input 
							name="pergunta" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Categoria: </span>
					</div>
					<div class="col90">
						<span>
							<select name="categoria" required>
								<option value="">Selecione a categoria</option>
								<?php
									
									foreach( $perguntas_frequentes_categorias_array as $cat ){

										echo '
										<option 
											value="'. $cat['nome'] .'"
										>'. $cat['nome'] .'</option>
										';
										
									}
									
								?>
							</select>
						</span>
					</div>
				</div>
				
				<div class="separador"></div>

				<div class="linha linha-auto">
					<div class="col100">
						<span>Resposta: </span>
					</div>
				</div>
				
				<div class="linha linha-auto">
					<textarea id="editor" name="editor_texto"></textarea>
				</div>

				<div class="separador"></div>
				
				<div class="linha-acao">
				
					<button type="submit">Gravar</button>
					<div class="btn" onclick="voltar()">Cancelar</div>
					
				</div>
				
				<div class="separador"></div>
				
			</form>

		</div>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=perguntas_frequentes';
				
			}
			
		</script>
		
	</body>
	
</html>