<!-- Start - view/recados_raw_formulario.php !-->
<?php

$titulo = 'Titulo do assunto';
$mensagem = 'Mensagem.';
$btn_txt = 'Voltar';
$btn_link = './';

//dd( $_GET );

$actual_link = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
//echo $actual_link;

$actual_link_array = explode( '&', trim( strip_tags( $actual_link ) ) );
//dd( $actual_link_array );

foreach( $actual_link_array as $item ){

	$item_array = explode( '=', trim( strip_tags( $item ) ) );

	if( $item_array[0] == 'titulo' ){ $titulo = urldecode( $item_array[1] ); }
	if( $item_array[0] == 'mensagem' ){ $mensagem = urldecode( $item_array[1] ); }
	if( $item_array[0] == 'btn_txt' ){ $btn_txt = urldecode( $item_array[1] ); }
	if( $item_array[0] == 'btn_link' ){ $btn_link = urldecode( $item_array[1] ); }

}

?>

<style>
	<?php 
		require 'css/noticia.css';  
	?>
</style>

<section class="noticia" title="recados">
	
	<div class="box">
		
		<div class="noticia-campo">
			
			<div class="noticia-titulo"><?php echo $titulo; ?></div>
			
			<div class="separador"></div>
			
			<div class="noticia-texto">
			
				<p><?php echo $mensagem; ?></p>
				
				<p><input type="text" name="email" class="email" placeholder="Preencha seu e-mail" required /></p>
				<p><button class="cadastro-btn" onclick="enviarEmail()">Receber a mensagem neste e-mail</button></p>
				
			</div>
			
			<div class="separador"></div>
			
			<div class="col100">
				<a href="<?php echo $btn_link; ?>"><button class="cadastro-btn"><?php echo $btn_txt; ?></button></a>
			</div>
			
		</div>
		
	</div>
	
</section>

<script>

function enviarEmail(){
	
	console.log( 'enviarEmail()' );
	
	let email = document.querySelector('.email').value;
	let recado_titulo = "<?= $titulo ?>";
	let recado_mensagem = "<?= $mensagem ?>";
	
	console.log( 'E-mail enviado: ', email );
	
	var formData = new FormData();
	formData.append( 'email', email );
	formData.append( 'recado_titulo', recado_titulo );
	formData.append( 'recado_mensagem', recado_mensagem );

	var xhr = new XMLHttpRequest();
	xhr.open( 'POST', 'controller/email-formulario.php', true );

	xhr.onreadystatechange = function(){
		
		if( 
			xhr.status === 200 
			&& xhr.readyState == 4
		){
			
			//console.log( xhr.responseText );
			alert( xhr.responseText );
			
		}
		
	};

	xhr.send( formData );
	
}

</script>
<!-- End - view/recados_raw_formulario.php !-->