<!-- Start - view/menu-interno.php !-->
<?php

require 'model/menu_interno.php';

$counter = 0;

foreach( $menu_interno_array as $count_item ){

	if( $_GET['pagina'] == $count_item['pagina_alvo'] ){ $counter++; }

}


if( $counter > 0 ){ 
	?>

	<style><?php require 'css/menu-interno.css'; ?></style>


	<section class="menu-interno">
		
		<div class="box">
			
			<div class="menu-interno-campo">
				
				<?php 
					
					foreach( $menu_interno_array as $item ){

						if( $_GET['pagina'] == $item['pagina_alvo'] ){
							
							echo'
							<a href="'. $item['link'] .'" target="'. $item['target'] .'">
								<div class="menu-interno-item">
									<div class="menu-interno-icone"><span class="material-symbols-outlined">arrow_right_alt</span></div> '. $item['nome'] .'
								</div>
							</a>
							';
							
						}
						
					}
					
				?>
				
			</div>
			
		</div>
		
	</section>

	<?php
}

?>
<!-- End - view/menu-interno.php !-->