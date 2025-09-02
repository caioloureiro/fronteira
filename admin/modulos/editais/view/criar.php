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
require $raiz_site .'model/chamamento_publico.php';
require $raiz_site .'model/downloads.php';

usort($chamamento_publico_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['titulo']);
	$bl = mb_strtolower($b['titulo']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});

$downloads_array = array_reverse( $downloads_array );

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
	
		<div class="lightbox edital-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo edital
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
						<span>Modalidade: </span>
					</div>
					<div class="col90">
						<span>
							<select 
								name="modalidade_id"
								required
							>
								<option value="2" selected >Chamamento Público</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Item: </span>
					</div>
					<div class="col90">
						<span>
							<select 
								name="modalidade_item_id"
								required
							>
								<option value="">Escolher Item</option>
								<?php
									
									foreach( $chamamento_publico_array as $item ){

										echo '<option value="'. $item['id'] .'">'. $item['titulo'] .'</option>';
										
									}
									
								?>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Arquivo: </span>
					</div>
					<div class="col90">
						<span>
							<select 
								class="modalidade_arquivo_id"
								name="modalidade_arquivo_id"
								required
							>
								<option value="">Escolher Arquivo</option>
								<?php
									
									foreach( $downloads_array as $item ){

										echo '<option value="'. $item['id'] .'">'. $item['arquivo'] .'</option>';
										
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=editais';
				
			}
			
			tail.select( ".modalidade_arquivo_id",{
				width: "100%",
				search: true,
			} );
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>