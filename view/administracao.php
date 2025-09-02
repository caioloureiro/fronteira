<!-- Start - view/administracao.php !-->
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

foreach( $administracao_array as $item ){
	
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

<style><?php require 'css/administracao.css'; ?></style>

<section class="administracao">
	
	<div class="box">
		
		<div class="administracao-campo" id="ler_texto">
		
			<div class="administracao-col">
				<?php
					
					if( $sec_secretario != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">person</span></div>
							<div class="administracao-txt"><span>'. $sec_secretario .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_telefone != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">call</span></div>
							<div class="administracao-txt"><span>Telefone: <a href="tel:'. $sec_telefone .'" target="_blank">'. $sec_telefone .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_endereco != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">location_on</span></div>
							<div class="administracao-txt"><span>'. $sec_endereco .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_site != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">language</span></div>
							<div class="administracao-txt"><span><a href="'. $sec_site .'" target="_blank">'. $sec_site .'</a></span></div>
						</div>
						';
						
					}
					
				?>
				
			</div>
			
			<div class="administracao-col">
				
				<?php
					
					if( $sec_horario != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">schedule</span></div>
							<div class="administracao-txt"><span>Funcionamento: '. $sec_horario .'</span></div>
						</div>
						';
						
					}
					
					if( $sec_email != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone"><span class="material-symbols-outlined">mail</span></div>
							<div class="administracao-txt"><span><a href="mailto:'. $sec_email .'" target="_blank">'. $sec_email .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_facebook != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone">'; require 'img/facebook.svg'; echo'</div>
							<div class="administracao-txt"><span><a href="'. $sec_facebook .'" target="_blank">'. $sec_facebook .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_instagram != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone">'; require 'img/instagram.svg'; echo'</div>
							<div class="administracao-txt"><span><a href="'. $sec_instagram .'" target="_blank">'. $sec_instagram .'</a></span></div>
						</div>
						';
						
					}
					
					if( $sec_twitter != '' ){
						
						echo'
						<div class="administracao-item">
							<div class="administracao-icone">'; require 'img/twitter-x.svg'; echo'</div>
							<div class="administracao-txt"><span><a href="'. $sec_twitter .'" target="_blank">'. $sec_twitter .'</a></span></div>
						</div>
						';
						
					}
					
				?>
				
			</div>
			
		</div>
		<div class="administracao-img" style="background-image: url( administracao/<?php echo $sec_foto ?> )"></div>
		
		<?php
			
			if(  $sec_texto != '' ){
				
				echo'<div class="administracao-html">'. $sec_texto .'</div>';
				
			}
			
		?>
		
		<?php
			
			if(  $sec_localizacao != '' ){
				
				echo'<div class="administracao-mapa">'. $sec_localizacao .'</div>';
				
			}
			
		?>
		
		
	</div>
	
</section>
<!-- End - view/administracao.php !-->