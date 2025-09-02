<!-- Start - admin/modulos/popup/wiew/home.php !-->
<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../';
$raiz_admin = '';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'model/popup.php';

$editor_de_texto_valor = '';

$popup_ativado = '';
$popup_conteudo = '';
$popup_tipo = '';

foreach( $popup_array as $popup ){

	$popup_ativado = $popup['ativado'];
	$popup_conteudo = $popup['conteudo'];
	$popup_tipo = $popup['tipo'];
	
	/*Start - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/
	$editor_de_texto_json = json_encode( $popup_conteudo, JSON_PRETTY_PRINT ); //Criei um JSON
	//dd( $editor_de_texto_json );
	/*End - RECEBE OD DADOS PHP DO BANCO E COLOCA NO PLUGIN EDITOR DE TEXTOS*/

}

$tema = 'claro';

if( $popup_ativado == 1 ){ $tema = 'escuro'; }

?>

<!-- Start - JODIT !-->
<link
  rel="stylesheet"
  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
/>
<!-- End - JODIT !-->

<style>
	<?php 
		require 'css/switch-btn.css'; 
		require 'css/card.css'; 
	?>
</style>

<div class="conteudo popup">
	
	<div class="titulo">Popup (Aviso Inicial)</div>
	
	<div class="conteudo-tabela-janela">

		<div class="card100">
			
			<div class="card-auto-item">
				
				<div class="card-linha">
				
					<div class="col10">
						<div class="card-auto-item-titulo">Ativado: </div>
					</div>
					
					<div class="col10">
						<a href="modulos/popup/controller/ativar.php?status_atual=<?php echo $popup_ativado ?>">
							<div class="switch-btn-<?php echo $tema ?>"><span></span></div>
						</a>
					</div>
					
				</div>
				
				<form action="modulos/popup/controller/editar.php" method="POST">
				
					<div 
						class="card-linha"
						title="Se esta opção estiver ativada como IMAGEM, o fundo será transparente."
					>
						
						<div class="col10">
							<div class="card-auto-item-titulo">Tipo: </div>
						</div>
						
						<div class="col90">
							<span>
								<select class="popup_tipo" name="popup_tipo">
									<option 
										value="imagem" 
										<?php if( $popup_tipo == 'imagem' ){ echo'selected'; } ?>
									>Imagem</option>
									<option 
										value="texto" 
										<?php if( $popup_tipo == 'texto' ){ echo'selected'; } ?>
									>Texto</option>
								</select>
							</span>
						</div>
						
					</div>
					
					<div class="card-linha">
						
						<div class="col10">
							<div class="card-auto-item-titulo">Conteúdo: </div>
						</div>
						
					</div>

					<div class="linha linha-auto">
						<textarea id="editor" name="editor_texto"></textarea>
					</div>
					
					<div class="linha-acao"> 
						<button type="submit">Gravar</button> 
					</div>
					
				</form>
				
			</div>
			
		</div>
		
	</div>
	
</div>

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

</script>
<!-- End - admin/modulos/popup/wiew/home.php !-->