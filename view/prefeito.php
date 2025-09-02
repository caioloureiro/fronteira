<!-- Start - view/prefeito.php !-->
<?php 

require 'model/prefeitos.php';

?>

<style><?php require 'css/prefeito.css'; ?></style>

<section class="prefeito" title="prefeito">
	
	<div class="box">
		
		<a href="galeria-de-prefeitos"><div class="voltar">voltar</div></a>
	
		<?php

			foreach( $prefeitos_array as $prefeito ){
				
				if( $prefeito['id'] == $_GET['id'] ){
					
					echo '
					<div class="prefeito-nome">'. $prefeito['nome'] .'</div>
					<div class="prefeito-foto" style="background-image:url( prefeitos/'. $prefeito['foto'] .' )"></div>
					<div class="prefeito-periodo">Período de atuação: <span class="prefeito-periodo-campo">'. data( $prefeito['data_ini'] ) .' <span class="material-symbols-outlined">arrow_right_alt</span> '. data( $prefeito['data_fim'] ) .'</span></div>
					<div class="prefeito-titulo"><span class="material-symbols-outlined">info_i</span> Sobre o(a) Prefeito(a)</div>
					<div class="prefeito-texto" id="ler_texto">'. $prefeito['texto'] .'</div>
					';
					
				}
				
			}
			
		?>
	
	</div>
	
</section>
<!-- End - view/prefeito.php !-->