<!-- Start - view/pat-posto-de-atendimento-ao-trabalhador.php !-->
<?php

require 'model/vagas.php';

//dd( $pagina['texto'] );

?>

<style><?php require 'css/pat-posto-de-atendimento-ao-trabalhador.css'; ?></style>

<section class="pat">
	
	<div class="box">
		
		<div class="pat-campo" id="ler_texto">
		
			<div class="pat-col">
			
				<div class="pat-item">
					<div class="pat-icone"><span class="material-symbols-outlined">location_on</span></div>
					<div class="pat-txt"><span>Rua Rangel Pestana, s/n - Centro (no Mercado Municipal)</span></div>
				</div>
				
				<?php
					
					//$atualizacao = $vagas_array[ count($vagas_array) - 1 ]['data'];
					$atualizacao = data_tempo( max(array_column($vagas_array, "data")) );
					
					if( $atualizacao != '' ){
						
						echo'
						<div class="pat-item">
							<div class="pat-icone"><span class="material-symbols-outlined">schedule</span></div>
							<div class="pat-txt"><span>Última atualização: '. $atualizacao .'</span></div>
						</div>
						';
						
					}
					
				?>
				
			</div>
			
			<div class="pat-col">
				
				<div class="pat-item">
					<div class="pat-icone"><span class="material-symbols-outlined">call</span></div>
					<div class="pat-txt"><span>Telefone: <a href="tel:01438158805" target="_blank">(14) 3815-8805</a></span></div>
				</div>
				
			</div>
			
		</div>
		
		<div class="pat-img" style="background-image: url( secretarias/carteira-de-trabalho.jpg )"></div>
		
		<div class="pat-html">
			
			<?php echo $pagina['texto'] ?>
			
			<div class="pat-table-mobile">
				<table>
					<thead>
						<tr>
							<th>OCUPAÇÃO</th>
							<th>Nº DE VAGAS</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
							
							usort($vagas_array, function( $a, $b ){//Função responsável por ordenar

								$al = mb_strtolower($a['nome']);
								$bl = mb_strtolower($b['nome']);
								
								if ($al == $bl){
									return 0;
								}
								
								return ($bl < $al) ? +1 : -1;
								
							});
							
							foreach( $vagas_array as $vaga ){

								echo '
								<tr>
									<td>'. $vaga['nome'] .'</td>
									<td>'. $vaga['quantidade'] .'</td>
								</tr>
								';
								
							}
							
						?>
						
					</tbody>
				</table>
			</div>
			
		</div>
		
		<div class="pat-mapa">
			<iframe 
				src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d750.5745421337145!2d-48.43901659575917!3d-22.88642546567772!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c6df773dadf601%3A0xb5f9eabfc0bb9edb!2sCasa%20do%20Cidad%C3%A3o!5e1!3m2!1spt-BR!2sbr!4v1705153313032!5m2!1spt-BR!2sbr" 
				scrolling="no" 
			></iframe>
		</div>
		
	</div>
	
</section>
<!-- End - view/pat-posto-de-atendimento-ao-trabalhador.php !-->