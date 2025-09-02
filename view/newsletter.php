<!-- Start - view/newsletter.php !-->
<?php

foreach( $paginas_fixas as $item ){

	if( $item['pagina'] == $_GET['pagina'] ){
		$conteudo_texto = $item['texto'];
	}

}

?>

<style>
	<?php 
		require 'css/newsletter.css'; 
		require 'css/formularios.css'; 
	?>
</style>

<section class="newsletter">
	
	<div class="box" id="ler_texto">
		
		<div class="newsletter-campo"><?php echo $conteudo_texto ?></div>
		
		<div class="newsletter-form">
			
			<div class="formularios-linha">Digite seu e-mail:</div>
			<div class="formularios-linha">
				<input 
					type="email" 
					class="contato-form-input input_email" 
					name="email" 
					required 
				/>
			</div>
			
			<div class="formularios-linha">
				
				<div class="col50">
					<div class="formularios-comentario">Para receber as notícias clique em cadastrar:</div>
					<div class="formularios-linha">
						<button 
							class="contato-form-button" 
							onclick="validarPost()"
						>CADASTRAR</button>
					</div>
				</div>
				
				<div class="col50">
					<div class="formularios-comentario">Para cancelar sua assinatura basta clicar no botão abaixo:</div>
					<div class="formularios-linha">
						<button 
							class="contato-form-button" 
							onclick="validarPostCancelar()"
						>CANCELAR ASSINATURA</button>
					</div>
				</div>
				
			</div>
			
			<div class="g-recaptcha" data-sitekey="6LcNEiYqAAAAAOHyJRBsviaeFogGG0_JLy6P4st7"></div>
			
			<div class="separador"></div>
			
		</div>
		
	</div>
	
</section>

<script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>

<script>
	
	function validarPost(){
		
		//console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		if( grecaptcha.getResponse() != '' ){ 
			
			enviarConteudo();
			return true; 
			
		}
		
		alert( 'Selecione a caixa de "Não sou um Robô".' );
		
		return false;
		
	}

	function enviarConteudo(){
		
		let email = document.querySelector('.input_email').value;
		
		//console.log( 'email', email ); 
		//console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		var formData = new FormData();
		formData.append( 'email', email );
		formData.append( 'recaptcha', grecaptcha.getResponse() );
		
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'controller/newsletter.php', true );
		
		xhr.onload = function () {
			
			if ( xhr.status === 200 ) {

				//console.log( 'xhr.responseText', xhr.responseText );
				alert( xhr.responseText );
				
			}
			
		};
		
		xhr.send( formData );
		
	};
	
	function validarPostCancelar(){
		
		//console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		if( grecaptcha.getResponse() != '' ){ 
			
			cancelarAssinatura();
			return true; 
			
		}
		
		alert( 'Selecione a caixa de "Não sou um Robô".' );
		
		return false;
		
	}

	function cancelarAssinatura(){
		
		let email = document.querySelector('.input_email').value;
		
		//console.log( 'email', email ); 
		//console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		var formData = new FormData();
		formData.append( 'email', email );
		formData.append( 'recaptcha', grecaptcha.getResponse() );
		
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'controller/newsletterCancelar.php', true );
		
		xhr.onload = function () {
			
			if ( xhr.status === 200 ) {

				//console.log( 'xhr.responseText', xhr.responseText );
				alert( xhr.responseText );
				
			}
			
		};
		
		xhr.send( formData );
		
	};
	
</script>
<!-- End - view/newsletter.php !-->