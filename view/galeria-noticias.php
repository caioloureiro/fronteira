<!-- Start - view/galeria-noticias.php !-->
<?php

require 'model/galeria_noticias.php';

$galeria_noticias_count = 0;
$galeria_noticias_check = 0;

$pasta = 'galeria/';

foreach( $galeria_noticias_array as $item ){

	if( $item['noticia_id'] == $_GET['id'] ){
		
		$galeria_noticias_check++;
		
	}
	
}
//echo'<script> alert("'. $galeria_noticias_check .'"); </script>';

?>

<?php if( $galeria_noticias_check > 0 ){ ?>

	<style><?php require 'css/galeria-noticias.css'; ?></style>

	<div 
		class="galeria-noticias-escurecer"
		onclick="galeria_noticias_lightbox_sair()"
	>
		<div class="galeria-noticias-escurecer-fechar"><?php require 'img/fechar.svg'; ?></div>
	</div>

	<section class="galeria-noticias">
		
		<div class="box">
			
			<div class="galeria-noticias-titulo"><span>Imagens relacionadas</span></div>
			
			<div class="galeria-noticias-campo">
				
				<?php
					
					foreach( $galeria_noticias_array as $item ){
						
						if( $item['noticia_id'] == $_GET['id'] ){
							
							$galeria_noticias_count++;
							
							$imagem_check = explode( '/', $item['imagem'] );

							if(
								$imagem_check[0] == 'http:' ||
								$imagem_check[0] == 'https:'
							){

								$imagem = $item['imagem'];
								
							}else{

								$imagem = $pasta . $item['imagem'];
								
							}
							
							echo'
							<div class="galeria-noticias-item">
							
								<div 
									class="galeria-noticias-thumb" 
									style="background-image:url( '. $imagem .' )"
									onclick="galeria_noticias_lightbox_abrir( `galeria_noticias_lightbox_'. $galeria_noticias_count .'` )"
								></div>

								<div class="galeria-noticias-lightbox galeria_noticias_lightbox_'. $galeria_noticias_count .'">
									
									<a 
										href="'. $imagem .'" 
										target="_blank"
									>
										<img 
											class="galeria-noticias-lightbox-imagem" 
											src="'. $imagem .'"
										/>
									</a>
									
								</div>
								
							</div>
							';
							
						}
						
					}
					
				?>
				
			</div>
			
		</div>
		
	</section>

	<script>

	function galeria_noticias_lightbox_abrir( lightbox ){
		
		let escurecer = document.querySelector('.galeria-noticias-escurecer');
		let lightbox_item = document.querySelector( '.'+ lightbox );
		
		escurecer.classList.add('on');
		lightbox_item.classList.add('on');
		
	}

	function galeria_noticias_lightbox_sair() {
		
		// Seleciona todos os elementos com a classe 'galeria-noticias-lightbox'
		const lightboxElements = document.querySelectorAll('.galeria-noticias-lightbox');

		// Remove a classe 'on' de cada um desses elementos
		lightboxElements.forEach(element => {
			element.classList.remove('on');
		});

		// Seleciona o elemento com a classe 'galeria-noticias-escurecer' (se houver mais de um, ajuste conforme necessário)
		const escurecerElement = document.querySelector('.galeria-noticias-escurecer');

		// Remove a classe 'on' do elemento, se ele existir
		if (escurecerElement) {
			escurecerElement.classList.remove('on');
		}
		
	}

	</script>

<?php } ?>
<!-- End - view/galeria-noticias.php !-->