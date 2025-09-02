<!-- Start - view/footer.php !-->
<?php 
require 'model/redes_sociais.php'; 
?>

<style><?php require 'css/footer.css'; ?></style>

<footer class="footer">

	<div class="footer-quadrado01"></div>
	<div class="footer-quadrado02"></div>
	
	<div class="box">
		
		<div class="footer-col">
		
			<a href="./">
				<div 
					class="footer-logo"
					style="background-image: url(<?= $logo ?>);"
				></div>
			</a>
			
			<?php
				
				foreach( $redes_sociais_array as $rede ){

					echo '
					<div 
						class="footer-redes"
						style="background-image:url( img/'. $rede['imagem'] .' )"
					>
						<a 
							href="'. $rede['link'] .'" 
							target="_blank"
						></a>
					</div>
					';
					
				}
				
			?>
			
		</div>
		
		<div class="footer-campo">
			
			<div class="footer-item">
				<div class="footer-titulo">PREFEITURA</div>
				<div class="footer-txt"><?php echo $endereco ?></div>
			</div>
			
			<div class="footer-item">
				<div class="footer-titulo">ATENDIMENTO</div>
				<div class="footer-txt"><?php echo $atendimento ?></div>
			</div>
			
			<div class="footer-item">
				<div class="footer-titulo">CONTATO</div>
				<div class="footer-txt"><a href="mailto:<?php echo $email ?>" target="_blank"><?php echo $email ?></a><br/> <a href="tel:<?php echo $telefone ?>" target="_blank"><?php echo $telefone ?></a></div>
			</div>
			
			<div class="footer-item">
				<a href="newsletter">
					<div class="footer-titulo">NEWSLETTER</div>
					<div class="footer-txt">Inscreva-se e receba nossos informativos em seu e-mail</div>
				</a>
			</div>
			
		</div>
		
	</div>
	
	<div class="footer-copyright">
		<div class="footer-copyright-box">
			<div class="footer-copyright-txt">© Copyrights - <?php echo date('Y') ?>. Todos os direitos reservados - AI Brazil</div>
			<div class="footer-copyright-logo" style="background-image:url( img/aibrazil-logo.png )"></div>
		</div>
	</div>

</footer>
<!-- End - view/footer.php !-->