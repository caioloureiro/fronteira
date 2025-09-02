<!-- Start - view/preview_noticia.php !-->
<?php

$noticia_titulo = '';
$noticia_subtitulo = '';
$noticia_data_publicacao = '0000-00-00 00:00:00';
$noticia_data_atualizacao = '0000-00-00 00:00:00';
$noticia_imagem = '';
$noticia_utilidade_publica = '';
$noticia_categorias = '';
$noticia_texto = '';
$periodo_eleitoral = 0;
$noticia_legenda = '';

$noticia_categorias_array = array();

$hoje = date( 'Y-m-d H:i:s' );

//dd( $_GET );

if( isset( $_GET['imagem'] ) ){ $noticia_imagem = $_GET['imagem']; }

?>

<style><?php require 'css/conteudo-titulo.css'; ?></style>

<section class="conteudo-titulo">
	
	<div class="box">
		
		<?php echo $noticia_titulo ?>
		
	</div>
	
</section>

<style><?php require 'css/breadcrumb.css'; ?></style>

<section class="breadcrumb">
	
	<div class="box">
		
		<div class="breadcrumb-campo">
		
			<div class="breadcrumb-btn-inicio">
				<a href="./">
					<div class="breadcrumb-btn-inicio-inclinado">
						<div class="breadcrumb-btn-inicio-txt">Principal</div>
					</div>
				</a>
			</div>
			
			<div class="breadcrumb-btn-meio">
				<a href="news">
					<div class="breadcrumb-btn-meio-inclinado">
						<div class="breadcrumb-btn-meio-txt">Notícias</div>
					</div>
				</a>
			</div>
			
			<?php 
			
				echo '
				<div class="breadcrumb-btn-final">
					<div class="breadcrumb-btn-final-inclinado">
						<div class="breadcrumb-btn-final-txt">'. $noticia_titulo .'</div>
					</div>
				</div>
				';
				
			?>
			
			
		</div>
		
	</div>
	
</section>

<style><?php require 'css/noticia.css'; ?></style>

<section class="noticia">
	
	<div class="box">
		
		<div id="output">Aguardando parâmetros...</div>
		
		<?php 

			echo'
			<div class="noticia-campo" id="ler_texto">
				
				<div class="noticia-linha">
					<div class="col10 noticia-realce">Publicação:</div>
					<div class="col40">'. data_tempo( $noticia_data_publicacao ) .'</div>
					
					';
				
						if( $noticia_data_publicacao != $noticia_data_atualizacao ){
							
							echo'
							<div class="col10 noticia-realce">Atualização:</div>
							<div class="col40">'. data_tempo( $noticia_data_atualizacao ) .'</div>
							';
							
						}
						
					echo'
					
				</div>
				<div class="noticia-linha">
					<div class="col10 noticia-realce">Categorias:</div>
					<div class="col90">
						';
						
						foreach( $noticia_categorias_array as $cat ){

							echo'
							<div class="noticia-categoria">'. $cat .'</div>
							';
							
						}
						
						echo'
					</div>
				</div>
				<div class="noticia-linha">
					<div class="col100">
						
						<a 
							href="noticias-img/'. $noticia_imagem .'" 
							target="_blank"
						>
							<img 
								src="noticias-img/'. $noticia_imagem .'" 
								class="noticia-img" 
							/>
							';
							
							if( $noticia_legenda != '' ){
								
								echo'<div class="noticia-legenda">'. $noticia_legenda .'</div>';
								
							}
							
							echo'
						</a>
						
					</div>
				</div>
			
				';
				
					if( $noticia_subtitulo != '' ){
						
						echo'<div class="noticia-titulo"><span>'. $noticia_subtitulo .'</span></div>';
						
					}
					
				echo'
				
				<div class="noticia-descricao">'. $noticia_texto .'</div>
				
			</div>
			';
			
		?>
		
	</div>
	
</section>
<!-- End - view/preview_noticia.php !-->