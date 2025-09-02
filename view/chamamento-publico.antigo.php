<!-- Start - view/chamamento-publico.php !-->
<?php

require 'model/chamamento_publico.php';

$chamamento_publico_array = array_reverse( $chamamento_publico_array );

$counterHTML =  'Nenhum item encontrado.';
$counter_diarios = 0;

foreach( $chamamento_publico_array as $count_item ){ $counter_diarios++; }

if( $counter_diarios == 1 ){
	$counterHTML = '1 item encontrado.';
}

if( $counter_diarios > 1 ){
	$counterHTML = $counter_diarios .' itens encontrados.';
}


?>

<style><?php require 'css/chamamento-publico.css'; ?></style>

<section class="chamamento-publico">
	
	<div class="box">
		
		<!-- 
		<div 
			class="chamamento-publico-filtro"
			title="Essa busca é reativa, basta apenas digitar para achar o resultado."
		>
			
			<div class="chamamento-publico-filtro-titulo">BUSCA DETALHADA</div>
			
			<div class="chamamento-publico-filtro-campo">
				
				<div class="chamamento-publico-filtro-col01">
					
					<div class="chamamento-publico-filtro-label">Titulo</div>
					<div class="chamamento-publico-filtro-input">
						<input type="text" class="input_titulo" />
					</div>
					
				</div>
				
				<div class="chamamento-publico-filtro-col02">
					
					<div class="chamamento-publico-filtro-label">Data</div>
					<div class="chamamento-publico-filtro-input">
						<input type="text" class="input_data" />
					</div>
					
				</div>
				
				<div class="chamamento-publico-filtro-col02">
					
					<div class="chamamento-publico-filtro-label">Situação</div>
					<div class="chamamento-publico-filtro-input">
						<input type="text" class="input_situacao" />
					</div>
					
				</div>
				
			</div>
			
		</div>
		!-->
		
		<div class="chamamento-publico-counter"><?php echo $counterHTML ?></div>
	
		<div class="chamamento-publico-campo">
		
			<?php
				
				//dd( $chamamento_publico_array );
				
				foreach( $chamamento_publico_array as $item ){

					echo '
					<div class="chamamento-publico-item">
					
						<a 
							href="chamamento-publico-item&id='. $item['id'] .'" 
							target="_self"
						>
						
							<div class="col20">
								<div class="chamamento-publico-thumb-campo">
									<div class="chamamento-publico-thumb">
										<span class="material-symbols-outlined">campaign</span>
									</div>
								</div>
							</div>
							<div class="col80">
							
								<div class="chamamento-publico-linha">
								
									<div class="chamamento-publico-titulo"><span>'. $item['titulo'] .'</span></div>
									
									<div class="chamamento-publico-btn">
										<div class="chamamento-publico-btn-icone">
											<span class="material-symbols-outlined">download</span>
										</div>
										<div class="chamamento-publico-btn-nome">Acessar</div>
									</div>
									
								</div>
								
								<div class="chamamento-publico-linha dados">
									<div class="chamamento-publico-dado">
										<div class="chamamento-publico-dado-icone">
											<span class="material-symbols-outlined">calendar_month</span>
										</div>
										<div class="chamamento-publico-dado-item"><strong>Postagem:</strong> '. data_tempo( $item['data'] ) .'</div>
									</div>
									<div class="chamamento-publico-dado">
										<div class="chamamento-publico-dado-icone">
											<span class="material-symbols-outlined">info</span>
										</div>
										<div class="chamamento-publico-dado-item"><strong>Situação:</strong> '. $item['situacao'] .'</div>
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
<!-- End - view/chamamento-publico.php !-->