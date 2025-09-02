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
require $raiz_site .'model/enquete_respostas.php'; 
require $raiz_site .'model/enquete.php'; 

foreach( $enquete_array as $form ){
	
	if( $form['id'] == $_GET['enquete_id'] ){
	
		$form_nome = $form['nome'];
		
	}
	
}

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
		
		<div class="lightbox enquete_respostas-visualizar on">
			
			<div class="lightbox-titulo">

				Respostas ao formulário: <?php echo $form_nome ?>
				<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );"></div>
				
			</div>
			
			<div class="formulario_campo">
				
				<?php
				
					foreach( $enquete_respostas_array as $resp ){
		
						if( $resp['enquete_id'] == $_GET['enquete_id'] ){
							
							$respostas_array = explode( ';', trim( strip_tags( $resp['respostas'] ) ) );
							array_pop( $respostas_array );
							
							echo'
							<div 
								class="linha"
								style="
									width:100%;
									height:auto;
									padding:1vw;
									box-sizing: border-box;
									-webkit-box-sizing: border-box;
								"
							>
								<div class="col85">
									<a href="resposta?id='. $resp['id'] .'">
										<span>
											';
											
											foreach( $respostas_array as $respItem ){
												
												echo $respItem .' | ';
												
											}
											
											echo'
										</span>
									</a>
								</div>
								<div class="col15">
									<span>
										<div 
											class="btn" 
											onclick="criarCSV( `'. $resp['respostas'] .'` )"
										>Exportar para CSV</div>
									</span>
								</div>
							</div>
							';
							
						}
						
					}
					
				?>
				
			</div>

			<div class="linha-acao"> 
				<div class="btn" onclick="voltar()">Voltar</div>
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=enquetes_respostas';
				
			}
			
			function criarCSV( texto ){
				
				//console.log( 'texto', texto );
				
				let csv = 'pergunta;resposta\n';
				
				const textoArray = texto.split(';');
				
				//console.log( 'textoArray', textoArray );
				
				for( var item in textoArray ) {
	
					//console.log( textoArray[item] );
					
					let linha = textoArray[item].replace('=', ';');
					
					//console.log( linha );
					
					csv += linha +'\n';
					
				}
				
				console.log( 'csv', csv );
				
				//window.open('data:text/csv;charset=utf-8,' + escape(csv));
				
				const date = new Date();
				let dia = date.getDate();
				let mes_num = date.getMonth() + 1;
				let mes = '';
				if( mes_num < 10 ){ mes = '0'+ mes_num; }else{ mes = mes_num; }
				let ano = date.getFullYear();
				let hora = date.getHours();
				let min = date.getMinutes();
				let sec = date.getSeconds();
				let data_invertida = ano+'-'+mes+'-'+dia+'-'+hora+'-'+min+'-'+sec+'-';
				
				let filename =  data_invertida +'arquivo.csv';
				
				var hiddenElement = document.createElement('a');
				hiddenElement.href = 'data:text/csv;charset=utf-8,' + escape(csv);
				hiddenElement.target = '_blank';
				hiddenElement.download = filename;
				hiddenElement.click();
				
				alert('Arquivo '+ filename +' criado com sucesso.');
				
			}
			
		</script>
		<script src="https://digitalmd.com.br/editor-de-texto/assets/motor.js"></script>
		
	</body>
	
</html>