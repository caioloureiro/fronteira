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
require $raiz_site .'model/downloads.php';

$hoje = date( 'Y-m-d H:i:s' );

//dd( $_GET );

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar chamamento_publico</title>
		
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
			
			$pasta_nome = 'arquivos';
			$pasta = $raiz_site .'arquivos/';

			require $raiz_admin .'view/escurecer.php'; 
			require 'arquivos.php';
			
		?>
		
		<div class="lightbox chamamento_publico-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Criar Chamamento Público
					<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" ></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<span>
							<input 
								name="titulo" 
								required
							/>
						</span>
					</div>
				</div>
			
				<div class="linha">
					<div class="col10">
						<span>Situação: </span>
					</div>
					<div class="col90">
						<span>
							<select name="situacao">
								<option value="aberto" selected >Aberto</option>
								<option value="andamento">Em Andamento</option>
								<option value="finalizado">Finalizado</option>
								<option value="cancelado">Cancelado</option>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Número: </span>
					</div>
					<div class="col90">
						<span>
							<input name="numero" />
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Processo: </span>
					</div>
					<div class="col90">
						<span>
							<input name="processo" />
						</span>
					</div>
				</div>
				
				<div class="linha">
				
					<div class="col10">
						<span>Publicação: </span>
					</div>
					<div class="col40">
						<span>
							<input 
								type="datetime-local"
								name="data" 
								value="<?= $hoje ?>"
							/>
						</span>
					</div>
					
					<div class="col10">
						<span>Encerramento: </span>
					</div>
					<div class="col40">
						<span>
							<input 
								type="datetime-local"
								name="encerramento" 
							/>
						</span>
					</div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Local: </span>
					</div>
					<div class="col90">
						<span>
							<input name="local" />
						</span>
					</div>
				</div>
				
				<div class="separador"></div>

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
			
			function excluirArquivo( id ){
				
				//console.log( 'id', id ); 
				
				let input_arquivos = document.querySelector('.input_arquivos').value;
				//console.log( 'input_arquivos', input_arquivos ); 
				
				let input_arquivos_array = input_arquivos.split( id +";");
				//console.log( 'input_arquivos_array', input_arquivos_array ); 
				
				let resultado = input_arquivos_array[0] + input_arquivos_array[1];
				//console.log( 'resultado', resultado ); 
				
				document.querySelector( '.input_arquivos' ).value = resultado;
				document.querySelector( '.anexo_'+ id ).remove();
				
			}
			
			function abrirArquivos(){
				
				document.querySelector('.item-arquivos').classList.add("on");
				
			}
			
			function voltar(){
				
				window.location = '<?php echo $raiz_admin ?>matriz?pagina=chamamento_publico';
				
			}
			
		</script>
		
	</body>
	
</html>