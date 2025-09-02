<!-- Start - view/enquete.php !-->
<script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>

<script>
	
	function validarPost(){
		
		console.log( 'grecaptcha.getResponse', grecaptcha.getResponse() ); 
		
		if( grecaptcha.getResponse() != '' ){ return true; }
		
		alert( 'Selecione a caixa de "Não sou um Robô".' );
		
		return false;
		
	}
	
</script>

<?php

require 'model/enquete.php';
require 'model/enquete_respostas.php';

foreach( $enquete_array as $item ){
	
	if( $item['id'] == $_GET['id'] ){
		
		if( $item['id'] != '' ){ $enquete_id = $item['id']; }
		if( $item['nome'] != '' ){ $enquete_nome = $item['nome']; }
		if( $item['pagina'] != '' ){ $enquete_pagina = $item['pagina']; }
		if( $item['rascunho'] != '' ){ $enquete_rascunho = $item['rascunho']; }
		if( $item['formulario'] != '' ){ $enquete_formulario = $item['formulario']; }
		if( $item['inicio'] != '' ){ 
			$enquete_inicio_limpo = $item['inicio']; 
			$enquete_inicio = data_tempo( $item['inicio'] ); 
		}
		if( $item['final'] != '' ){ 
			$enquete_final_limpo = $item['final']; 
			$enquete_final = data_tempo( $item['final'] ); 
		}
		
		$dia_semana_inicio_eng = date( 'D', strtotime( $item['inicio'] ) );
		$dia_semana_final_eng = date( 'D', strtotime( $item['final'] ) );
		
		if( $dia_semana_inicio_eng == 'Sun' ){ $dia_semana_inicio = 'domingo'; }
		if( $dia_semana_inicio_eng == 'Mon' ){ $dia_semana_inicio = 'segunda-feira'; }
		if( $dia_semana_inicio_eng == 'Tue' ){ $dia_semana_inicio = 'terça-feira'; }
		if( $dia_semana_inicio_eng == 'Wed' ){ $dia_semana_inicio = 'quarta-feira'; }
		if( $dia_semana_inicio_eng == 'Thu' ){ $dia_semana_inicio = 'quinta-feira'; }
		if( $dia_semana_inicio_eng == 'Fri' ){ $dia_semana_inicio = 'sexta-feira'; }
		if( $dia_semana_inicio_eng == 'Sat' ){ $dia_semana_inicio = 'sábado'; }
		
		if( $dia_semana_final_eng == 'Sun' ){ $dia_semana_final = 'domingo'; }
		if( $dia_semana_final_eng == 'Mon' ){ $dia_semana_final = 'segunda-feira'; }
		if( $dia_semana_final_eng == 'Tue' ){ $dia_semana_final = 'terça-feira'; }
		if( $dia_semana_final_eng == 'Wed' ){ $dia_semana_final = 'quarta-feira'; }
		if( $dia_semana_final_eng == 'Thu' ){ $dia_semana_final = 'quinta-feira'; }
		if( $dia_semana_final_eng == 'Fri' ){ $dia_semana_final = 'sexta-feira'; }
		if( $dia_semana_final_eng == 'Sat' ){ $dia_semana_final = 'sábado'; }
		
	}

}

$hoje_limpo = date( 'Y-m-d H:i:s' );
$hoje = data_tempo ( date( 'Y-m-d H:i:s' ) );

?>

<style>
	<?php 
		require 'css/enquete.css'; 
		require 'css/formularios.css'; 
	?>
</style>

