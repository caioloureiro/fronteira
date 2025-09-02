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
require $raiz_site .'model/audiencias_publicas.php';
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
		<title>Editar noticias</title>
		
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
			
			foreach( $audiencias_publicas_array as $item ){
				
				if( $item['id'] == $_GET['id'] ){
					
					/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
					$editor_de_texto_json = json_encode( $item['descricao'], JSON_PRETTY_PRINT ); //Criei um JSON
					//dd( $editor_de_texto_json );
					/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
				
					echo'
					<div class="lightbox audiencia_publica-editar on">

						<form action="../controller/editar.php" method="POST">
						
							<input name="id" value="'. $item['id'] .'" style="display:none" />
							
							<div class="lightbox-titulo">

								Editar audiência: '. $item['titulo'] .'
								<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( '. $raiz_admin .'img/fechar.svg );"></div>
								
							</div>
							
							<div class="linha">
								<div class="col10">
									<span>Título: </span>
								</div>
								<div class="col90">
									<input 
										name="titulo" 
										required
										value="'. $item['titulo'] .'"
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
										value="'. $item['local'] .'"
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
										value="'. $item['data_publicacao'] .'"
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
										value="'. $item['data_audiencia'] .'"
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
											
											';
											
												foreach( $categorias_array as $dept ){

													echo '
													<option
														'; if( $dept['nome'] == $item['categoria'] ){ echo'selected'; } echo'
													>'. $dept['nome'] .'</option>
													';
													
												}
												
											echo'
											
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
					';
					
				}
				
			}
			
		?>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
			let editor_de_texto_json = <?php echo $editor_de_texto_json ?>; //peguei o Multidimensional Array PHP e converti
			
			console.log( editor_de_texto_json );
			
			//document.querySelector('.editor_de_texto .recebe').value = editor_de_texto_json;
			//document.querySelector('.editor_de_texto #text-input').innerHTML = editor_de_texto_json;
			
			const editor = new Jodit("#editor", {
				language: "pt_br", // Configurar para português brasileiro
			});
			editor.value = editor_de_texto_json;
			/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
		
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=audiencias_publicas';
				
			}
			
		</script>
		
	</body>
	
</html>