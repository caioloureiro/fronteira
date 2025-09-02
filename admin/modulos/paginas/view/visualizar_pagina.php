<div class="lightbox item-visualizar_pagina" style="z-index:99999">

	<div class="lightbox-titulo">

		Preview
		<div class="lightbox-fechar" onClick="fechar_lightbox()" style="background-image:url( <?php echo $raiz_site ?>img/fechar.svg );" ></div>
		
	</div>
	
	<div class="escolher-imagem-cards-box">
		
		<div class="linha linha-auto">
			
			<div class="col100">
				
				<iframe
					style="
						width:100%;
						height:33vw;
					"
					<?php
						
						foreach( $paginas as $getPag ){
					
							if( $getPag['id'] == $_GET['id'] ){

								echo 'src="../../../../'. $getPag['pagina'] .'"';
								
							}
							
						}
						
					?>
					
				></iframe>
				
			</div>
			
		</div>
		
	</div>

</div>