<section class="enquete">
	
	<div class="box">
		
		<a href="enquetes"><div class="voltar">Enquetes</div></a>
		
		<div class="enquete-campo" id="ler_texto">
		
			<?php
			
				if( $enquete_rascunho == 0 ){
					
					if( 
						$hoje_limpo >= $enquete_inicio_limpo 
						&& $hoje_limpo <= $enquete_final_limpo
					){
					
						echo'
						<div class="enquete-titulo"><span>'. $enquete_nome .'</span></div>
						
						<div class="enquete-linha">
							<div class="col15 enquete-realce">Início:</div>
							<div class="col35">'. $dia_semana_inicio .', '. $enquete_inicio .'</div>
							<div class="col15 enquete-realce">Encerramento:</div>
							<div class="col35">'. $dia_semana_final .', '. $enquete_final .'</div>
						</div>
						
						<div class="enquete-comentario off">'. $enquete_formulario .'</div>
						
						<form 
							action="controller/enquetes.php" 
							method="POST" 
							enctype="multipart/form-data"
							onsubmit="return validarPost()"
						>
							
							<input 
								type="text" 
								name="enquete_id" 
								value="'. $enquete_id .'" 
								required 
								style="display:none"
							/>
							';
							
							$enquete_formulario_array = explode( ';', trim( strip_tags( $enquete_formulario ) ) );
							array_pop( $enquete_formulario_array );
							//echo '<pre>'; print_r( $enquete_formulario_array ); echo'</pre>';
							
							foreach( $enquete_formulario_array as $quest ){
					
								$quest_array = explode( '=', trim( strip_tags( $quest ) ) );
								
								if( 
									isset( $quest_array[1] )
									&& $quest_array[1] != '' 
								){
									
									//echo '<div class="enquete-comentario">'. $quest_array[0] .' = '. $quest_array[1] .'</div>';
									
									$forma_array = explode( '_', trim( strip_tags( $quest_array[0] ) ) );
									
									if( $forma_array[2] == 'campo' 	){
							
										$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
										$quest_buscar_tipo = '';
										
										foreach( $enquete_formulario_array as $quest_check ){
					
											$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
											
											if( $quest_check_array[0] == $quest_buscar ){
												
												$quest_buscar_tipo = $quest_check_array[1];
												
											}
											
										}
										
										if( 
											$quest_buscar_tipo == 'titulo' 
											&& $quest_buscar_tipo != 'subtitulo' 
										){
										
											echo '<div class="enquete-linha-titulo">'. $quest_array[1] .'</div>';
											
										}
										if( 
											$quest_buscar_tipo != 'titulo' 
											&& $quest_buscar_tipo == 'subtitulo' 
										){
										
											echo '<div class="enquete-linha-subtitulo">'. $quest_array[1] .'</div>';
											
										}
										
										if( 
											$quest_buscar_tipo != 'titulo' 
											&& $quest_buscar_tipo != 'subtitulo' 
										){
										
											echo '<div class="enquete-linha">'. $quest_array[1] .'</div>';
											
										}
										
									}
									
									if( 
										isset( $forma_array[2] )
										&& $forma_array[2] == 'comentario' 
									){
										
										$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
										$quest_buscar_tipo = '';
										
										foreach( $enquete_formulario_array as $quest_check ){
								
											$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
											
											if( $quest_check_array[0] == $quest_buscar ){
												
												$quest_buscar_tipo = $quest_check_array[1];
												
											}
											
										}
										
										if( 
											$quest_buscar_tipo != 'titulo' 
											&& $quest_buscar_tipo != 'subtitulo' 
										){
										
											echo '<div class="enquete-comentario">'. $quest_array[1] .'</div>';
											
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
											$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
											
											if( $quest_check_array[0] == $quest_buscar ){
												
												$quest_buscar_obrigatorio = $quest_check_array[1];
												
											}
											
										}
										
										echo '
										<input  
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
											$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
											
											if( $quest_check_array[0] == $quest_buscar ){
												
												$quest_buscar_obrigatorio = $quest_check_array[1];
												
											}
											
										}
										
										echo '
										<input 
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
											$quest_check_array = explode( '=', trim( strip_tags( $quest_check ) ) );
											
											if( $quest_check_array[0] == $quest_buscar ){
												
												$quest_buscar_obrigatorio = $quest_check_array[1];
												
											}
											
										}
										
										echo '
										<input 
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
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
										<input  
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
										<div class="formularios-linha">
											<div class="col05">
												<input 
													type="radio" 
													class="contato-form-input" 
													name="'. $forma_array[0] .'_'. $forma_array[1] .'" 
													value="sim" 
													checked 
												/>
											</div>
											<div class="col15">Sim</div>
											
											<div class="col05">
												<input 
													type="radio" 
													class="contato-form-input" 
													name="'. $forma_array[0] .'_'. $forma_array[1] .'" 
													value="nao" 
												/>
											</div>
											<div class="col15">Não</div>
										</div>
										';
										
									}
									
									if( 
										$forma_array[2] == 'tipo' 
										&& $quest_array[1] == 'radio'
									){
										
										echo '
										<input  
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
										<div class="formularios-linha '. $forma_array[0] .'_'. $forma_array[1] .' opcoes_radio_aqui"></div>
										';
										
									}
									
									if( 
										$forma_array[2] == 'tipo' 
										&& $quest_array[1] == 'checkbox'
									){
										
										echo '
										<input  
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
										<div class="formularios-linha '. $forma_array[0] .'_'. $forma_array[1] .' opcoes_checkbox_aqui"></div>
										';
										
									}
									
									if( 
										$forma_array[2] == 'tipo' 
										&& $quest_array[1] == 'select'
									){
										
										echo '
										<input  
											style="display:none"
											class="contato-form-input" 
											type="text" 
											name="'. $forma_array[0] .'_'. $forma_array[1] .'_tipo"
											value="'. $forma_array[0] .'_'. $forma_array[1] .'_'. $quest_array[1] .'"
										/>
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
										$forma_array[2] == 'opcao01' 
										&& $quest_array[1] != ''
									){
										
										$quest_buscar = 'questao_'. $forma_array[1] .'_tipo';
										$quest_buscar_tipo = '';
										
										foreach( $enquete_formulario_array as $quest_check ){
								
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
												`<div class="col05">`+
													`<input `+
														`type="radio" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'checkbox' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
												`<div class="col05">`+
													`<input `+
														`type="checkbox" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox01" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'select' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += ``+
													`<option>'. $quest_array[1] .'</option>`+
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
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
												`<div class="col05">`+
													`<input `+
														`type="radio" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'checkbox' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
												`<div class="col05">`+
													`<input `+
														`type="checkbox" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox02" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'select' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += ``+
													`<option>'. $quest_array[1] .'</option>`+
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
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
												`<div class="col05">`+
													`<input `+
														`type="radio" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'checkbox' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
												`<div class="col05">`+
													`<input `+
														`type="checkbox" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox03" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'select' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += ``+
													`<option>'. $quest_array[1] .'</option>`+
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
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
												`<div class="col05">`+
													`<input `+
														`type="radio" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'checkbox' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
												`<div class="col05">`+
													`<input `+
														`type="checkbox" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox04" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'select' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += ``+
													`<option>'. $quest_array[1] .'</option>`+
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
										
										foreach( $enquete_formulario_array as $quest_check ){
								
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
												`<div class="col05">`+
													`<input `+
														`type="radio" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'checkbox' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.opcoes_checkbox_aqui`).innerHTML += ``+
												`<div class="col05">`+
													`<input `+
														`type="checkbox" `+
														`class="contato-form-input" `+
														`name="'. $forma_array[0] .'_'. $forma_array[1] .'_checkbox05" `+
														`value="'. $quest_array[1] .'"`+
													`/>`+
												`</div>`+
												`<div class="col15">'. $quest_array[1] .'</div>`+
												``;
												
											</script>
											';
											
										}
										
										if( $quest_buscar_tipo == 'select' ){
										
											echo '
											<script>
												
												document.querySelector(`.'. $forma_array[0] .'_'. $forma_array[1] .'.select`).innerHTML += ``+
													`<option>'. $quest_array[1] .'</option>`+
												``;
												
											</script>
											';
											
										}
										
									}
									
								}
								
							}

							echo'
							<div class="separador"></div>
					
							<button class="formularios-btn" type="submit">Enviar Resposta</button>
							
							<div class="separador"></div>
							
							<div class="g-recaptcha" data-sitekey="6LcNEiYqAAAAAOHyJRBsviaeFogGG0_JLy6P4st7"></div>
							
						</form>
						';
						
					}
					
					if( $hoje_limpo < $enquete_inicio_limpo ){
						
						echo'
						<div class="enquete-linha">
							<div class="col100">Aguarde o início da enquete. Esta enquete iniciará em: '. $dia_semana_inicio .', '.$enquete_inicio .'</div>
						</div>
						';
						
					}
					
					if( $hoje_limpo > $enquete_final_limpo ){
						
						echo'
						<div class="enquete-titulo"><span>'. $enquete_nome .'</span></div>
						
						<div class="enquete-linha">
							<div class="col100">Enquete encerrada em: '. $dia_semana_final .', '.$enquete_final .'.</div>
						</div>
						';
						
						$counter_repostas = 0;
						$counter_opcao01 = 0;
						$counter_opcao02 = 0;
						$counter_opcao03 = 0;
						$counter_opcao04 = 0;
						$counter_opcao05 = 0;
						$opcao01_nome = 'Opção 01';
						$opcao02_nome = 'Opção 02';
						$opcao03_nome = 'Opção 03';
						$opcao04_nome = 'Opção 04';
						$opcao05_nome = 'Opção 05';
						
						foreach( $enquete_respostas_array as $resp ){
							
							//echo '<pre>'; print_r( $resp ); echo'</pre>';
							
							if( $resp['enquete_id'] == $enquete_id ){
								
								$counter_repostas++;
								
								//echo'<div class="enquete-comentario">'. $resp['enquete_id'] .' - '. $resp['respostas'] .'</div>';
								
								$enquete_resposta_array = explode( ';', trim( strip_tags( $resp['respostas'] ) ) );
								array_pop( $enquete_resposta_array );
								//echo '<pre>'; print_r( $enquete_resposta_array ); echo'</pre>';
								
								$resposta_contar = '';
								
								foreach( $enquete_resposta_array as $resp_item ){
									
									//echo '<pre>'; print_r( $resp_item ); echo'</pre>';
									$enquete_resposta_item_array = explode( '=', trim( strip_tags( $resp_item ) ) );
									//echo '<pre>'; print_r( $enquete_resposta_item_array ); echo'</pre>';
									
									$enquete_resposta_item_tipo_array = explode( '_', trim( strip_tags( $enquete_resposta_item_array[0] ) ) );
									//echo '<pre>'; print_r( $enquete_resposta_item_tipo_array[ count( $enquete_resposta_item_tipo_array ) -1 ] ); echo'</pre>';
									
									$enquete_resposta_item_tipo = $enquete_resposta_item_tipo_array[ count( $enquete_resposta_item_tipo_array ) -1 ];
									
									if( 
										$enquete_resposta_item_tipo == 'radio' 
										|| $enquete_resposta_item_tipo == 'checkbox' 
									){
										
										$resposta_contar = $enquete_resposta_item_array[1];
										
										//echo'<div class="enquete-comentario">$resposta_contar = '. $resposta_contar .'</div>';
										
									}
									
								}
								
								//echo'<div class="enquete-comentario">'. $enquete_formulario .'</div>';
								
								$enquete_formulario_array = explode( ';', trim( strip_tags( $enquete_formulario ) ) );
								array_pop( $enquete_formulario_array );
								//echo '<pre>'; print_r( $enquete_formulario_array ); echo'</pre>';
								
								//PRECISO SABER QUAL O NÚMERO DA QUESTÃO ESTÁ O RÁDIO
								$numero_questao_alvo = 0;
								
								foreach( $enquete_formulario_array as $get_questao ){
									
									//echo '<pre>'; print_r( $get_questao ); echo'</pre>';
									
									$get_questao_array = explode( '_', trim( strip_tags( $get_questao ) ) );
									
									//echo '<pre>'; print_r( $get_questao_array ); echo'</pre>';
									
									$get_questao_tipo_array = explode( '=', trim( strip_tags( $get_questao_array[2] ) ) );
									
									if( 
										$get_questao_tipo_array[0] == 'tipo' 
										&& $get_questao_tipo_array[1] == 'radio' 
									){
										
										//echo '<pre>'; print_r( $get_questao_tipo_array ); echo'</pre>';
										
										//echo $get_questao_array[1] .'<br/>';
										
										$numero_questao_alvo = $get_questao_array[1];
										
										//echo'<div class="enquete-comentario">$numero_questao_alvo = '. $numero_questao_alvo .'</div>';
										
									}
									
								}
								
								//AGORA EU SEI O NÚMERO DA QUESTÃO
								
								//VOU BUSCAR AS OPÇÕES DA QUESTÃO
								
								foreach( $enquete_formulario_array as $get_opcoes ){
									
									//echo '<pre>'; print_r( $get_opcoes ); echo'</pre>';
									
									$get_opcoes_array01 = explode( '=', trim( strip_tags( $get_opcoes ) ) );
									
									//echo '<pre>'; print_r( $get_opcoes_array01 ); echo'</pre>';
									
									$get_opcoes_opcao01_alvo = 'questao_'. $numero_questao_alvo .'_opcao01';
									
									if( $get_opcoes_opcao01_alvo == $get_opcoes_array01[0] ){
										
										//echo'<div class="enquete-comentario">$get_opcoes_opcao01_alvo = '. $get_opcoes_array01[1] .'</div>';
										
										$opcao01_nome = $get_opcoes_array01[1];
										
										if( $get_opcoes_array01[1] == $resposta_contar ){ $counter_opcao01++; }
										
									}
									
									$get_opcoes_opcao02_alvo = 'questao_'. $numero_questao_alvo .'_opcao02';
									
									if( $get_opcoes_opcao02_alvo == $get_opcoes_array01[0] ){
										
										//echo'<div class="enquete-comentario">$get_opcoes_opcao02_alvo = '. $get_opcoes_array01[1] .'</div>';
										
										$opcao02_nome = $get_opcoes_array01[1];
										
										if( $get_opcoes_array01[1] == $resposta_contar ){ $counter_opcao02++; }
										
									}
									
									$get_opcoes_opcao03_alvo = 'questao_'. $numero_questao_alvo .'_opcao03';
									
									if( $get_opcoes_opcao03_alvo == $get_opcoes_array01[0] ){
										
										//echo'<div class="enquete-comentario">$get_opcoes_opcao03_alvo = '. $get_opcoes_array01[1] .'</div>';
										
										$opcao03_nome = $get_opcoes_array01[1];
										
										if( $get_opcoes_array01[1] == $resposta_contar ){ $counter_opcao03++; }
										
									}
									
									$get_opcoes_opcao04_alvo = 'questao_'. $numero_questao_alvo .'_opcao04';
									
									if( $get_opcoes_opcao04_alvo == $get_opcoes_array01[0] ){
										
										//echo'<div class="enquete-comentario">$get_opcoes_opcao04_alvo = '. $get_opcoes_array01[1] .'</div>';
										
										$opcao04_nome = $get_opcoes_array01[1];
										
										if( $get_opcoes_array01[1] == $resposta_contar ){ $counter_opcao04++; }
										
									}
									
									$get_opcoes_opcao05_alvo = 'questao_'. $numero_questao_alvo .'_opcao05';
									
									if( $get_opcoes_opcao05_alvo == $get_opcoes_array01[0] ){
										
										//echo'<div class="enquete-comentario">$get_opcoes_opcao05_alvo = '. $get_opcoes_array01[1] .'</div>';
										
										$opcao05_nome = $get_opcoes_array01[1];
										
										if( $get_opcoes_array01[1] == $resposta_contar ){ $counter_opcao05++; }
										
									}
									
								}
								
							}
							
						}
						
						if( $counter_repostas > 0 ){
							
							$porcentagem_opcao01 = number_format( ( $counter_opcao01 * 100 ) / $counter_repostas, 0, ',', ' ' );
							$porcentagem_opcao02 = number_format( ( $counter_opcao02 * 100 ) / $counter_repostas, 0, ',', ' ' );
							$porcentagem_opcao03 = number_format( ( $counter_opcao03 * 100 ) / $counter_repostas, 0, ',', ' ' );
							$porcentagem_opcao04 = number_format( ( $counter_opcao04 * 100 ) / $counter_repostas, 0, ',', ' ' );
							$porcentagem_opcao05 = number_format( ( $counter_opcao05 * 100 ) / $counter_repostas, 0, ',', ' ' );
							
						}
						
						else{
							
							$porcentagem_opcao01 = 0;
							$porcentagem_opcao02 = 0;
							$porcentagem_opcao03 = 0;
							$porcentagem_opcao04 = 0;
							$porcentagem_opcao05 = 0;
							
						}
						
						echo'
						<div class="enquete-linha">
							<div class="col100">'. $counter_repostas .' respostas para esta enquete.</div>
						</div>
						
						<div class="enquete-linha">
							<div class="col15">'. $opcao01_nome .': </div>
							<div class="col35">
								<div class="enquete-grafico">
									<div class="enquete-fill" style="left:-'. ( 100 - $porcentagem_opcao01 ) .'%"></div>
									<div class="enquete-valor">'. $porcentagem_opcao01 .'%</div>
								</div>
							</div>
							<div class="col15">'. $opcao02_nome .': </div>
							<div class="col35">
								<div class="enquete-grafico">
									<div class="enquete-fill" style="left:-'. ( 100 - $porcentagem_opcao02 ) .'%"></div>
									<div class="enquete-valor">'. $porcentagem_opcao02 .'%</div>
								</div>
							</div>
						</div>
						
						<div class="enquete-linha">
							<div class="col15">'. $opcao03_nome .': </div>
							<div class="col35">
								<div class="enquete-grafico">
									<div class="enquete-fill" style="left:-'. ( 100 - $porcentagem_opcao03 ) .'%"></div>
									<div class="enquete-valor">'. $porcentagem_opcao03 .'%</div>
								</div>
							</div>
							<div class="col15">'. $opcao04_nome .': </div>
							<div class="col35">
								<div class="enquete-grafico">
									<div class="enquete-fill" style="left:-'. ( 100 - $porcentagem_opcao04 ) .'%"></div>
									<div class="enquete-valor">'. $porcentagem_opcao04 .'%</div>
								</div>
							</div>
						</div>
						
						<div class="enquete-linha">
							<div class="col15">'. $opcao05_nome .': </div>
							<div class="col35">
								<div class="enquete-grafico">
									<div class="enquete-fill" style="left:-'. ( 100 - $porcentagem_opcao05 ) .'%"></div>
									<div class="enquete-valor">'. $porcentagem_opcao05 .'%</div>
								</div>
							</div>
						</div>
						';
						
					}
					
				}
				
			?>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/enquete.php !-->