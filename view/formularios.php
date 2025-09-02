<!-- Start - view/formularios.php !-->
<script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>

<script>
	
	function validarPost(){
		
		console.log( 'validarPost()' ); 
		
		console.log( 'validarFormulario()' );
		
		// Captura os valores do formulário
		let form = document.getElementById("meuForm");
		let formData = new FormData(form);
		let dados = {};
		let erros = [];

		// Verifica os radios obrigatórios com classe "required"
		form.querySelectorAll("input[type=radio].required").forEach(radio => {
			let groupName = radio.name;
			if (!dados[groupName]) { // Garante que só verifica uma vez por grupo
				let selecionado = form.querySelector(`input[name="${groupName}"]:checked`);
				if (!selecionado) {
					erros.push(`Selecione uma opção para "${groupName}".`);
				} else {
					dados[groupName] = selecionado.value;
				}
			}
		});
		
		if (erros.length > 0) { 
			alert("Todas as questões de única escolha que tem borda vermelha são obrigatórias."); 
			return false; 
		}

		// Verifica checkboxes obrigatórios com classe "required"
		let checkboxesObrigatorios = form.querySelectorAll("input[type=checkbox].required");
		let gruposCheckbox = {};

		// Agrupar checkboxes pelo "prefixo" do name
		checkboxesObrigatorios.forEach(checkbox => {
			// Extrai o "prefixo" até o primeiro "_" para identificar grupos diferentes
			let groupName = checkbox.name.split("_")[0];

			// Se ainda não existe, cria um grupo para esse prefixo
			if (!gruposCheckbox[groupName]) {
				gruposCheckbox[groupName] = {
					elementos: [],
					selecionados: 0
				};
			}

			// Adiciona o checkbox ao grupo
			gruposCheckbox[groupName].elementos.push(checkbox);

			// Conta os checkboxes marcados
			if (checkbox.checked) {
				gruposCheckbox[groupName].selecionados++;
			}
		});

		// Agora, validar os grupos
		Object.keys(gruposCheckbox).forEach(groupName => {
			let grupo = gruposCheckbox[groupName];
			let contador = grupo.selecionados; // Conta os checkboxes marcados para este grupo

			console.log(`Grupo "${groupName}" tem ${contador} selecionados`);

			if (contador === 0) {
				erros.push(`Selecione pelo menos uma opção para "${groupName}".`);
				// Adiciona borda vermelha nos checkboxes do grupo
				grupo.elementos.forEach(el => el.classList.add("erro"));
			}
		});

		// Se houver erros, exibe alerta e impede o envio
		if (erros.length > 0) {
			alert("Todas as questões de múltipla escolha que têm borda vermelha são obrigatórias.");
			return false;
		}
		
		if (erros.length > 0) {
			alert(erros.join("\n"));
		}
		
		console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		if( grecaptcha.getResponse() != '' ){ return true; }
		
		alert( 'Selecione a caixa de "Não sou um Robô".' );
		
		return false;
		
	}
	
</script>

<?php 

/*
https://www.youtube.com/watch?v=kG_3LZ2OgBI 
https://www.youtube.com/watch?v=wH4xDm0IuDo
https://developers.google.com/recaptcha/docs/display
*/

require 'model/formularios.php'; 

