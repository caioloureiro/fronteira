<!-- Start - view/conselhos-municipais.php !-->
<?php

require 'model/conselhos_municipais.php';

?>

<style><?php require 'css/conselhos-municipais.css'; ?></style>

<section class="conselhos-municipais">
	
	<div class="box">
		
		<div class="conselhos-municipais-campo" id="ler_texto">
		
			<div class="conselhos-municipais-col">
			
				<div class="conselhos-municipais-item">
					<div class="conselhos-municipais-icone"><span class="material-symbols-outlined">location_on</span></div>
					<div class="conselhos-municipais-txt"><span>Rua Antônio Bernardo, 45 – Vila Guimarães</span></div>
				</div>
				
			</div>
			
			<div class="conselhos-municipais-col">
				
				<div class="conselhos-municipais-item">
					<div class="conselhos-municipais-icone"><span class="material-symbols-outlined">call</span></div>
					<div class="conselhos-municipais-txt"><span>Telefone: <a href="tel:01438111503" target="_blank">(14) 3811-1503</a></span></div>
				</div>
				
			</div>
			
		</div>
		
		<div class="conselhos-municipais-img" style="background-image: url( secretarias/conselhos-municipais.jpg )"></div>
		
		<div class="conselhos-municipais-html">
		
<p><strong>Casa dos Conselhos Municipais “Marli Ribeiro dos Santos”</strong></p>
<p>É o espaço disponibilizado pela Prefeitura Municipal de cidade para utilização dos Conselhos Municipais em atividade em cidade.</p>
<p>A Casa dos Conselhos recebeu o nome de Marli dos Santos Ribeiro, terapeuta ocupacional, sócia-fundadora em 1995 da Associação Arte e Convívio e pessoa ativa dentro das lutas da Saúde Mental. Ela faleceu aos 51 anos, no dia 24 de abril de 2010 e é homenageada cumprindo a Lei Municipal nº 5.233, de 29 de março de 2011.</p>

<h3>RELAÇÃO DOS CONSELHOS MUNICIPAIS ATIVOS</h3>

<p><em>Obs.: nem todos estes Conselhos se reúnem nas dependências da Casa dos Conselhos</em></p>

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
							target="_blank"
						>'. $conselho['nome'] .'</a>
					</td>
				</tr>
				';
				
			}
			
		?>
		
	</tbody>
</table>
		
		<div class="separador"></div>
		
		<h3>Como chegar aos conselhos:</h3>

		</div>
		
		<div class="conselhos-municipais-mapa">
			<iframe 
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d791.5871593651707!2d-48.442352503031124!3d-22.906260885699172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c72082032a6333%3A0x614bf98fd9ed28da!2sCasa%20dos%20Conselhos%20Municipais%20de%20cidade!5e0!3m2!1spt-BR!2sbr!4v1646318842072!5m2!1spt-BR!2sbr" 
				scrolling="no" 
			></iframe>
		</div>
		
	</div>
	
</section>
<!-- End - view/conselhos-municipais.php !-->