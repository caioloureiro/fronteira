<!-- Start - view/breadcrumb.php !-->
<?php

$breadcrumb_pagina = '';
$periodo_eleitoral = 0;

foreach( $periodo_eleitoral_array as $per ){
	
	$periodo_eleitoral = $per['ativado'];
	
}

foreach( $noticias_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){ 
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
				<a href="news">
					<div class="breadcrumb-btn-meio-inclinado">
						<div class="breadcrumb-btn-meio-txt">Notícias</div>
					</div>
				</a>
			</div>
			
			<?php 
			
				if( $periodo_eleitoral == 0 ){
					echo '
					<div class="breadcrumb-btn-final">
						<div class="breadcrumb-btn-final-inclinado">
							<div class="breadcrumb-btn-final-txt">'. $breadcrumb_pagina .'</div>
						</div>
					</div>
					';
				}
				
				if( $periodo_eleitoral == 1 ){
					echo '
					<div class="breadcrumb-btn-final">
						<div class="breadcrumb-btn-final-inclinado">
							<div class="breadcrumb-btn-final-txt">Período Eleitoral</div>
						</div>
					</div>
					';
				}
				
			?>
			
			
		</div>
		
	</div>
	
</section>
<!-- End - view/breadcrumb.php !-->