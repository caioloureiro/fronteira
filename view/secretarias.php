<!-- Start - view/secretarias.php !-->
<?php

$sec_pagina = '';
$sec_titulo = '';
$sec_secretario = '';
$sec_foto = '';
$sec_telefone = '';
$sec_endereco = '';
$sec_email = '';
$sec_horario = '';
$sec_localizacao = '';
$sec_texto = '';
$sec_site = '';
$sec_facebook = '';
$sec_instagram = '';
$sec_twitter = '';

foreach( $secretarias_array as $item ){
	
	if( $item['pagina'] == $_GET['secretaria'] ){
		
		$sec_pagina = $item['pagina'];
		$sec_titulo = $item['titulo'];
		$sec_secretario = $item['secretario'];
		$sec_foto = $item['foto'];
		$sec_telefone = $item['telefone'];
		$sec_endereco = $item['endereco'];
		$sec_email = $item['email'];
		$sec_horario = $item['horario'];
		$sec_localizacao = $item['localizacao'];
		$sec_texto = $item['texto'];
		$sec_site = $item['site'];
		$sec_facebook = $item['facebook'];
		$sec_instagram = $item['instagram'];
		$sec_twitter = $item['twitter'];
		
	}

}

?>

<style><?php require 'css/secretarias.css'; ?></style>

<section class="secretarias">
	
	<div class="box">
		
		<div class="secretarias-campo" id="ler_texto">
		
			<div class="secretarias-col">
				<?php
					
					if( $sec_secretario != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">person</span></div>
							<div class="secretarias-txt"><span>'. $sec_secretario .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_telefone != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">call</span></div>
							<div class="secretarias-txt"><span>Telefone: <a href="tel:'. $sec_telefone .'" target="_blank">'. $sec_telefone .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_endereco != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">location_on</span></div>
							<div class="secretarias-txt"><span>'. $sec_endereco .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_site != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">language</span></div>
							<div class="secretarias-txt"><span><a href="'. $sec_site .'" target="_blank">'. $sec_site .'</a></span></div>
						</div>
						';
						
					}
					
				?>
				
			</div>
			
			<div class="secretarias-col">
				
				<?php
					
					if( $sec_horario != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">schedule</span></div>
							<div class="secretarias-txt"><span>Funcionamento: '. $sec_horario .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_email != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone"><span class="material-symbols-outlined">mail</span></div>
							<div class="secretarias-txt"><span><a href="mailto:'. $sec_email .'" target="_blank">'. $sec_email .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_facebook != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone">'; require 'img/facebook.svg'; echo'</div>
							<div class="secretarias-txt"><span><a href="'. $sec_facebook .'" target="_blank">'. $sec_facebook .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_instagram != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone">'; require 'img/instagram.svg'; echo'</div>
							<div class="secretarias-txt"><span><a href="'. $sec_instagram .'" target="_blank">'. $sec_instagram .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_twitter != '' ){
						
						echo'
						<div class="secretarias-item">
							<div class="secretarias-icone">'; require 'img/twitter-x.svg'; echo'</div>
							<div class="secretarias-txt"><span><a href="'. $sec_twitter .'" target="_blank">'. $sec_twitter .'</a></span></div>
						</div>
						';
						
					}
					
				?>
				
			</div>
			
		</div>
		<div class="secretarias-img" style="background-image: url( secretarias/<?php echo $sec_foto ?> )"></div>
		
		<?php
			
			if(  $sec_texto != '' ){
				
				echo'<div class="secretarias-html">'. $sec_texto .'</div>';
				
			}
			
		?>
		
		<?php
			
			if(  $sec_localizacao != '' ){
				
				echo'<div class="secretarias-mapa">'. $sec_localizacao .'</div>';
				
			}
			
		?>
		
		
	</div>
	
</section>
<!-- End - view/secretarias.php !-->