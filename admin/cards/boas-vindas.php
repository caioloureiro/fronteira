<!-- Start - cards/boas-vindas.php !-->
<style><?php require 'css/boas-vindas.css'; ?></style>

<section class="boas-vindas" title="boas-vindas">

	<div class="boas-vindas-box">
		
		<div class="boas-vindas-icone"><?php require 'img/sol.svg'; ?></div>
		<div class="boas-vindas-titulo">Bem-vindo ao <?php echo $head_nome ?></div>
		<div class="boas-vindas-txt">
			<p><?php echo $boas_vindas ?></p>
		</div>
		<div class="boas-vindas-txt">
			<p>Versão: <?php echo $versao ?></p>
			<p>Release: <?php echo data_tempo( $release ) ?></p>
		</div>
	
	</div>

</section>
<!-- End - cards/boas-vindas.php !-->