<!-- Start - view/arquivos-destaque.php !-->
<?php require 'model/downloads.php'; ?>

<style>
	<?php 
		require 'css/home-titulo.css'; 
		require 'css/arquivos-destaque.css'; 
	?>
</style>

<section class="arquivos-destaque">
	
	<div class="box">
		
		<div class="home-titulo-campo">
			<div class="home-titulo-icone"><span class="material-symbols-outlined">download</span></div>
			<div class="home-titulo">Arquivos Destaque</div>
			<a href="downloads"><?php require 'view/btnVerMais.php'; ?></a>
		</div>
		
		<?php
			
			if( count( $downloads_destaque_array ) > 0 ){
				
				echo'
				<div class="arquivos-destaque-carrossel">
					';
					
					$downloads_destaque_array = array_reverse( $downloads_destaque_array );
					
					$downloads_destaque_loop = 0;
				
					foreach( $downloads_destaque_array as $item ){
						
						if( $downloads_destaque_loop <= 10 ){
							
							$downloads_destaque_loop++;

							echo'
							<div class="arquivos-destaque-item">
								<a 
									href="arquivos/'. $item['arquivo'] .'" 
									target="_blank"
								>
									<div class="arquivos-destaque-data">'. data_tempo( $item['data'] ) .'</div>
									<div class="arquivos-destaque-titulo">'. $item['nome'] .'</div>
									<div class="arquivos-destaque-campo">
										<div 
											class="
												arquivos-destaque-icone 
												'; 
												
												if( $item['tipo'] == 'pdf' ){ echo'pdf'; } 
												if( $item['tipo'] == 'zip' ){ echo'zip'; } 
												
												echo'
											"
										></div>
										<div class="arquivos-destaque-tipo">
											'; 
											
											if( $item['tipo'] == 'pdf' ){ echo'Arquivo PDF'; } 
											if( $item['tipo'] == 'zip' ){ echo'Arquivo ZIP'; } 
											
											echo'
										</div>
										<div class="arquivos-destaque-nuvem"><span class="material-symbols-outlined">cloud_download</span></div>
									</div>
								</a>
							</div>
							';
							
						}
						
					}
					
					echo'
				</div>
				';
				
			}
			else{
				
				echo'
				<div class="col100">Nenhum arquivo encontrado.</div>
				';
				
			}
			
		?>
		
	</div>
	
</section>

<script>

let arquivos_destaque_carrossel = document.querySelector('.arquivos-destaque-carrossel');

let arquivos_destaque_carrossel_flickity = new Flickity( arquivos_destaque_carrossel, {

	cellAlign: 'left',
	contain: true,
	prevNextButtons: true,
	pageDots: true,
	wrapAround: true,
	initialIndex: 1,
	autoPlay: 7000
  
});

</script>
<!-- End - view/arquivos-destaque.php !-->