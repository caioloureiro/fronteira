<!-- Start - view/banner.php !-->
<?php require 'model/banner.php'; ?>

<style><?php require 'css/banner.css'; ?></style>

<section class="banner" >
	
	<div class="box">
		<div class="banner-carrossel">
			<?php

				foreach( $banner_array as $slide ){

					echo'<div class="banner-slide" style="background-image:url(banners/'. $slide['imagem'] .')"><a href="'. $slide['link'] .'" target="'. $slide['target'] .'"></a></div>';
					
				}
				
			?>
		</div>
	</div>
	
</section>

<script>

let banner = document.querySelector('.banner-carrossel');

let banner_flickity = new Flickity( banner, {

	cellAlign: 'center',
	contain: true,
	prevNextButtons: false,
	pageDots: true,
	wrapAround: true,
	initialIndex: 1,
	autoPlay: 7000
  
});

</script>
<!-- End - view/banner.php !-->