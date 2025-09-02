<!-- Start - view/breadcrumb-secretarias.php !-->
<?php

$breadcrumb_pagina = '';
$breadcrumb_link = '';

foreach( $secretarias_array as $item ){
	
	if( $item['pagina'] == $_GET['secretaria'] ){ 
		$breadcrumb_link = 'secretarias&secretaria='. $item['pagina']; 
		$breadcrumb_pagina = $item['titulo']; 
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
				<a href="<?php echo $breadcrumb_link; ?>">
					<div class="breadcrumb-btn-meio-inclinado">
						<div class="breadcrumb-btn-meio-txt">Secretarias</div>
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
<!-- End - view/breadcrumb-secretarias.php !-->