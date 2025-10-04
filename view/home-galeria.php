<!-- Start - view/home-galeria.php !-->
<?php 
require 'model/galeria.php'; 
require 'model/galeria_imagens.php'; 

$count_galeria = 0;
?>

<style><?php require 'css/home-galeria.css'; ?></style>

<section class="home-galeria">
	
	<div class="box">
		
		<div class="home-titulo-campo">
			<div class="home-titulo-icone"><span class="material-symbols-outlined">photo_camera</span></div>
			<div class="home-titulo">Galeria de Fotos</div>
			<a href="galerias"><?php require 'view/btnVerMais.php'; ?></a>
		</div>
		
		<div class="home-galeria-campo">
			
			<?php
				
				foreach( $galeria_array as $gal ){
					
					if( 
						$gal['destaque'] == 1 
						&& $count_galeria <= 3
					){
						
						$capa = '';
						
						foreach( $galeria_imagens_array as $foto ){
							
							if( 
								$foto['galeria_id'] == $gal['id'] 
								&& $foto['destaque'] == 1
							){
								
								$capa = $foto['imagem'];
								
							}
							
						}
					
						echo '
						<div class="home-galeria-item" style="background-image:url( galeria/'. $capa .' )">
							<a href="galerias-item&id='. $gal['id'] .'" target="_self">
								<div class="home-galeria-lente"></div>
								<div class="home-galeria-foto" style="background-image:url( galeria/'. $capa .' )"></div>
								<div class="home-galeria-base">
									<div class="home-galeria-data">'. $gal['data'] .'</div>
									<div class="home-galeria-titulo"><span>'. $gal['nome'] .'</span></div>
								</div>
							</a>
						</div>
						';
						
						$count_galeria++;
						
					}
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/home-galeria.php !-->