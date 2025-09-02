<!-- Start - view/telefones-uteis.php !-->
<style><?php require 'css/telefones-uteis.css'; ?></style>

<section class="telefones-uteis">
	
	<div class="box">
		
		<div class="telefones-uteis-flex">
			
			<?php
				
				foreach( $telefones_array as $tel ){

					echo '
					<div class="telefones-uteis-item">
						<a href="'. $tel['pagina_contato'] .'" target="_blank">
							<div 
								class="telefones-uteis-img"
								style="background-image:url( img/'. $tel['imagem'] .' )"
							></div>
							<div class="telefones-uteis-campo">
								<div class="telefones-uteis-titulo">'. $tel['nome'] .'</div>
								<div class="telefones-uteis-fone">'. $tel['fone'] .'</div>
							</div>
							<div class="telefones-uteis-icone"><span class="material-symbols-outlined">call</span></div>
							<div class="telefones-uteis-comentario">'. $tel['descricao'] .'</div>
						</a>
					</div>
					';
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/telefones-uteis.php !-->