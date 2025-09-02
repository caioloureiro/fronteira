<!-- Start - view/editais-destaque.php !-->
<?php 
require 'model/editais.php'; 
require 'model/downloads.php'; 

$count_editais = 0;
?>

<style><?php require 'css/editais-destaque.css'; ?></style>

<section class="editais-destaque">
	
	<div class="box">
		
		<div class="home-titulo-campo">
			<div class="home-titulo-icone"><span class="material-symbols-outlined">quick_reference</span></div>
			<div class="home-titulo">Editais em destaque</div>
			<a href="editais"><?php require 'view/btnVerMais.php'; ?></a>
		</div>
	
		<div class="editais-destaque-campo">
			
			<?php
				
				$pasta = 'arquivos/';
				
				foreach( $editais_array as $edital ){
					
					if( $edital['destaque'] == 1 ){
						
						$arquivo = '#';
						
						foreach( $downloads_array as $download ){
							
							if( $download['id'] == $edital['modalidade_arquivo_id'] ){
								
								$arquivo = $download['arquivo'];
								
							}
							
						}
						
						echo '
						<div class="editais-destaque-item">
							<a href="'. $pasta . $arquivo .'" target="_blank">
								<div class="editais-destaque-item-icone"><span class="material-symbols-outlined">description</span></div>
								<div class="editais-destaque-item-campo">
									<div class="editais-destaque-item-linha">
										<div class="editais-destaque-item-nome"><span>'. $edital['nome'] .'</span></div>
									</div>
								</div>
							</a>
						</div>
						';
						
						$count_editais++;
						
					}
					
				}
				
				if( $count_editais == 0 ){
					
					echo '
					<div class="editais-destaque-item">
						<div class="editais-destaque-item-icone"><span class="material-symbols-outlined">description</span></div>
						<div class="editais-destaque-item-campo">
							<div class="editais-destaque-item-linha">
								<div class="editais-destaque-item-nome"><span>Nenhum edital destacado.</span></div>
							</div>
						</div>
					</div>
					';
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/editais-destaque.php !-->