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
require $raiz_site .'model/departamentos.php';
require $raiz_site .'model/categorias.php';

usort($categorias_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['nome']);
	$bl = mb_strtolower($b['nome']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

$hoje = date( 'Y-m-d H:i:s' );

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar audiencias_publicas</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox audiencia_publica-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Nova audiência
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<input 
							name="titulo" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Local: </span>
					</div>
					<div class="col90">
						<input 
							name="local" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
				
					<div class="col10">
						<span>Data da publicação: </span>
					</div>
					<div class="col20">
						<input 
							name="data_publicacao" 
							required
							type="datetime-local"
							value="<?php echo $hoje ?>"
						/>
					</div>
				
					<div class="col10">
						<span>Data da audiência: </span>
					</div>
					<div class="col20">
						<input 
							name="data_audiencia" 
							required
							type="datetime-local"
						/>
					</div>
				
					<div class="col10">
						<span>Categoria: </span>
					</div>
					<div class="col20">
						<span>
							<select 
								class="categoria" 
								name="categoria"
							>
								<option value="">Categoria</option>
								
								<?php
								
									foreach( $categorias_array as $notCat ){

										echo '<option>'. $notCat['nome'] .'</option>';
										
									}
									
								?>
								
							</select>
						</span>
					</div>
					
				</div>

				<div class="separador"></div>

				<div class="linha linha-auto">
					<textarea id="editor" name="editor_texto"></textarea>
				</div>
				
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=audiencias_publicas';
				
			}
			
		</script>
		
	</body>
	
</html>