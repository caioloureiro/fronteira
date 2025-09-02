<!-- Start - view/contato.php !-->
<?php

require 'model/contato.php';
require 'model/departamentos.php';

$contato_endereco = '';
$contato_telefone = '';
$contato_horario = '';
$contato_mapa = '';

foreach( $contato_array as $cont ){

	$contato_endereco = $cont['endereco'];
	$contato_telefone = $cont['telefone'];
	$contato_horario = $cont['horario'];
	$contato_mapa = $cont['mapa'];
	
}

?>

<style><?php require 'css/contato.css'; ?></style>

<section class="contato" id="ler_texto">
	
	<div class="contato-col01">
		
		<div class="contato-form">
			
			<h2>Formulário de e-mail</h2>
			
			<p>Preencha os campos abaixo para enviar sua mensagem. Campos com asterisco (<span style="color:red">*</span>) são obrigatórios.</p>
			
			<form 
				action="controller/email.php" 
				method="POST"
			>
				
				<input 
					type="text" 
					class="contato-form-input" 
					name="nome" 
					placeholder="Nome*" 
					required 
				/>
				
				<input 
					type="text" 
					class="contato-form-input" 
					name="email" 
					placeholder="E-mail*" 
					required 
				/>
				
				<input 
					type="text" 
					class="contato-form-input" 
					name="telefone" 
					placeholder="Telefone" 
					required 
				/>
				
				<input 
					type="text" 
					class="contato-form-input" 
					name="endereco" 
					placeholder="Endereço" 
					required 
				/>
				
				<select 
					class="contato-form-select" 
					name="departamento"
				>
					<option value="">Departamento*</option>
					
					<?php
						
						usort($departamentos_array, function( $a, $b ){//Função responsável por ordenar

							$al = mb_strtolower($a['nome']);
							$bl = mb_strtolower($b['nome']);
							
							if ($al == $bl){
								return 0;
							}
							
							return ($bl < $al) ? +1 : -1;
							
						});
					
						foreach( $departamentos_array as $dep ){

							echo '<option value="'. $dep['nome'] .'">'. $dep['nome'] .' ('. $dep['email'] .')</option>';
							
						}
						
					?>
					
				</select>
				
				<textarea 
					class="contato-form-textarea" 
					name="mensagem"
					placeholder="Mensagem*" 
				></textarea>
				
				<button class="contato-form-button" type="submit">Enviar</button>
				
			</form>
			
		</div>
		
	</div>
	
	<div class="contato-col02">
	
		<div class="contato-linha">
			<div class="contato-icone">
				<span class="material-symbols-outlined">location_on</span>
			</div>
			<div class="contato-txt"><span><?php echo $contato_endereco ?></span></div>
		</div>
		<div class="contato-linha">
			<div class="contato-icone">
				<span class="material-symbols-outlined">call</span>
			</div>
			<div class="contato-txt"><span><a href="tel:<?php echo $contato_telefone ?>" target="_blank"><?php echo $contato_telefone ?></a></span></div>
		</div>
		<div class="contato-linha">
			<div class="contato-icone">
				<span class="material-symbols-outlined">schedule</span>
			</div>
			<div class="contato-txt"><span><?php echo $contato_horario ?></span></div>
		</div>
		
		<div class="contato-mapa"><?php echo $contato_mapa ?></div>
		
	</div>
	
</section>
<!-- End - view/contato.php !-->