<!-- Start - view/galeria-de-prefeitos.php !-->
<?php 

require 'model/prefeitos.php'; 

$prefeitos_array = array_reverse( $prefeitos_array );

?>

<style><?php require 'css/galeria-de-prefeitos.css'; ?></style>

<section class="galeria-de-prefeitos">
	
	<div class="box">
		
		<?php
			
			foreach( $prefeitos_array as $prefeito ){

				echo '
				<div class="galeria-de-prefeitos-card">
					<a href="prefeito&id='. $prefeito['id'] .'&nome='. renomear($prefeito['nome']) .'">
						<div class="galeria-de-prefeitos-img" style="background-image:url( prefeitos/'. $prefeito['foto'] .' )"></div>
						<div class="galeria-de-prefeitos-nome"><span>'. $prefeito['nome'] .'</span></div>
						<div class="galeria-de-prefeitos-txt">Período de atuação</div>
						<div class="galeria-de-prefeitos-periodo">
							<div class="galeria-de-prefeitos-periodo-data">'. data( $prefeito['data_ini'] ) .'</div>
							<div class="galeria-de-prefeitos-periodo-seperador"><span class="material-symbols-outlined">arrow_right_alt</span></div>
							<div class="galeria-de-prefeitos-periodo-data">'. data( $prefeito['data_fim'] ) .'</div>
						</div>
						<div class="galeria-de-prefeitos-btn">Ver mais</div>
					</a>
				</div>
				';
				
			}
			
		?>
		
	</div>
	
</section>
<!-- End - view/galeria-de-prefeitos.php !-->