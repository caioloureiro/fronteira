<!-- Start - view/cemiterios.php !-->
<?php 

require 'model/cemiterios.php';

foreach( $paginas_fixas as $item ){
	
	if( $item['pagina'] == $_GET['pagina'] ){ 
		$conteudo_texto = $item['texto']; 
	}
	
}
	
?>

<style><?php require 'css/cemiterios.css'; ?></style>

<section class="cemiterios">
	
	<div class="box">
		
		<?php
		
			foreach( $cemiterios_array as $cem ){

				echo '
				<div class="cemiterios-item">
					<div class="cemiterios-nome">
						<span>'. $cem['cemNome'] .'</span>
					</div>
					<div class="cemiterios-campo">
						<span>
						
							<div class="cemiterios-titulo">Endereço:</div>
							<div class="cemiterios-txt">'. $cem['cemEndereco'] .'</div>
							';
							
							if( $cem['cemTelefone'] != '' ){
								echo'
								<div class="cemiterios-titulo">Telefone:</div>
								<div class="cemiterios-txt">'. $cem['cemTelefone'] .'</div>
								';
							}
							
							if( $cem['cemEmail'] != '' ){
								echo'
								<div class="cemiterios-titulo">E-mail:</div>
								<div class="cemiterios-txt">'. $cem['cemEmail'] .'</div>
								';
							}
							
							echo'
							
						</span>
					</div>
				</div>
				';
				
			}
			
		?>
		
		<div class="cemiterios-btn"><?php echo $conteudo_texto ?></div>
		
	</div>
	
</section>
<!-- End - view/cemiterios.php !-->