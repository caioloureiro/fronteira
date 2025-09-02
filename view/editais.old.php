<!-- Start - view/editais.php !-->
<?php

require 'model/editais.php';

$editais_array = array_reverse( $editais_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $editais_array as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}


?>

<style><?php require 'css/editais.css'; ?></style>

<section class="editais">
	
	<div class="box">
		
		<div 
			class="editais-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="editais-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="editais-filtro-campo">
				
				<div class="editais-filtro-col01">
					
					<div class="editais-filtro-label">Titulo</div>
					<div class="editais-filtro-input">
						<input type="text" class="input_titulo" />
					</div>
					
				</div>
				
				<div class="editais-filtro-col02">
					
					<div class="editais-filtro-label">Edição</div>
					<div class="editais-filtro-input">
						<input type="text" class="input_edicao" />
					</div>
					
				</div>
				
				<div class="editais-filtro-col03">
					
					<div class="editais-filtro-label">Data</div>
					<div class="editais-filtro-input">
						<input type="text" class="input_data" />
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="editais-counter"><?php echo $counterHTML ?></div>
	
		<div class="editais-campo">
		
			<?php
				
				foreach( $editais_array as $item ){

					echo '
					<div class="editais-item">
					
						<a 
							href="editais/'. $item['arquivo'] .'" 
							target="_blank"
						>
						
							<div class="col20">
								<div class="editais-thumb-campo">
									<div class="editais-thumb">
										<span class="material-symbols-outlined">picture_as_pdf</span>
									</div>
								</div>
							</div>
							<div class="col80">
							
								<div class="editais-linha">
								
									<div class="editais-titulo"><span>'. $item['nome'] .'</span></div>
									
									<div class="editais-btn">
										<div class="editais-btn-icone">
											<span class="material-symbols-outlined">download</span>
										</div>
										<div class="editais-btn-nome">Acessar</div>
									</div>
									
								</div>
								
								<div class="editais-linha dados">
									<div class="editais-dado">
										<div class="editais-dado-icone">
											<span class="material-symbols-outlined">calendar_month</span>
										</div>
										<div class="editais-dado-item"><strong>Postagem:</strong> '. $item['data'] .'</div>
									</div>
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
<!-- End - view/editais.php !-->