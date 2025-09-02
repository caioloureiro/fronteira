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
require $raiz_site .'model/formularios_respostas.php'; 
require $raiz_site .'model/formularios.php'; 

foreach( $formularios_array as $form ){
	
	if( $form['id'] == $_GET['formulario_id'] ){
	
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
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="lightbox formularios_respostas-visualizar on">
			
			<div class="lightbox-titulo">

				Respostas ao formulário: <?php echo $form_nome ?>
				<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );"></div>
				
			</div>
			
			<div class="linha linha-auto comentario">
				<div class="col100">
					<span>
						<div 
							class="btn" 
							onclick="criarCSV_total( `<?php echo $_GET['formulario_id'] ?>` )"
						>Exportar Respostas para para CSV</div>
					</span>
				</div>
			</div>
			
			<div class="formulario_campo">
				
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
					<div class="col70"><span><strong>RESPOSTAS</strong></span></div>
					<div class="col15"><span><strong>PROTOCOLO</strong></span></div>
					<div class="col15"><span><strong>AÇÃO</strong></span></div>
				</div>
				
				<?php
				
					foreach( $formularios_respostas_array as $resp ){
		
						if( $resp['formulario_id'] == $_GET['formulario_id'] ){
							
							$respostas_array = explode( ';', trim( strip_tags( $resp['respostas'] ) ) );
							$protocolo = '-';
							
							if( $resp['protocolo'] != '' ){ $protocolo = $resp['protocolo']; }
							
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
								<div class="col70">
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
									<span>'. $protocolo .'</span>
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
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=formularios_respostas';
				
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
			
			function criarCSV_total( texto ){
				
				console.log( 'criarCSV_total()' );
				
				<?php
					
					$csv_txt = '';
					$csv = '';
					
					$formularios_respostas_array_last = implode( ' | ', $formularios_respostas_array[ count( $formularios_respostas_array ) - 1 ] );
					//echo'console.log( "$formularios_respostas_array_last", "'. $formularios_respostas_array_last .'" );';
					
					$formularios_respostas_titulos_array = explode( ' | ', trim( strip_tags( $formularios_respostas_array_last ) ) );
					//echo'console.log( "$formularios_respostas_titulos_array[3]", "'. $formularios_respostas_titulos_array[3] .'" );';
					
					$formularios_respostas_titulos_string = $formularios_respostas_titulos_array[3];
					$formularios_respostas_titulos_pares = explode(';', $formularios_respostas_titulos_string);
					
					// Criar arrays para armazenar os resultados
					$formularios_respostas_titulos_antesDoIgual = [];
					$formularios_respostas_titulos_depoisDoPontoVirgula = [];

					// Processar cada item da string
					foreach ($formularios_respostas_titulos_pares as $par) {
						
						if (strpos($par, '=') !== false) {
							
							list($antes, $depois) = explode('=', $par, 2); // Dividir a chave e o valor
							$formularios_respostas_titulos_antesDoIgual[] = $antes;
							$formularios_respostas_titulos_depoisDoPontoVirgula[] = $depois;
							
						}
						
					}
					
					$formularios_respostas_titulos = '';
					
					foreach( $formularios_respostas_titulos_antesDoIgual as $ant ){

						$formularios_respostas_titulos .= $ant .';';
						
					}
					
					$formularios_respostas_titulos = mb_substr( $formularios_respostas_titulos, 0, -1 );
					//echo'console.log( "$formularios_respostas_titulos", "'. $formularios_respostas_titulos .'" );';
					
					$csv .= $formularios_respostas_titulos .'\n';
				
					foreach( $formularios_respostas_array as $resp ){
		
						if( $resp['formulario_id'] == $_GET['formulario_id'] ){
							
							//echo'console.log( "id", "'. $resp['id'] .'" ); ';
							//echo'console.log( "formulario_id", "'. $resp['formulario_id'] .'" ); ';
							//echo'console.log( "respostas", "'. $resp['respostas'] .'" ); ';
							
							$csv_txt .= $resp['respostas'] .'\n';
							
							$formularios_respostas_pares = explode(';', $resp['respostas']);
							
							// Criar arrays para armazenar os resultados
							$formularios_respostas_antesDoIgual = [];
							$formularios_respostas_depoisDoPontoVirgula = [];
							
							foreach ($formularios_respostas_pares as $par) {
								
								if (strpos($par, '=') !== false) {
									
									list($antes, $depois) = explode('=', $par, 2); // Dividir a chave e o valor
									$formularios_respostas_antesDoIgual[] = $antes;
									$formularios_respostas_depoisDoPontoVirgula[] = $depois;
									
								}
								
							}
							
							$formularios_respostas = '';
							
							foreach( $formularios_respostas_depoisDoPontoVirgula as $dep ){

								$formularios_respostas .= $dep .';';
								
							}
							
							$formularios_respostas = mb_substr( $formularios_respostas, 0, -1 );
							//echo'console.log( "$formularios_respostas", "'. $formularios_respostas .'" );';
							
							$csv .= $formularios_respostas .'\n';
							
						}
						
					}
					
					$csv = str_replace(["\r\n", "\n", "\r"], " ", $csv);
					
					//echo'console.log( "$csv_txt", "'. $csv_txt .'" ); ';
					//echo'console.log( "$csv", "'. $csv .'" ); ';
					
				?>
				
				var csv = "<?php echo $csv ?>";
				console.log( "csv", csv );
				
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
				
				let filename =  data_invertida +'formulario_completo.csv';
				
				var hiddenElement = document.createElement('a');
				hiddenElement.href = 'data:text/csv;charset=utf-8,' + escape(csv);
				hiddenElement.target = '_blank';
				hiddenElement.download = filename;
				hiddenElement.click();
				
				alert('Arquivo '+ filename +' criado com sucesso.');
				
			}
			
		</script>
		
	</body>
	
</html>