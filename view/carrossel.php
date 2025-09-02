<!-- Start - view/carrossel.php !-->
<?php 

require 'model/carrossel.php'; 

usort($carrossel_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['ordem']);
	$bl = mb_strtolower($b['ordem']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl < $al) ? +1 : -1;
	
});


?>

<style><?php require 'css/carrossel.css'; ?></style>

<section class="carrossel" ></section>

<script>

let carrossel = document.querySelector('.carrossel');

const isMobile = window.innerWidth < 1024;
//console.log( 'isMobile', isMobile );

if( isMobile ){
	
	carrossel.innerHTML = '<?php
		
		foreach( $carrossel_array as $slide ){

			if( $slide['mobile'] == 1 ){
				echo'<div class="carrossel-slide" style="background-image:url(carrossel/'. $slide['imagem'] .')"><a href="'. $slide['link'] .'" target="'. $slide['target'] .'"></a></div>';
			}
			
		}
		
	?>';
	
}
else{
	
	carrossel.innerHTML = '<?php
		
		foreach( $carrossel_array as $slide ){
			
			if( $slide['mobile'] == 0 ){
				echo'<div class="carrossel-slide" style="background-image:url(carrossel/'. $slide['imagem'] .')"><a href="'. $slide['link'] .'" target="'. $slide['target'] .'"></a></div>';
			}
			
		}
		
	?>';
	
}

let carrossel_flickity = new Flickity( carrossel, {

	cellAlign: 'center',
	contain: true,
	prevNextButtons: true,
	pageDots: true,
	wrapAround: true,
	initialIndex: 1,
	autoPlay: 7000
  
});

</script>
<!-- End - view/carrossel.php !-->