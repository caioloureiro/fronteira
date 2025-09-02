<div class="card">

	<a href="../" target="_blank">

		<div class="card-btn" title="Ir para página de notícias.">
			
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 543.906 543.906" aria-labelledby="title"><path d="M271.953 0C121.759 0 0 121.759 0 271.953s121.759 271.953 271.953 271.953 271.953-121.759 271.953-271.953S422.148 0 271.953 0zm45.041 76.316a31.943 31.943 0 0 1 3.231 0c14.724-.484 27.533 10.622 29.578 24.987 6.576 27.581-22.719 55.228-49.631 44.192-32.14-14.919-15.948-67.586 16.822-69.179zm-13.255 120.002c20.875-1.327 24.519 22.964 18.014 47.592-12.695 56.583-32.455 111.403-43.175 168.442 5.178 22.523 33.575-3.312 45.721-11.558 10.329-8.213 12.124 2.083 15.637 10.71-25.776 18.058-51.687 36.447-80.395 50.991-26.972 16.361-49.049-9.072-42.321-37.394 11.128-52.841 25.776-104.882 37.736-157.564 3.737-28.468-33.728.511-44.872 7.136-8.985 11.292-13.25 3.051-16.997-7.136 29.871-21.816 60.325-48.593 93.313-65.949 6.738-3.35 12.52-4.966 17.339-5.27z"></path></svg>
			
		</div>
		
	</a>

	<div class="card-noticias">
		
		<?php
			
			$pasta = '../img/banners';

			foreach( $carrossel_array as $item ){

				echo'
				<div class="card-noticias-item">
				
					<div
						class="card-noticias-img"
						style="background-image:url('. $pasta .'/'. $item['imagem'] .')"
						title="'. $item['titulo'] .'"
						alt="'. $item['titulo'] .'"
					></div>
						
					<div class="card-noticias-campo">

						<div class="card-noticias-campo-titulo">'. $item['titulo'] .'</div>
						<div class="card-noticias-campo-resumo">'. $item['texto'] .'</div>
						
					</div>
					
				</div>
				';
				
			}
			
		?>
		
	</div>

</div>