<!-- Start - view/diario-oficial.php !-->
<?php

require 'model/diario_oficial.php';

$diario_oficial_array = array_reverse( $diario_oficial_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $diario_oficial_array as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}


?>

<style><?php require 'css/diario-oficial.css'; ?></style>

<section class="diario-oficial">
	
	<div class="box">
		
		<div 
			class="diario-oficial-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="diario-oficial-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="diario-oficial-filtro-campo">
				
				<div class="diario-oficial-filtro-col01">
					
					<div class="diario-oficial-filtro-label">Titulo</div>
					<div class="diario-oficial-filtro-input">
						<input type="text" class="input_titulo" />
					</div>
					
				</div>
				
				<div class="diario-oficial-filtro-col02">
					
					<div class="diario-oficial-filtro-label">Edição</div>
					<div class="diario-oficial-filtro-input">
						<input type="text" class="input_edicao" />
					</div>
					
				</div>
				
				<div class="diario-oficial-filtro-col03">
					
					<div class="diario-oficial-filtro-label">Data</div>
					<div class="diario-oficial-filtro-input">
						<input type="text" class="input_data" />
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="diario-oficial-counter"><?php echo $counterHTML ?></div>
	
		<div class="diario-oficial-campo">
		
			<?php
				
				foreach( $diario_oficial_array as $item ){

					echo '
					<div class="diario-oficial-item">
					
						<a 
							href="'. $item['arquivo'] .'" 
							target="_blank"
						>
						
							<div class="col20">
								<div class="diario-oficial-thumb-campo">
									<div class="diario-oficial-thumb"></div>
								</div>
							</div>
							<div class="col80">
							
								<div class="diario-oficial-linha">
								
									<div class="diario-oficial-titulo">'. $item['titulo'] .'</div>
									
									<div class="diario-oficial-icone" title="Assinado digitalmente">
										<span class="material-symbols-outlined">key</span>
									</div>
									';
									
									if( $item['edicao_extra'] == 1 ){
										
										echo'
										<div class="diario-oficial-extra">
											<div class="diario-oficial-extra-icone">
												<span class="material-symbols-outlined">asterisk</span>
											</div>
											<div class="diario-oficial-extra-nome">Edição extra</div>
										</div>
										';
										
									}
									
									echo'
									<div class="diario-oficial-btn">
										<div class="diario-oficial-btn-icone">
											<span class="material-symbols-outlined">download</span>
										</div>
										<div class="diario-oficial-btn-nome">Acessar</div>
									</div>
									
								</div>
								
								<div class="diario-oficial-linha dados">
									<div class="diario-oficial-dado">
										<div class="diario-oficial-dado-icone">
											<span class="material-symbols-outlined">calendar_month</span>
										</div>
										<div class="diario-oficial-dado-item"><strong>Postagem:</strong> '. data_tempo( $item['data'] ) .'</div>
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
<!-- End - view/diario-oficial.php !-->