<!-- Start - view/acesso-protocolo.php !-->
<style><?php require 'css/acesso-protocolo.css'; ?></style>

<section class="acesso-protocolo">

	<form 
		action="acesso-protocolo-home" 
		method="POST" 
	>
	
		<div class="formularios-titulo"><strong>Consultar</strong> um protocolo aberto</div>
		
		<div class="formularios-comentario">Para consultar um protocolo já cadastrado, utilize os campos de busca abaixo. </div>

		<div class="formularios-separador"></div>

		<div class="formularios-linha">*Número do Protocolo:</div>
		
		<div class="formularios-linha">
			<input 
				type="text" 
				class="contato-form-input" 
				name="protocolo" 
				required 
			/>
		</div>

		<div class="formularios-linha">*E-mail cadastrado:</div>
		<div class="formularios-linha">
			<input 
				type="email" 
				class="contato-form-input" 
				name="email" 
				required 
			/>
		</div>
		
		<div class="formularios-linha">
			<button class="contato-form-button" type="submit">Acessar</button>
		</div>
		
	</form>

</section>
<!-- End - view/acesso-protocolo.php !-->