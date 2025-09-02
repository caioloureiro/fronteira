<!-- Start - view/conteudo.php !-->
<?php

$pagina = '';
$pagina_titulo = '';
$pagina_texto = '';
$pagina_info = '';
$pagina_representante = '';
$pagina_foto = '';
$pagina_telefone = '';
$pagina_endereco = '';
$pagina_email = '';
$pagina_horario = '';
$pagina_site = '';
$pagina_facebook = '';
$pagina_instagram = '';
$pagina_twitter = '';
$pagina_localizacao = '';

foreach( $paginas as $item ){
	
	if( $item['pagina'] == $_GET['pagina'] ){ 
	
		$pagina = $item['pagina'];
		$pagina_titulo = $item['titulo'];
		$pagina_texto = $item['texto'];
		$pagina_info = $item['info'];
		$pagina_representante = $item['representante'];
		$pagina_foto = $item['foto'];
		$pagina_telefone = $item['telefone'];
		$pagina_endereco = $item['endereco'];
		$pagina_email = $item['email'];
		$pagina_horario = $item['horario'];
		$pagina_site = $item['site'];
		$pagina_facebook = $item['facebook'];
		$pagina_instagram = $item['instagram'];
		$pagina_twitter = $item['twitter'];
		$pagina_localizacao = $item['localizacao'];
		
	}
	
}
	
?>		

<style><?php require 'css/conteudo.css'; ?></style>

<section class="conteudo">
	
	<div class="box" id="ler_texto">
		
		<?php
		
			if( $pagina_info == 1 ){
				
				echo'
				<div class="conteudo-col">
					';
					
					if( $pagina_representante != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">person</span></div>
							<div class="conteudo-txt"><span>'. $pagina_representante .'</span></div>
						</div>
						';
						
					}
					
					if( $pagina_telefone != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">call</span></div>
							<div class="conteudo-txt"><span>Telefone: <a href="tel:'. $pagina_telefone .'" target="_blank">'. $pagina_telefone .'</a></span></div>
						</div>
						';
						
					}
					
					if( $pagina_endereco != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">location_on</span></div>
							<div class="conteudo-txt"><span>'. $pagina_endereco .'</span></div>
						</div>
						';
						
					}
					
					if( $pagina_site != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">language</span></div>
							<div class="conteudo-txt"><span><a href="'. $pagina_site .'" target="_blank">'. $pagina_site .'</a></span></div>
						</div>
						';
						
					}
					
					echo'
				</div>
				
				<div class="conteudo-col">
					';
						
					if( $pagina_horario != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">schedule</span></div>
							<div class="conteudo-txt"><span>Funcionamento: '. $pagina_horario .'</span></div>
						</div>
						';
						
					}
					
					if( $pagina_email != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone"><span class="material-symbols-outlined">mail</span></div>
							<div class="conteudo-txt"><span><a href="mailto:'. $pagina_email .'" target="_blank">'. $pagina_email .'</a></span></div>
						</div>
						';
						
					}
					
					if( $pagina_facebook != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone">'; require 'img/facebook.svg'; echo'</div>
							<div class="conteudo-txt"><span><a href="'. $pagina_facebook .'" target="_blank">'. $pagina_facebook .'</a></span></div>
						</div>
						';
						
					}
					
					if( $pagina_instagram != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone">'; require 'img/instagram.svg'; echo'</div>
							<div class="conteudo-txt"><span><a href="'. $pagina_instagram .'" target="_blank">'. $pagina_instagram .'</a></span></div>
						</div>
						';
						
					}
					
					if( $pagina_twitter != '' ){
						
						echo'
						<div class="conteudo-item">
							<div class="conteudo-icone">'; require 'img/twitter-x.svg'; echo'</div>
							<div class="conteudo-txt"><span><a href="'. $pagina_twitter .'" target="_blank">'. $pagina_twitter .'</a></span></div>
						</div>
						';
						
					}
					echo'
				</div>
				';
				
			}

			if( $pagina_foto != '' ){
				
				echo'
				<div 
					class="conteudo-img '; if( $pagina_info == 0 ){ echo'centralizada'; } echo'" 
					style="background-image: url( img/'. $pagina_foto .' )"
				></div>
				';
				
			}
			
			if(  $pagina_texto != '' ){
				
				echo'<div class="conteudo-html">'. $pagina_texto .'</div>';
				
			}
			
			if( $pagina_localizacao != '' ){
				
				echo'<div class="conteudo-mapa">'. $pagina_localizacao .'</div>';
				
			}
			
		?>
		
	</div>
	
</section>
<!-- End - view/conteudo.php !-->