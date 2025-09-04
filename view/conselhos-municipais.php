<!-- Start - view/conselhos-municipais.php !-->
<?php

require 'model/conselhos_municipais.php';

?>

<style><?php require 'css/conselhos-municipais.css'; ?></style>

<section class="conselhos-municipais">
	
	<div class="box">

		<?php 
			if( $pagina['texto'] != '' ){ 
				echo'<div class="conselhos-municipais-campo" id="ler_texto">'. $pagina['texto'] .'</div>'; 
			} 
		?>
		
		<div class="conselhos-municipais-html">

			<table>
				<thead>
					<tr>
						<th>Nome</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						
						usort($conselhos_municipais_array, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['nome']);
							$bl = mb_strtolower($b['nome']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
						
						foreach( $conselhos_municipais_array as $conselho ){

							echo '
							<tr>
								<td>
									<a 
										href="'. $conselho['pagina'] .'" 
										target="_self"
									>'. $conselho['nome'] .'</a>
								</td>
							</tr>
							';
							
						}
						
					?>
					
				</tbody>
			</table>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/conselhos-municipais.php !-->