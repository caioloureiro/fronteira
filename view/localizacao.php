<!-- Start - view/localizacao.php !-->
<style><?php require 'css/localizacao.css'; ?></style>

<section class="localizacao">
	
	<div class="box">
	
		<span id="ler_texto">
			<?= $pagina['texto'] ?>
			<p>Endereço: <?= $endereco ?></p>
			<p>Atendimento: <?= $atendimento ?></p>
			<p>E-mail: <a href="mailto:<?php echo $email ?>"><?= $email ?></a></p>
			<p>Telefone: <?= $telefone ?></p>
		</span>
		
		<div class="mapa">
			
			<iframe 
				className="mapa-iframe"
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d456.3941440888076!2d-49.20451894149502!3d-20.285331803260057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94bcc2b3526d8bbf%3A0x2403820926aedba5!2sPrefeitura%20Municipal%20de%20Fronteira!5e1!3m2!1spt-BR!2sbr!4v1756832439536!5m2!1spt-BR!2sbr" 
				loading="lazy" 
				referrerpolicy="no-referrer-when-downgrade"
			></iframe>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/localizacao.php !-->