foreach( $formularios_array as $item ){
	
	if( 
		$item['pagina'] == $_GET['pagina'] 
		&& $item['rascunho'] == 0 
	){
		
		$formulario_array = explode( ';', trim( strip_tags( $item['formulario'] ) ) );
		//dd( $formulario_array );
		
		echo'
		<style>'; require 'css/formularios.css'; echo'</style>

		<section class="formularios">
			
			<div class="box">
				
				<div class="formularios-titulo">'. $item['nome'] .'</div>
				<div class="formularios-comentario off">'. $item['formulario'] .'</div>
				
				<form 
					action="controller/formularios.php" 
					method="POST" 
					enctype="multipart/form-data"
					onsubmit="return validarPost()"
					id="meuForm"
				>
					
					<input 
						type="text" 
						name="formulario_id" 
						value="'. $item['id'] .'" 
						required 
						style="display:none"
					/>
					
					';
					
					foreach( $formulario_array as $quest ){
						
						$quest_array = explode( '=', trim( strip_tags( $quest ) ) );
						
						if( 
							isset( $quest_array[1] )
							&& $quest_array[1] != '' 
						){
							
							//echo '<div class="formularios-comentario">'. $quest_array[0] .' = '. $quest_array[1] .'</div>';
							
							$forma_array = explode( '_', trim( strip_tags( $quest_array[0] ) ) );
							
							if( $forma_array[2] == 'campo' 	){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								if( 
									$quest_buscar_tipo == 'titulo' 
									&& $quest_buscar_tipo != 'subtitulo' 
								){
								
									echo '<div class="formularios-linha-titulo">'. $quest_array[1] .'</div>';
									
								}
								if( 
									$quest_buscar_tipo != 'titulo' 
									&& $quest_buscar_tipo == 'subtitulo' 
								){
								
									echo '<div class="formularios-linha-subtitulo">'. $quest_array[1] .'</div>';
									
								}
								
								if( 
									$quest_buscar_tipo != 'titulo' 
									&& $quest_buscar_tipo != 'subtitulo' 
								){
								
									echo '<div class="formularios-linha">'. $quest_array[1] .'</div>';
									
								}
								
							}
							
							if( 
								isset( $forma_array[2] )
								&& $forma_array[2] == 'comentario' 
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								if( 
									$quest_buscar_tipo != 'titulo' 
									&& $quest_buscar_tipo != 'subtitulo' 
								){
								
									echo '<div class="formularios-comentario">'. $quest_array[1] .'</div>';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& (
									$quest_array[1] == 'text'
									|| $quest_array[1] == 'email'
									|| $quest_array[1] == 'date'
									|| $quest_array[1] == 'time'
									|| $quest_array[1] == 'datetime-local'
								)
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_obrigatorio';
								$quest_buscar_obrigatorio = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_obrigatorio = $quest_check_array[1];
										
									}
									
								}
								
								echo '
								<div class="formularios-linha">
									<input 
										class="contato-form-input" 
										type="'. $quest_array[1] .'" 
										name="'. $forma_array[0] .'_'. $forma_array[1] .'"
										'. $quest_buscar_obrigatorio .'
									/>
								</div>
								';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'file'
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_obrigatorio';
								$quest_buscar_obrigatorio = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_obrigatorio = $quest_check_array[1];
										
									}
									
								}
								
								echo '
								<div class="formularios-linha">
									<input 
										class="contato-form-input" 
										type="'. $quest_array[1] .'" 
										name="'. $forma_array[0] .'_'. $forma_array[1] .'"
										'. $quest_buscar_obrigatorio .'
									/>
								</div>
								';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'textarea'
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_obrigatorio';
								$quest_buscar_obrigatorio = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_obrigatorio = $quest_check_array[1];
										
									}
									
								}
								
								echo '
								<div class="formularios-linha">
									<textarea 
										name="'. $forma_array[0] .'_'. $forma_array[1] .'"
										'. $quest_buscar_obrigatorio .'
									></textarea>
								</div>
								';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'radio_s_n'
							){
								
								echo '
								<div class="formularios-linha">
									<div class="col05 formularios-radio-input">
										<input 
											type="radio" 
											class="contato-form-input" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'" 
											value="sim" 
											checked 
										/>
									</div>
									<div class="col10 formularios-radio-descricao">Sim</div>
									
									<div class="col05 formularios-radio-input">
										<input 
											type="radio" 
											class="contato-form-input" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'" 
											value="nao" 
										/>
									</div>
									<div class="col10 formularios-radio-descricao">Não</div>
								</div>
								';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'radio'
							){
								
								echo '<div class="formularios-linha '. $forma_array[0] .'_'. $forma_array[1] .' opcoes_radio_aqui"></div>';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'checkbox'
							){
								
								echo '<div class="formularios-linha '. $forma_array[0] .'_'. $forma_array[1] .' opcoes_checkbox_aqui"></div>';
								
							}
							
							if( 
								$forma_array[2] == 'tipo' 
								&& $quest_array[1] == 'select'
							){
								
								echo '
								<div class="formularios-linha">
									<select 
										class="contato-form-input '. $forma_array[0] .'_'. $forma_array[1] .' select" 
										name="'. $forma_array[0] .'_'. $forma_array[1] .'"
									></select>
								</div>
								';
								
							}
							
							//FAZER UM JAVASCRIPT E INSERIR DENTRO DO ITEM
							
							if( 
								$forma_array[2] == 'opcoes' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								//echo $quest_buscar_tipo.'<br/>';
								
								if( $quest_buscar_tipo == 'select' ){
									
									$opcoes_array = explode( ',', trim( strip_tags( $quest_array[1] ) ) );
									
									$ultima_opcao = $opcoes_array[count($opcoes_array) -1];
									
									if( $ultima_opcao == '' ){ array_pop( $opcoes_array ); }
									
									$opcoes_html = '';
									
									foreach( $opcoes_array as $select_opt ){

										$opcoes_html .= '<option>'. $select_opt .'</option>';
										
									}
									
									//dd( $opcoes_html );
									
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += `'. $opcoes_html .'`;
										
									</script>
									';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'opcao01' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								$quest_buscar_obrigatorio = 'questao_'. $forma_array[1] .'_obrigatorio';
								$obrigatorio = '';
								
								//dd( $formulario_array );
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
									if( $quest_check_array[0] == $quest_buscar_obrigatorio ){
										
										$obrigatorio = $quest_check_array[1];
										
									}
									
								}
								
								//echo'<script> alert("'. $quest_buscar_tipo .'"); </script>';
								//echo'<script> alert("'. $quest_buscar_obrigatorio .'"); </script>';
								//echo'<script> alert("'. $obrigatorio .'"); </script>';
								
								if( $quest_buscar_tipo == 'radio' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_radio_aqui`).innerHTML += ``+
										`<div class="col05 formularios-radio-input">`+
											`<input `+
												`type="radio" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
												`value="'. $quest_array[1] .'"`+
												`checked`+
											`/>`+
										`</div>`+
										`<div class="formularios-radio-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
								if( $quest_buscar_tipo == 'checkbox' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
										`<div class="col05 formularios-checkbox-input">`+
											`<input `+
												`type="checkbox" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox01" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-checkbox-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'opcao02' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								//echo $quest_buscar_tipo.'<br/>';
								
								if( $quest_buscar_tipo == 'radio' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_radio_aqui`).innerHTML += ``+
										`<div class="col05 formularios-radio-input">`+
											`<input `+
												`type="radio" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-radio-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
								if( $quest_buscar_tipo == 'checkbox' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
										`<div class="col05 formularios-checkbox-input">`+
											`<input `+
												`type="checkbox" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox02" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-checkbox-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'opcao03' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								//echo $quest_buscar_tipo.'<br/>';
								
								if( $quest_buscar_tipo == 'radio' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_radio_aqui`).innerHTML += ``+
										`<div class="col05 formularios-radio-input">`+
											`<input `+
												`type="radio" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-radio-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
								if( $quest_buscar_tipo == 'checkbox' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
										`<div class="col05 formularios-checkbox-input">`+
											`<input `+
												`type="checkbox" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox03" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-checkbox-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'opcao04' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								//echo $quest_buscar_tipo.'<br/>';
								
								if( $quest_buscar_tipo == 'radio' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_radio_aqui`).innerHTML += ``+
										`<div class="col05 formularios-radio-input">`+
											`<input `+
												`type="radio" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-radio-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
								if( $quest_buscar_tipo == 'checkbox' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
										`<div class="col05 formularios-checkbox-input">`+
											`<input `+
												`type="checkbox" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox04" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-checkbox-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
							}
							
							if( 
								$forma_array[2] == 'opcao05' 
								&& $quest_array[1] != ''
							){
								
								$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
								$quest_buscar_tipo = '';
								
								foreach( $formulario_array as $quest_check ){
						
									$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
									
									if( $quest_check_array[0] == $quest_buscar ){
										
										$quest_buscar_tipo = $quest_check_array[1];
										
									}
									
								}
								
								//echo $quest_buscar_tipo.'<br/>';
								
								if( $quest_buscar_tipo == 'radio' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_radio_aqui`).innerHTML += ``+
										`<div class="col05 formularios-radio-input">`+
											`<input `+
												`type="radio" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-radio-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
								if( $quest_buscar_tipo == 'checkbox' ){
								
									echo '
									<script>
										
										document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
										`<div class="col05 formularios-checkbox-input">`+
											`<input `+
												`type="checkbox" `+
												`class="contato-form-input '. $obrigatorio .'" `+
												`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox05" `+
												`value="'. $quest_array[1] .'"`+
											`/>`+
										`</div>`+
										`<div class="formularios-checkbox-descricao">'. $quest_array[1] .'</div>`+
										``;
										
									</script>
									';
									
								}
								
							}
							
						}
						
					}
					
					echo'
					<div class="separador"></div>
					
					<button class="formularios-btn" type="submit">Enviar Formulário</button>
					
					<div class="separador"></div>
					
					<div class="g-recaptcha" data-sitekey="6LcNEiYqAAAAAOHyJRBsviaeFogGG0_JLy6P4st7"></div>
					
				</form>
				
			</div>
			
		</section>
		';
		
	}

}

?>
<!-- End - view/formularios.php !-->