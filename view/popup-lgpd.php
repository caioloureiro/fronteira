<!-- Start - view/popup-lgpd.php !-->
<style><?php require 'css/popup-lgpd.css'; ?></style>

<?php
$link_politica_de_privacidade = 'privacidade';
?>

<div class="lgpd-invisivel on"></div>

<div class="lgpd on">

	<div class="lgpd-txt"><span>Utilizamos cookies e outras tecnologias para aprimorar sua navegação e experiência em nosso site, de acordo com a nossa Política de Privacidade e, ao continuar navegando, você concorda com estas condições. <a href="<?php echo $link_politica_de_privacidade ?>" target="_blank"><strong>Ler Política de Privacidade.</strong></a></span></div>
	<div class="lgpd-btn-verde" onclick="setCookie(); fechar_lgpd()">Aceito</div>

</div>

<script>

function fechar_lgpd(){
	document.querySelector('.lgpd-invisivel').classList.remove('on');
	document.querySelector('.lgpd').classList.remove('on');
}

let cookie = document.cookie; 
let cookie_lgpd_array = document.cookie.split(';');
let lgpd = document.querySelector('.lgpd');
let lgpd_invisivel = document.querySelector('.lgpd-invisivel');

//console.log( cookie );
//console.log( cookie_lgpd_array );

cookie_lgpd_array.forEach( function( item ){
	
	//console.log( item.trim() );
	if( item.trim() == 'lgpd_cidade=ciente' ){
		
		//console.log( 'cookie existe' );
		lgpd.classList.remove('on');
		lgpd_invisivel.classList.remove('on');
		
	}
	
});

function setCookie(){
	document.cookie = "lgpd_cidade=ciente; expires= Tue, 01 Jan 2115 12:00:00 UTC ";
}

function delCookie(){
	document.cookie = "lgpd_cidade=ciente; Max-Age=0";
}

/* PARA APAGAR O COOKIE DIGITE: delCookie() NO CONSOLE */

</script>
<!-- End - view/popup-lgpd.php !-->