<!-- Start - view/acesso-facil.php !-->
<?php 

require 'model/acesso_facil_base.php'; 
require 'model/acesso_facil.php'; 
	
?>

<style><?php require 'css/acesso-facil.css'; ?></style>

<section class="acesso-facil">
	
	<div class="box">
		
		<?php
			
			foreach( $acesso_facil_base_array as $acesso_base ){

				echo'
				<div class="acesso-facil-item acesso_facil_item_'. $acesso_base['id'] .'">
					<div class="acesso-facil-campo">
						<div class="acesso-facil-fundo">'; require 'img/'. $acesso_base['icone']; echo'</div>
						<div class="acesso-facil-titulo"><span>'. $acesso_base['nome'] .'</span></div>
						<div class="acesso-facil-icone"><span class="material-symbols-outlined">keyboard_double_arrow_down</span></div>
					</div>
					<div class="acesso-facil-gaveta">
						
						';
							
							foreach( $acesso_facil_array as $item ){
			
								if( $item['pai'] == $acesso_base['id'] ){
									
									echo'
									<div class="acesso-facil-gaveta-btn">
										<a href="'. $item['link'] .'" target="'. $item['target'] .'">
											<span class="material-symbols-outlined">'. $item['icone'] .'</span> 
											'. $item['nome'] .'
										</a>
									</div>
									';
									
								}
								
							}
							
						echo'
						
					</div>
				</div>
				';
				
			}
			
		?>
		
	</div>
	
</section>

<section class="acesso-facil-mobile">
	
	<div class="box">
		
		<?php
			
			foreach( $acesso_facil_base_array as $acesso_base ){

				echo'
				<div class="acesso-facil-mobile-item">
				
					<div 
						class="
							acesso-facil-mobile-campo 
							acesso_facil_mobile_item_'. $acesso_base['id'] .'_campo
						"
					>
						<div class="acesso-facil-mobile-fundo">'; require 'img/'. $acesso_base['icone']; echo'</div>
						<div class="acesso-facil-mobile-titulo"><span>'. $acesso_base['nome'] .'</span></div>
						<div class="acesso-facil-mobile-icone"><span class="material-symbols-outlined">keyboard_double_arrow_down</span></div>
					</div>
					
					<div 
						class="
							acesso-facil-mobile-gaveta 
							acesso_facil_mobile_item_'. $acesso_base['id'] .'_gaveta
						"
					>
						
						';
							
							foreach( $acesso_facil_array as $item ){
			
								if( $item['pai'] == $acesso_base['id'] ){
									
									echo'
									<div class="acesso-facil-mobile-gaveta-btn">
										<a href="'. $item['link'] .'" target="'. $item['target'] .'">
											<span class="material-symbols-outlined">'. $item['icone'] .'</span> 
											'. $item['nome'] .'
										</a>
									</div>
									';
									
								}
								
							}
							
						echo'
						
					</div>
					
				</div>
				
				<script>
					
					let acesso_facil_mobile_item_'. $acesso_base['id'] .'_campo = document.querySelector(".acesso_facil_mobile_item_'. $acesso_base['id'] .'_campo");
					let acesso_facil_mobile_item_'. $acesso_base['id'] .'_gaveta = document.querySelector(".acesso_facil_mobile_item_'. $acesso_base['id'] .'_gaveta");
					
					acesso_facil_mobile_item_'. $acesso_base['id'] .'_campo.addEventListener("click", function() {
						
						acesso_facil_mobile_item_'. $acesso_base['id'] .'_campo.classList.toggle("ativo");
						acesso_facil_mobile_item_'. $acesso_base['id'] .'_gaveta.classList.toggle("ativo");
						
					});
					
				</script>
				';
				
			}
			
		?>
		
	</div>
	
</section>
<!-- End - view/acesso-facil.php !-->