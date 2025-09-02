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
require $raiz_site .'model/categorias.php';

usort($categorias_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

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

		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<?php 
			
			$pasta_nome = 'arquivos';
			$pasta = $raiz_site .'arquivos/';
		
			require $raiz_admin .'view/escurecer.php'; 
			require 'arquivos.php';
			
		?>
		
		<div class="lightbox exemplo-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo download
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
						<span>Link: </span>
					</div>
					<div class="col90">
						<input 
							name="link" 
							required
							value="#"
						/>
					</div>
				</div>
			
				<div class="linha">
					<div class="col10">
						<span>Categorias: </span>
					</div>
					<div class="col30">
						<span>
							<select 
								class="categoria_select" 
								name="categoria_select"
							>
								<option value="">Escolher a categoria</option>
								
								<?php
								
									foreach( $categorias_array as $notCat ){

										echo '<option>'. $notCat['nome'] .'</option>';
										
									}
									
								?>
								
							</select>
						</span>
					</div>
					<div class="col60">
						<input 
							class="categorias" 
							name="categorias" 
							required
							placeholder="Separe por ponto e vírgula. Exemplo: Alimentação;Educação;Saúde;etc."
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Arquivo: </span>
					</div>
					<div class="col90">
						<input 
							name="arquivo" 
							class="item-escolher-arquivo-input" 
							required
							value="<?php echo $_GET['arquivo'] ?>"
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10"></div>
					<div class="col90">
						<span 
							onclick="abrirArquivos()"
							style="cursor:pointer;"
						>Escolher outro arquivo.</span>
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
			
			let categoria_select = document.querySelector('.categoria_select');
			let categorias = document.querySelector('.categorias');
			
			categoria_select.addEventListener("change", function() {
				
				categorias.value = categorias.value + categoria_select.value +';';
				document.querySelector('.categoria_select').value = '';
				
			});
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			function voltar(){
				
				window.history.back();
				
			}
			
		</script>
		
	</body>
	
</html>