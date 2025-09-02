<!-- Start - view/breadcrumb.php !-->
<?php

$breadcrumb_pagina = '';

foreach( $galeria_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){ 
		$breadcrumb_link = 'galerias-item&id='. $item['id']; 
		$breadcrumb_pagina = $item['nome']; 
	}
	
}
	
?>

<style><?php require 'css/breadcrumb.css'; ?></style>

<section class="breadcrumb">
	
	<div class="box">
		
		<div class="breadcrumb-campo">
		
			<div class="breadcrumb-btn-inicio">
				<a href="./">
					<div class="breadcrumb-btn-inicio-inclinado">
						<div class="breadcrumb-btn-inicio-txt">Principal</div>
					</div>
				</a>
			</div>
		
			<div class="breadcrumb-btn-meio">
				<a href="galerias">
					<div class="breadcrumb-btn-meio-inclinado">
						<div class="breadcrumb-btn-meio-txt">Galerias</div>
					</div>
				</a>
			</div>
			
			<div class="breadcrumb-btn-final">
				<a href="<?php echo $breadcrumb_link; ?>">
					<div class="breadcrumb-btn-final-inclinado">
						<div class="breadcrumb-btn-final-txt"><?php echo $breadcrumb_pagina; ?></div>
					</div>
				</a>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/breadcrumb.php !-->