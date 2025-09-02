<!-- Start - view/conteudo-compartilhar.php !-->
<?php

//$compartilhar_url = 'https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$compartilhar_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<style><?php require 'css/conteudo-compartilhar.css'; ?></style>

<section class="conteudo-compartilhar">
	
	<div class="box">
		
		<div class="conteudo-compartilhar-campo">
			
			<div class="conteudo-compartilhar-titulo">Compartilhar</div>
			<div class="conteudo-compartilhar-btn"><span class="material-symbols-outlined">share</span></div>
			<div class="conteudo-compartilhar-btn facebook" title="Facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $compartilhar_url ?>" target="_blank"><?php require 'img/facebook.svg'; ?></a></div>
			<div class="conteudo-compartilhar-btn twitter" title="Twitter - X"><a href="https://x.com/intent/post?url=<?php echo $compartilhar_url ?>" target="_blank"><?php require 'img/twitter-x.svg'; ?></a></div>
			<div class="conteudo-compartilhar-btn whatsapp" title="Whatsapp"><a href="https://wa.me?text=<?php echo $compartilhar_url ?>" target="_blank" data-action="share/whatsapp/share"><?php require 'img/whatsapp.svg'; ?></a></div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/conteudo-compartilhar.php !-->