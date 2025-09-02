<?php

require "model/periodo_eleitoral.php";
$periodo_eleitoral = 0;
foreach( $periodo_eleitoral_array as $per ){
	
	$periodo_eleitoral = $per['ativado'];
	
}

require "model/popup.php";
$popup = 0;
foreach( $popup_array as $pop ){
	
	$popup = $pop['ativado'];
	
}

require "view/cabecalho.php";
require "view/flickity.php";
require "view/carrossel.php";
require "view/acesso-facil.php";
require "view/home-noticias.php";
//if( $periodo_eleitoral == 0 ){ require "view/arquivos-destaque.php"; }
require "view/acesso-rapido.php";
//if( $periodo_eleitoral == 0 ){ require "view/editais-destaque.php"; }
//require "view/banner.php";
if( $periodo_eleitoral == 0 ){ require "view/home-galeria.php"; }
if( $periodo_eleitoral == 0 ){ require "view/home-videos.php"; }
require "view/tempo.php";
//require "view/banner-provisorio.php";
require "view/footer.php";
require "view/popup.php";
//require "view/home-base.php";

?>