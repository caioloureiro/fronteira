<!-- Start - admin/modulos/view/preview.php !-->
<style>
.col05 span,
.col10 span,
.col15 span,
.col16 span,
.col20 span,
.col25 span,
.col30 span,
.col33 span,
.col35 span,
.col40 span,
.col45 span,
.col50 span,
.col55 span,
.col60 span,
.col65 span,
.col66 span,
.col70 span,
.col75 span,
.col80 span,
.col85 span,
.col90 span,
.col95 span,
.col100 span,
.col05 a,
.col10 a,
.col15 a,
.col16 a,
.col20 a,
.col25 a,
.col30 a,
.col33 a,
.col35 a,
.col40 a,
.col45 a,
.col50 a,
.col55 a,
.col60 a,
.col65 a,
.col66 a,
.col70 a,
.col75 a,
.col80 a,
.col85 a,
.col90 a,
.col95 a,
.col100 a{
width:100%;
height:100%;
display:block;
vertical-align: unset;
}
/*End - GRID*/
</style>

<div class="lightbox preview" style="z-index:999999">

	<div class="lightbox-titulo">

		Preview
		<div class="lightbox-fechar" onClick="fechar_preview()" style="background-image:url( <?php echo $raiz_site ?>img/fechar.svg );" ></div>
		
	</div>
	
	<div class="lightbox-campo">
		
		<div class="linha linha-auto">
			
			<div class="col100">
				
				<div class="preview_iframe">
					
					<style><?php require $raiz_site .'css/conteudo-titulo.css'; ?></style>
					
					<section class="conteudo-titulo">
	
						<div class="preview-box">
							<div class="conteudo-titulo-campo preview_titulo">Pré visualização da notícia</div>
						</div>
						
					</section>
					
					<style><?php require $raiz_site .'css/breadcrumb.css'; ?></style>

					<section class="breadcrumb">
						
						<div class="preview-box">
							
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
								
								<div class="breadcrumb-btn-final">
									<div class="breadcrumb-btn-final-inclinado">
										<div class="breadcrumb-btn-final-txt preview_breadcrumb">Teste</div>
									</div>
								</div>
								
							</div>
							
						</div>
						
					</section>
					
					<style><?php require $raiz_site .'css/noticia.css'; ?></style>

					<section class="noticia">
						
						<div class="preview-box">

							<div class="noticia-campo" id="ler_texto">
								
								<div class="noticia-linha">
									<div class="col10 noticia-realce">Publicação:</div>
									<div class="col40 preview_publicacao"><?php echo data_tempo( $hoje ) ?></div>
									<!--
									<div class="col10 noticia-realce">Atualização:</div>
									<div class="col40">26/12/2024</div>
									!-->
									
								</div>
								<div class="noticia-linha">
									<div class="col10 noticia-realce">Categorias:</div>
									<div class="col90 preview_categorias">
										<div class="noticia-categoria preview_categorias">Educação</div>
										<div class="noticia-categoria preview_categorias">Esportes</div>
										<div class="noticia-categoria preview_categorias">...</div>
									</div>
								</div>
								<div class="noticia-linha">
									<div class="col100">
										
										<a 
											href="<?php echo $raiz_site ?>noticias-img/2024-07-26-11-03-17-obras.jpg" 
											target="_blank"
											class="preview_img_link"
										>
											<img 
												src="<?php echo $raiz_site ?>noticias-img/2024-07-26-11-03-17-obras.jpg" 
												class="noticia-img preview_img" 
											/>

											<div class="noticia-legenda preview_legenda">Legenda foto</div>
											
										</a>
										
									</div>
								</div>
								
								<div class="noticia-titulo"><span class="preview_subtitulo">Subtítulo da notícia</span></div>
								
								<div class="noticia-descricao preview_texto"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultrices condimentum sem, quis sollicitudin dolor laoreet rutrum. Vivamus in tristique neque. Ut eu lectus enim. Nullam nisi nulla, scelerisque at aliquet sed, tincidunt convallis dolor. Integer porta risus et nisl consequat, nec ultricies felis facilisis. Phasellus bibendum arcu sodales enim rutrum lobortis. Maecenas blandit felis tincidunt ornare ornare. Praesent dapibus nunc lorem, ut volutpat sapien varius vel. Praesent aliquet enim id eros auctor suscipit. Aliquam sit amet nisl nulla. Sed a luctus ligula. Mauris dolor est, varius sed quam sed, ullamcorper eleifend nunc. Quisque imperdiet leo sit amet tellus semper mollis. Nullam ipsum ante, tempor eu sollicitudin at, accumsan placerat eros. Phasellus quis eleifend eros. In tempor neque dui, vitae consectetur diam porta vitae.</p></div>
								
							</div>
							
						</div>
						
					</section>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

</div>
<!-- End - admin/modulos/view/preview.php !-->