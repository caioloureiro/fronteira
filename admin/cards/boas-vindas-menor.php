<!-- Start - cards/boas-vindas-menor.php !-->
<style><?php require 'css/boas-vindas-menor.css'; ?></style>

<section class="boas-vindas-menor" title="boas-vindas-menor">

	<div class="boas-vindas-menor-box">
		
		<div class="boas-vindas-menor-icone"><?php require 'img/sol.svg'; ?></div>
		<div class="boas-vindas-menor-titulo">Bem-vindo ao <?php echo $head_nome ?></div>
		<div class="boas-vindas-menor-txt">
			<p><?php echo $boas_vindas ?></p>
		</div>
		<div class="boas-vindas-menor-txt">
			<p>Versão: <?php echo $versao ?></p>
			<p>Release: <?php echo data_tempo( $release ) ?></p>
		</div>
	
	</div>

</section>
<!-- End - cards/boas-vindas-menor.php !-->