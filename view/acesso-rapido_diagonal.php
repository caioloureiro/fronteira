<!-- Start - view/acesso-rapido.php !-->
<?php require 'model/acesso_rapido.php'; ?>

<style><?php require 'css/acesso-rapido.css'; ?></style>

<section class="acesso-rapido" title="acesso-rapido">
	
	<div class="box">
		
		<div class="home-titulo-campo">
			<div class="home-titulo-icone"><span class="material-symbols-outlined">more_time</span></div>
			<div class="home-titulo">Acesso Rápido</div>
		</div>
		
		<div class="acesso-rapido-campo">
			
			<?php
				
				foreach( $acesso_rapido_array as $item ){

					echo'
					<div class="acesso-rapido-btn">
						<a href="'. $item['link'] .'" target="'. $item['target'] .'">
							<div class="acesso-rapido-icone" style="background-image:url( acesso-rapido/'. $item['icone'] .' )"></div>
							<div class="acesso-rapido-titulo-campo">
								<div class="acesso-rapido-titulo-grade">
									<span>
										<div class="acesso-rapido-titulo">'. $item['titulo'] .'</div>
										';
										
										if( $item['possui_texto'] == 1 ){
											
											echo'<div class="acesso-rapido-txt">'. $item['texto'] .'</div>';
											
										}
										
										echo'
									</span>
								</div>
							</div>
						</a>
					</div>
					';
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/acesso-rapido.php !-->