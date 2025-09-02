<?php

/*Start - WHITELIST*/
require $raiz_site .'model/whitelist.php';
//dd( $whitelist_array );

$permitido = 0;
$ip_acesso = $_SERVER['REMOTE_ADDR'];

foreach( $whitelist_array as $ip ){

	if( $ip['ip'] == $ip_acesso ){
		
		$permitido = 1;
		
	}

}

if( $permitido == 0 ){
	
	echo'
	<script> 
		console.log("Whitelist: IP não permitido - '. $_SERVER['REMOTE_ADDR'] .' - expulsar.");
		window.location.href = "../";
	</script>
	';
	
}

if( $permitido == 1 ){
	
	echo'
		<script> 
			console.log("Whitelist: IP permitido - '. $_SERVER['REMOTE_ADDR'] .' - autorizado."); 
		</script>
	';
	
}
/*End - WHITELIST*/

?>