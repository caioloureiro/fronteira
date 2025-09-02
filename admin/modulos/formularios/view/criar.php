<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

$raiz_site = '../../../../';
$raiz_admin = '../../../';

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/paginas.php';
require $raiz_site .'model/paginas_fixas.php';

//https://www.youtube.com/results?search_query=javascript+formBuilder

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />

		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox formulario-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo formulário
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Nome: </span>
					</div>
					<div class="col90">
						<input 
							name="nome" 
							required
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Página: </span>
					</div>
					<div class="col90">
						<span>
							<select 
								name="pagina"
								required
							>
								<?php
									
									echo'
									<option disabled>PÁGINAS</option>
									<option disabled>---------</option>
									';
									
									usort($paginas, function( $a, $b ){//Função responsável por ordenar

										$al = mb_strtolower($a['titulo']);
										$bl = mb_strtolower($b['titulo']);
										
										if ($al == $bl){
											return 0;
										}
										
										return ($bl < $al) ? +1 : -1;
										
									});
									
									foreach( $paginas as $pag ){

										echo '<option value="'. $pag['pagina'] .'">'. $pag['titulo'] .'</option>';
										
									}
									
									usort($paginas_fixas, function( $a, $b ){//Função responsável por ordenar

										$al = mb_strtolower($a['titulo']);
										$bl = mb_strtolower($b['titulo']);
										
										if ($al == $bl){
											return 0;
										}
										
										return ($bl < $al) ? +1 : -1;
										
									});
									
									echo'
									<option disabled>---------</option>
									<option disabled>PÁGINAS FIXAS</option>
									<option disabled>---------</option>
									';
									
									foreach( $paginas_fixas as $pag ){

										echo '<option value="'. $pag['pagina'] .'">'. $pag['titulo'] .'</option>';
										
									}
									
								?>
							</select>
						</span>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Prefixo Protocolo: </span>
					</div>
					<div class="col90">
						<input 
							name="prefixo_protocolo" 
						/>
					</div>
				</div>
				
				<div class="linha">
				
					<div class="col10">
						<span>Rascunho: </span>
					</div>
					<div class="col05">
						<span>
							<input 
								name="rascunho" 
								type="checkbox" 
							/>
						</span>
					</div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Formulário: </span>
					</div>
					<div class="col90">
						<input 
							name="formulario" 
							class="formulario_input" 
							required
						/>
					</div>
				</div>
				
				<div class="separador"></div>
				
				<div class="formulario_campo"></div>
				
				<div class="separador"></div>
				
				<div class="linha">
					<div class="col10">
						<span>Nome do campo: </span>
					</div>
					<div class="col20">
						<input 
							class="questaoNomeCampo"
							style="border-color:blue"
						/>
					</div>
					<div class="col05">
						<span>Comentário: </span>
					</div>
					<div class="col20">
						<input 
							class="questaoComentario"
							style="border-color:blue"
						/>
					</div>
					<div class="col05">
						<span>Tipo de campo: </span>
					</div>
					<div class="col10">
						<span>
							<select 
								class="questaoTipoCampo"
								style="border-color:blue"
							>
							
								<option value="">Tipo de campo</option>
								<option disabled></option>
								<option value="titulo">Título</option>
								<option value="subtitulo">Subtítulo</option>
								<option disabled></option>
								<option value="text">Texto Simples</option>
								<option value="email">E-mail</option>
								<option value="date">Data</option>
								<option value="time">Hora</option>
								<option value="datetime-local">Data e hora</option>
								<option value="textarea">Texto Longo</option>
								<option value="file">Enviar Arquivo</option>
								<option disabled></option>
								<option value="radio_s_n">Sim / Não</option>
								<option disabled></option>
								<option value="radio">Única opção</option>
								<option value="checkbox">Múltiplas opções</option>
								<option value="select">Gaveta</option>
								
							</select>
						</span>
					</div>
					<div class="col05">
						<span>Obrigatório: </span>
					</div>
					<div class="col05">
						<span>
							<select 
								class="questaoObrigatorio"
								style="border-color:blue"
							>
							
								<option value="nao">Não</option>
								<option value="sim">Sim</option>
								
							</select>
						</span>
					</div>
					<div class="col15">
						<span>
							<div class="btn" onclick="adicionarQuestao()">Adicionar questão</div>
						</span>
					</div>
				</div>

				<div class="separador"></div>
				
				<div class="linha-acao">
					
					<div class="col05">
						<span>
							<button type="submit">Gravar</button>
						</span>
					</div>
					<div class="col05">
						<span>
							<div class="btn" onclick="voltar()">Cancelar</div>
						</span>
					</div>
					<div class="col15">
						<span>
							<div class="btn vermelho" onclick="reiniciar()">Reiniciar Formulário</div>
						</span>
					</div>
					
				</div>
				
				<div class="separador"></div>
				
			</form>
			
			<div class="dialogo">
				<div class="dialogo-top">
					Diálogo
					<div 
						class="dialogo-fechar" 
						onclick="dialogoFechar()"
						style="background-image:url( '. $raiz_admin .'img/fechar.svg );"
					></div>
				</div>
				
				<div class="dialogo-conteudo"></div>
				
				<div class="dialogo-bottom">
				
					<div class="linha-acao">
					
						<div class="col05">
							<span>
								<div class="btn" onclick="dialogoFechar()">Voltar</div>
							</span>
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<script>
			
			function dialogoAtivar(){
				
				document.querySelector('.dialogo').classList.add('on');
				
			}
			function dialogoFechar(){
				
				document.querySelector('.dialogo-top').innerHTML = 'Diálogo';
				document.querySelector('.dialogo-conteudo').innerHTML = '';
				document.querySelector('.dialogo').classList.remove('on');
				
			}
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=formularios';
				
			}
			
			var counterQuestao = 0;
			
			function apagar(){
				
				let formulario_campo = document.querySelector('.formulario_campo');
				let formulario_input = document.querySelector('.formulario_input');
				
				formulario_campo.innerHTML = '';
				formulario_input.value = '';
				
			}
			
			function reiniciar(){
				
				let formulario_campo = document.querySelector('.formulario_campo');
				let formulario_input = document.querySelector('.formulario_input');
				
				formulario_campo.innerHTML = '';
				formulario_input.value = '';
				
			}
			
			function escreverOpcoes(
				questaoNomeCampo,
				questaoTipoCampo,
				questaoComentario, 
				counterQuestao,
				required
			){
				
				//console.log( 'questaoNomeCampo', questaoNomeCampo ); 
				//console.log( 'questaoTipoCampo', questaoTipoCampo ); 
				//console.log( 'questaoComentario', questaoComentario ); 
				//console.log( 'counterQuestao', counterQuestao ); 
				
				let opcao01 = document.querySelector( '.questao_'+ counterQuestao +'_opcao01' ).value;
				let opcao02 = document.querySelector( '.questao_'+ counterQuestao +'_opcao02' ).value;
				let opcao03 = document.querySelector( '.questao_'+ counterQuestao +'_opcao03' ).value;
				let opcao04 = document.querySelector( '.questao_'+ counterQuestao +'_opcao04' ).value;
				let opcao05 = document.querySelector( '.questao_'+ counterQuestao +'_opcao05' ).value;
				
				let span01 = document.querySelector( '.questao_'+ counterQuestao +'_span01' );
				let span02 = document.querySelector( '.questao_'+ counterQuestao +'_span02' );
				let span03 = document.querySelector( '.questao_'+ counterQuestao +'_span03' );
				let span04 = document.querySelector( '.questao_'+ counterQuestao +'_span04' );
				let span05 = document.querySelector( '.questao_'+ counterQuestao +'_span05' );
				let span06 = document.querySelector( '.questao_'+ counterQuestao +'_span06' );
				
				//console.log( 'opcao01', opcao01 ); 
				//console.log( 'opcao02', opcao02 ); 
				//console.log( 'opcao03', opcao03 ); 
				//console.log( 'opcao04', opcao04 ); 
				//console.log( 'opcao05', opcao05 ); 
				
				let formulario_input = document.querySelector('.formulario_input');
				
				formulario_input.value +=  ''+
				'questao_'+ counterQuestao +'_start;'+
				'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
				'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
				'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
				'questao_'+ counterQuestao +'_opcao01='+ opcao01 +';'+
				'questao_'+ counterQuestao +'_opcao02='+ opcao02 +';'+
				'questao_'+ counterQuestao +'_opcao03='+ opcao03 +';'+
				'questao_'+ counterQuestao +'_opcao04='+ opcao04 +';'+
				'questao_'+ counterQuestao +'_opcao05='+ opcao05 +';'+
				'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
				'questao_'+ counterQuestao +'_end;'+
				'';
				
				span01.innerHTML = '';
				span02.innerHTML = '';
				span03.innerHTML = '';
				span04.innerHTML = '';
				span05.innerHTML = '';
				span06.innerHTML = '';
				
				span01.innerHTML = opcao01;
				span02.innerHTML = opcao02;
				span03.innerHTML = opcao03;
				span04.innerHTML = opcao04;
				span05.innerHTML = opcao05;
				span06.innerHTML = ''+
					'<span>'+
						'<div '+
							'class="btn icone" '+
							'onclick="'+
								'editarQuestao( '+ counterQuestao +' );'+
							'"'+
						'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
						'<div '+
							'class="btn icone vermelho" '+
							'onclick="'+
								'apagarQuestao( '+ counterQuestao +' );'+
							'"'+
						'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
					'</span>'+
				'';
				
				document.querySelector('.questaoNomeCampo').value = '';
				document.querySelector('.questaoComentario').value = '';
				document.querySelector('.questaoTipoCampo').value = '';
				
			}
			
			function escreverOpcoesSelect(
				questaoNomeCampo,
				questaoTipoCampo,
				questaoComentario, 
				counterQuestao,
				required
			){
				
				//console.log( 'questaoNomeCampo', questaoNomeCampo ); 
				//console.log( 'questaoTipoCampo', questaoTipoCampo ); 
				//console.log( 'questaoComentario', questaoComentario ); 
				//console.log( 'counterQuestao', counterQuestao ); 
				
				let opcoes = document.querySelector( '.questao_'+ counterQuestao +'_opcoes' ).value;
				
				let span01 = document.querySelector( '.questao_'+ counterQuestao +'_span01' );
				let span06 = document.querySelector( '.questao_'+ counterQuestao +'_span06' );
				
				//console.log( 'opcoes', opcoes ); 
				
				const opcoes_array = opcoes.split(",");
				//console.log( 'opcoes_array', opcoes_array );
				
				let opcoes_html = '';
				
				for( var opt_i in opcoes_array ) {
					
					opcoes_html += '<option>'+ opcoes_array[opt_i] +'</option>';
					
				}
				
				//console.log( 'opcoes_html', opcoes_html );
				
				let formulario_input = document.querySelector('.formulario_input');
				
				formulario_input.value +=  ''+
				'questao_'+ counterQuestao +'_start;'+
				'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
				'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
				'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
				
				'questao_'+ counterQuestao +'_opcoes='+ opcoes +';'+
				
				'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
				'questao_'+ counterQuestao +'_end;'+
				'';
				
				span01.innerHTML = '';
				
				span01.innerHTML = ''+
					'<span>'+
						'<select class="contato-form-input questao_'+ counterQuestao +' select">'+ opcoes_html +'</select>'+
					'</span>'+
				'';
				span06.innerHTML = ''+
					'<span>'+
						'<div '+
							'class="btn icone" '+
							'onclick="'+
								'editarQuestao( '+ counterQuestao +' );'+
							'"'+
						'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
						'<div '+
							'class="btn icone vermelho" '+
							'onclick="'+
								'apagarQuestao( '+ counterQuestao +' );'+
							'"'+
						'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
					'</span>'+
				'';
				
				document.querySelector('.questaoNomeCampo').value = '';
				document.querySelector('.questaoComentario').value = '';
				document.querySelector('.questaoTipoCampo').value = '';
				
			}
			
			function apagarQuestao( counterQuestao ){
				
				let formulario_campo = document.querySelector('.formulario_campo');
				let formulario_input = document.querySelector('.formulario_input').value;
				
				//console.log( 'formulario_input', formulario_input ); 
				
				const formulario_input_array01 = formulario_input.split("questao_"+ counterQuestao +"_start;");
				//console.log( 'formulario_input_array01[0]', formulario_input_array01[0] ); 
				
				const formulario_input_array02 = formulario_input.split("questao_"+ counterQuestao +"_end;");
				//console.log( 'formulario_input_array02[1]', formulario_input_array02[1] ); 
				
				document.querySelector('.formulario_input').value = '';
				document.querySelector('.formulario_input').value = formulario_input_array01[0] + formulario_input_array02[1];
				//console.log( 'document.querySelector(.formulario_input).value', document.querySelector('.formulario_input').value ); 
				
				document.querySelector( '.questao_'+ counterQuestao ).remove();
				
			}
			
			function editarQuestaoSet( counterQuestao, tipo ){
				
				//console.log( 'counterQuestao', counterQuestao ); 
				//console.log( 'tipo', tipo ); 
				
				let formulario_input = document.querySelector('.formulario_input').value;
				//console.log( 'formulario_input', formulario_input ); 
				
				const formulario_input_array01 = formulario_input.split("questao_"+ counterQuestao +"_start;");
				//console.log( 'formulario_input_array01[0]', formulario_input_array01[0] ); 
				
				const formulario_input_array02 = formulario_input.split("questao_"+ counterQuestao +"_end;");
				//console.log( 'formulario_input_array02[1]', formulario_input_array02[1] );
				
				const formulario_input_alvo_array01 = formulario_input_array01[1];
				//console.log( 'formulario_input_alvo_array01', formulario_input_alvo_array01 );
				
				const formulario_input_alvo_array02 = formulario_input_alvo_array01.split("questao_"+ counterQuestao +"_end;");
				//console.log( 'formulario_input_alvo_array02', formulario_input_alvo_array02 );
				
				const formulario_input_alvo = formulario_input_alvo_array02[0];
				//console.log( 'formulario_input_alvo', formulario_input_alvo );
				
				const alvo_array = formulario_input_alvo.split(";");
				//console.log( 'alvo_array', alvo_array );
				
				let novoCampo = '';
				let novoComentario = '';
				let novoTipo = '';
				let novoObrigatorio = '';
				let novoOpcao01 = '';
				let novoOpcao02 = '';
				let novoOpcao03 = '';
				let novoOpcao04 = '';
				let novoOpcao05 = '';
				let novoOpcoes = '';
				
				for( var i in alvo_array ) {
	
					if( alvo_array[i] ){
						
						//console.log( alvo_array[i] );
						
						const alvo_i_array = alvo_array[i].split("=");
						//console.log( 'alvo_i_array', alvo_i_array );
						
						const alvo_i_tipo_array = alvo_i_array[0].split("_");
						//console.log( 'alvo_i_tipo_array', alvo_i_tipo_array );
						
						let alvo_i_tipo = alvo_i_tipo_array[2];
						//console.log( 'alvo_i_tipo', alvo_i_tipo );
						
						if( alvo_i_tipo == 'campo' ){ novoCampo = alvo_i_array[1]; }
						if( alvo_i_tipo == 'comentario' ){ novoComentario = alvo_i_array[1]; }
						if( alvo_i_tipo == 'tipo' ){ novoTipo = alvo_i_array[1]; }
						if( alvo_i_tipo == 'opcao01' ){ novoOpcao01 = alvo_i_array[1]; }
						if( alvo_i_tipo == 'opcao02' ){ novoOpcao02 = alvo_i_array[1]; }
						if( alvo_i_tipo == 'opcao03' ){ novoOpcao03 = alvo_i_array[1]; }
						if( alvo_i_tipo == 'opcao04' ){ novoOpcao04 = alvo_i_array[1]; }
						if( alvo_i_tipo == 'opcao05' ){ novoOpcao05 = alvo_i_array[1]; }
						if( alvo_i_tipo == 'obrigatorio' ){ novoObrigatorio = alvo_i_array[1]; }
						
					}
					
				}
				
				if( tipo == 'campo' ){
					
					novoCampo = '';
					novoCampo = document.querySelector(".modificar_campo").value;
					//console.log( 'novoCampo', novoCampo );

					document.querySelector( '.questao_'+ counterQuestao +' .questao_campo' ).innerHTML = novoCampo;					
					
				}
				
				if( tipo == 'comentario' ){
					
					novoComentario = '';
					novoComentario = document.querySelector(".modificar_comentario").value;
					//console.log( 'novoComentario', novoComentario ); 
					
					document.querySelector( '.questao_'+ counterQuestao +' .questao_comentario' ).innerHTML = novoComentario;		
					
				}
				
				if( tipo == 'tipo' ){
					
					novoTipo = '';
					novoTipo = document.querySelector(".modificar_tipo").value;
					//console.log( 'novoTipo', novoTipo ); 
					
					if( 
						novoTipo == 'text'
						|| novoTipo == 'email'
						|| novoTipo == 'date'
						|| novoTipo == 'time'
						|| novoTipo == 'datetime-local'
						|| novoTipo == 'file'
					){ 
					
						if( document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ) ){
							
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '';
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '<div class="col10"><span class="questao_tipo"></span></div>';
							
						}
						
						document.querySelector( '.questao_'+ counterQuestao +' .questao_tipo' ).innerHTML = '<input type="'+ novoTipo +'" disabled/>'; 
						
					}
					
					if( novoTipo == 'textarea' ){ 
						
						if( document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ) ){
							
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '';
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '<div class="col10"><span class="questao_tipo"></span></div>';
							
						}
						
						document.querySelector( '.questao_'+ counterQuestao +' .questao_tipo' ).innerHTML = '<textarea></textarea>'; 
						
					}
					
					if( novoTipo == 'radio' ){ 
						
						if( document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ) ){
							
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '';
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '<div class="col10"><span class="questao_tipo"></span></div>';
							
						}
						
						document.querySelector( '.questao_'+ counterQuestao +' .questao_tipo' ).innerHTML = 'editando radio...'; 
						
					}
					
					if( novoTipo == 'checkbox' ){ 
						
						if( document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ) ){
							
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '';
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '<div class="col10"><span class="questao_tipo"></span></div>';
							
						}
						
						document.querySelector( '.questao_'+ counterQuestao +' .questao_tipo' ).innerHTML = 'editando checkbox...'; 
						
					}
					
					if( novoTipo == 'select' ){ 
						
						if( document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ) ){
							
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '';
							document.querySelector( '.questao_'+ counterQuestao +' .questao_radio_s_n' ).innerHTML = '<div class="col10"><span class="questao_tipo"></span></div>';
							
						}
						
						document.querySelector( '.questao_'+ counterQuestao +' .questao_tipo' ).innerHTML = 'editando select...'; 
						
					}
					
				}
				
				if( tipo == 'obrigatorio' ){
					
					novoObrigatorio = '';
					novoObrigatorio = document.querySelector(".modificar_obrigatorio").value;
					//console.log( 'novoObrigatorio', novoObrigatorio ); 
					
					let novoObrigatorioHTML = '';
					
					if( novoObrigatorio == 'required' ){ novoObrigatorioHTML = 'Obrigatório'; }
					
					document.querySelector( '.questao_'+ counterQuestao +' .questao_obrigatorio' ).innerHTML = novoObrigatorioHTML;		
					
				}
				
				if( tipo == 'opcao01' ){
					
					novoOpcao01 = '';
					novoOpcao01 = document.querySelector(".modificar_opcao01").value;
					//console.log( 'novoOpcao01', novoOpcao01 ); 
					
					document.querySelector( '.questao_'+ counterQuestao +'_opcao01' ).innerHTML = novoOpcao01;
					
				}
				
				if( tipo == 'opcao02' ){
					
					novoOpcao02 = '';
					novoOpcao02 = document.querySelector(".modificar_opcao02").value;
					//console.log( 'novoOpcao02', novoOpcao02 ); 
					
					document.querySelector( '.questao_'+ counterQuestao +'_opcao02' ).innerHTML = novoOpcao02;
					
				}
				
				if( tipo == 'opcao03' ){
					
					novoOpcao03 = '';
					novoOpcao03 = document.querySelector(".modificar_opcao03").value;
					//console.log( 'novoOpcao03', novoOpcao03 ); 
					
					document.querySelector( '.questao_'+ counterQuestao +'_opcao03' ).innerHTML = novoOpcao03;
					
				}
				
				if( tipo == 'opcao04' ){
					
					novoOpcao04 = '';
					novoOpcao04 = document.querySelector(".modificar_opcao04").value;
					//console.log( 'novoOpcao04', novoOpcao04 ); 
					
					document.querySelector( '.questao_'+ counterQuestao +'_opcao04' ).innerHTML = novoOpcao04;
					
				}
				
				if( tipo == 'opcao05' ){
					
					novoOpcao05 = '';
					novoOpcao05 = document.querySelector(".modificar_opcao05").value;
					//console.log( 'novoOpcao05', novoOpcao05 ); 
					
					document.querySelector( '.questao_'+ counterQuestao +'_opcao05' ).innerHTML = novoOpcao05;
					
				}
				
				if( tipo == 'select' ){

					novoOpcoes = '';
					novoOpcoes = document.querySelector(".modificar_opcoes").value;
					//console.log( 'novoOpcoes', novoOpcoes );
					
					const novoOpcoes_array = novoOpcoes.split(",");
					//console.log( 'novoOpcoes_array', novoOpcoes_array );
					
					let novoOpcoes_html = '';
					
					for( var opt_i in novoOpcoes_array ) {
						
						novoOpcoes_html += '<option>'+ novoOpcoes_array[opt_i] +'</option>';
						
					}
					
					//console.log( 'novoOpcoes_html', novoOpcoes_html );

					document.querySelector( '.questao_'+ counterQuestao +' .select' ).innerHTML = novoOpcoes_html;					
					
				}
				
				var novoItemTexto = '';
				
				if( tipo != 'select' ){
				
					novoItemTexto = ''+
						'questao_'+ counterQuestao +'_start;'+
						'questao_'+ counterQuestao +'_campo='+ novoCampo +';'+
						'questao_'+ counterQuestao +'_comentario='+ novoComentario +';'+
						'questao_'+ counterQuestao +'_tipo='+ novoTipo +';'+
						'questao_'+ counterQuestao +'_opcao01='+ novoOpcao01 +';'+
						'questao_'+ counterQuestao +'_opcao02='+ novoOpcao02 +';'+
						'questao_'+ counterQuestao +'_opcao03='+ novoOpcao03 +';'+
						'questao_'+ counterQuestao +'_opcao04='+ novoOpcao04 +';'+
						'questao_'+ counterQuestao +'_opcao05='+ novoOpcao05 +';'+
						'questao_'+ counterQuestao +'_obrigatorio='+ novoObrigatorio +';'+
						'questao_'+ counterQuestao +'_end;'+
					'';
					
					//console.log( 'novoItemTexto: ', novoItemTexto );
					
				}
				
				if( tipo == 'select' ){
				
					novoItemTexto = ''+
						'questao_'+ counterQuestao +'_start;'+
						'questao_'+ counterQuestao +'_campo='+ novoCampo +';'+
						'questao_'+ counterQuestao +'_comentario='+ novoComentario +';'+
						'questao_'+ counterQuestao +'_tipo='+ novoTipo +';'+
						'questao_'+ counterQuestao +'_opcoes='+ novoOpcoes +';'+
						'questao_'+ counterQuestao +'_obrigatorio='+ novoObrigatorio +';'+
						'questao_'+ counterQuestao +'_end;'+
					'';
					
					//console.log( 'novoItemTexto: ', novoItemTexto );
					
				}
				
				let resultado = formulario_input_array01[0] + novoItemTexto + formulario_input_array02[1];
				//console.log( 'resultado: ', resultado );
				
				document.querySelector('.formulario_input').value = resultado;

				dialogoFechar();
				
			}
			
			function editarQuestao( counterQuestao ){
				
				dialogoAtivar();
				
				let formulario_campo = document.querySelector('.formulario_campo');
				let formulario_input = document.querySelector('.formulario_input').value;
				
				//console.log( 'formulario_input', formulario_input ); 
				
				//console.log( 'questao_'+ counterQuestao ); 
				
				const formulario_input_array01 = formulario_input.split("questao_"+ counterQuestao +"_start;");
				//console.log( 'formulario_input_array01[1]', formulario_input_array01[1] ); 
				
				const formulario_input_array02 = formulario_input_array01[1].split("questao_"+ counterQuestao +"_end;");
				//console.log( 'formulario_input_array02[0]', formulario_input_array02[0] ); 
				
				document.querySelector('.dialogo-top').innerHTML = 'Questão '+ counterQuestao;
				
				const questao_array = formulario_input_array02[0].split(";");
				//console.log( 'questao_array', questao_array ); 
				
				const tipo_de_input_array01 = questao_array[2].split("_");
				//console.log( 'tipo_de_input_array01', tipo_de_input_array01 ); 
				
				const tipo_de_input_array02 = tipo_de_input_array01[2].split("=");
				//console.log( 'tipo_de_input_array02', tipo_de_input_array02 ); 
				
				let tipo_de_input = tipo_de_input_array02[1];
				
				for( var questao_array_n in questao_array ) {
	
					//console.log( questao_array[questao_array_n] );
					
					const questao_array_campo_array = questao_array[questao_array_n].split("_");
					//console.log( questao_array_campo_array );
					
					if( questao_array_campo_array[2] ){
						
						const questao_array_campo_item_array = questao_array_campo_array[2].split("=");
						//console.log( questao_array_campo_item_array );
						
						if( questao_array_campo_item_array[0] == 'campo' ){
							
							document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
								'<div class="linha linha-auto">'+
									'<div class="col10"><span>Campo:</span></div>'+
									'<div class="col30">'+
										'<span>'+
											'<input '+
												'value="'+ questao_array_campo_item_array[1] +'"'+
												'class="modificar_campo"'+
											'/>'+
										'</span>'+
									'</div>'+
									'<div class="col05">'+
										'<span>'+
											'<div '+
												'class="btn btnEditarQuestao"'+
												'onclick="editarQuestaoSet( '+ counterQuestao +', `campo` )"'+
											'>Gravar</div>'+
										'</span>'+
									'</div>'+
								'</div>'+
							'';
							
						}
						
						if( questao_array_campo_item_array[0] == 'comentario' ){
							
							document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
								'<div class="linha linha-auto">'+
									'<div class="col10"><span>Comentário:</span></div>'+
									'<div class="col30">'+
										'<span>'+
											'<input '+
												'value="'+ questao_array_campo_item_array[1] +'"'+
												'class="modificar_comentario"'+
											'/>'+
										'</span>'+
									'</div>'+
									'<div class="col05">'+
										'<span>'+
											'<div '+
												'class="btn btnEditarQuestao"'+
												'onclick="editarQuestaoSet( '+ counterQuestao +', `comentario` )"'+
											'>Gravar</div>'+
										'</span>'+
									'</div>'+
								'</div>'+
							'';
							
						}
						
						if( questao_array_campo_item_array[0] == 'tipo' ){
							
							let selected_titulo = '';
							let selected_subtitulo = '';
							let selected_text = '';
							let selected_email = '';
							let selected_date = '';
							let selected_time = '';
							let selected_datetime = '';
							let selected_textarea = '';
							let selected_file = '';
							let selected_radio_s_n = '';
							let selected_radio = '';
							let selected_checkbox = '';
							let selected_select = '';
							
							if( questao_array_campo_item_array[1] == 'titulo' ){ selected_titulo = 'selected'; }
							if( questao_array_campo_item_array[1] == 'subtitulo' ){ selected_subtitulo = 'selected'; }
							if( questao_array_campo_item_array[1] == 'text' ){ selected_text = 'selected'; }
							if( questao_array_campo_item_array[1] == 'email' ){ selected_email = 'selected'; }
							if( questao_array_campo_item_array[1] == 'date' ){ selected_date = 'selected'; }
							if( questao_array_campo_item_array[1] == 'time' ){ selected_time = 'selected'; }
							if( questao_array_campo_item_array[1] == 'datetime' ){ selected_datetime = 'selected'; }
							if( questao_array_campo_item_array[1] == 'textarea' ){ selected_textarea = 'selected'; }
							if( questao_array_campo_item_array[1] == 'file' ){ selected_file = 'selected'; }
							if( questao_array_campo_item_array[1] == 'radio_s_n' ){ selected_radio_s_n = 'selected'; }
							if( questao_array_campo_item_array[1] == 'radio' ){ selected_radio = 'selected'; }
							if( questao_array_campo_item_array[1] == 'checkbox' ){ selected_checkbox = 'selected'; }
							if( questao_array_campo_item_array[1] == 'select' ){ selected_select = 'selected'; }
							
							tipo_de_input = questao_array_campo_item_array[1];
							
							document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
								'<div class="linha linha-auto">'+
									'<div class="col10"><span>Tipo:</span></div>'+
									'<div class="col30">'+
										'<span>'+
											'<select '+
												'class="modificar_tipo"'+
											'>'+
												'<option '+ selected_titulo +' value="text">Título</option>'+
												'<option '+ selected_subtitulo +' value="text">Subtítulo</option>'+
												'<option '+ selected_text +' value="text">Texto Simples</option>'+
												'<option '+ selected_email +' value="email">E-mail</option>'+
												'<option '+ selected_date +' value="date">Data</option>'+
												'<option '+ selected_time +' value="time">Hora</option>'+
												'<option '+ selected_datetime +' value="datetime-local">Data e hora</option>'+
												'<option '+ selected_textarea +' value="textarea">Texto Longo</option>'+
												'<option '+ selected_file +' value="file">Enviar Arquivo</option>'+
												'<option '+ selected_radio_s_n +' value="radio_s_n">Sim / Não</option>'+
												'<option '+ selected_radio +' value="radio">Única opção</option>'+
												'<option '+ selected_checkbox +' value="checkbox">Múltiplas opções</option>'+
												'<option '+ selected_select +' value="select">Gaveta</option>'+
											'</select>'+
										'</span>'+
									'</div>'+
									'<div class="col05">'+
										'<span>'+
											'<div '+
												'class="btn btnEditarQuestao"'+
												'onclick="editarQuestaoSet( '+ counterQuestao +', `tipo` )"'+
											'>Gravar</div>'+
										'</span>'+
									'</div>'+
								'</div>'+
							'';
							
						}
						
						if( questao_array_campo_item_array[0] == 'obrigatorio' ){

							let selected_nao = '';
							let selected_sim = '';
							
							if( questao_array_campo_item_array[1] == '' ){ selected_nao = 'selected'; }
							if( questao_array_campo_item_array[1] == 'required' ){ selected_sim = 'selected'; }
							
							document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
								'<div class="linha linha-auto">'+
									'<div class="col10"><span>Obrigatório:</span></div>'+
									'<div class="col30">'+
										'<span>'+
											'<select '+
												'class="modificar_obrigatorio"'+
											'>'+
												'<option '+ selected_nao +' value="">Não</option>'+
												'<option '+ selected_sim +' value="required">Sim</option>'+
											'</select>'+
										'</span>'+
									'</div>'+
									'<div class="col05">'+
										'<span>'+
											'<div '+
												'class="btn btnEditarQuestao"'+
												'onclick="editarQuestaoSet( '+ counterQuestao +', `obrigatorio` )"'+
											'>Gravar</div>'+
										'</span>'+
									'</div>'+
								'</div>'+
							'';
						
						}
						
						if( 
							tipo_de_input == 'radio' 
							|| tipo_de_input == 'checkbox' 
						){
						
							if( questao_array_campo_item_array[0] == 'opcao01' ){

								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opção 01:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcao01"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `opcao01` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
							if( questao_array_campo_item_array[0] == 'opcao02' ){
								
								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opção 02:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcao02"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `opcao02` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
							if( questao_array_campo_item_array[0] == 'opcao03' ){
								
								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opção 03:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcao03"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `opcao03` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
							if( questao_array_campo_item_array[0] == 'opcao04' ){
								
								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opção 04:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcao04"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `opcao04` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
							if( questao_array_campo_item_array[0] == 'opcao05' ){
								
								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opção 05:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcao05"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `opcao05` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
						}
						
						if( tipo_de_input == 'select' ){
							
							if( questao_array_campo_item_array[0] == 'opcoes' ){
								
								document.querySelector('.dialogo-conteudo').innerHTML += ''+ 
									'<div class="linha linha-auto">'+
										'<div class="col10"><span>Opções:</span></div>'+
										'<div class="col30">'+
											'<span>'+
												'<input '+
													'value="'+ questao_array_campo_item_array[1] +'"'+
													'class="modificar_opcoes"'+
												'/>'+
											'</span>'+
										'</div>'+
										'<div class="col05">'+
											'<span>'+
												'<div '+
													'class="btn btnEditarQuestao"'+
													'onclick="editarQuestaoSet( '+ counterQuestao +', `select` )"'+
												'>Gravar</div>'+
											'</span>'+
										'</div>'+
									'</div>'+
								'';
								
							}
							
						}
						
					}
					
				}
				
			}
			
			function adicionarQuestao(){
				
				let formulario_campo = document.querySelector('.formulario_campo');
				let formulario_input = document.querySelector('.formulario_input');
				
				let questaoNomeCampo = document.querySelector('.questaoNomeCampo').value;
				let questaoComentario = document.querySelector('.questaoComentario').value;
				let questaoTipoCampo = document.querySelector('.questaoTipoCampo').value;
				let questaoObrigatorio = document.querySelector('.questaoObrigatorio').value;
				
				if( 
					questaoNomeCampo == '' 
					|| questaoTipoCampo == '' 
				){ return; }
				
				counterQuestao++;
				
				//console.log( 'questaoNomeCampo', questaoNomeCampo ); 
				//console.log( 'questaoTipoCampo', questaoTipoCampo ); 
				//console.log( 'questaoComentario', questaoComentario ); 
				//console.log( 'counterQuestao', counterQuestao ); 
				//console.log( 'questaoObrigatorio', questaoObrigatorio ); 
				
				let required = '';
				let obrigatorio = '';
				
				if( questaoObrigatorio == 'sim' ){ 
					required = 'required'; 
					obrigatorio = 'Obrigatório'; 
				}
				
				if( questaoTipoCampo == 'titulo'){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span class="questao_campo">'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span class="questao_tipo">'+ questaoTipoCampo +'</span></div>'+
						'<div class="col15"><span class="questao_comentario">'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span class="questao_obrigatorio">'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=;'+
					'questao_'+ counterQuestao +'_opcao02=;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				if( questaoTipoCampo == 'subtitulo'){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span class="questao_campo">'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span class="questao_tipo">'+ questaoTipoCampo +'</span></div>'+
						'<div class="col15"><span class="questao_comentario">'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span class="questao_obrigatorio">'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=;'+
					'questao_'+ counterQuestao +'_opcao02=;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				
				if(
					questaoTipoCampo == 'text'
					|| questaoTipoCampo == 'email'
					|| questaoTipoCampo == 'date'
					|| questaoTipoCampo == 'time'
					|| questaoTipoCampo == 'datetime-local'
				){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span class="questao_campo">'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span class="questao_tipo"><input type="'+ questaoTipoCampo +'" disabled/></span></div>'+
						'<div class="col15"><span class="questao_comentario">'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span class="questao_obrigatorio">'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=;'+
					'questao_'+ counterQuestao +'_opcao02=;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				
				if( questaoTipoCampo == 'textarea'){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span class="questao_campo">'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span class="questao_tipo"><textarea disabled></textarea></span></div>'+
						'<div class="col15"><span class="questao_comentario">'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span class="questao_obrigatorio">'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=;'+
					'questao_'+ counterQuestao +'_opcao02=;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				
				if( questaoTipoCampo == 'file' ){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span>'+ questaoNomeCampo +'</span></div>'+
						'<div class="col30"><input type="'+ questaoTipoCampo +'" disabled style="display:block"/></div>'+
						'<div class="col15"><span>'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span>'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=;'+
					'questao_'+ counterQuestao +'_opcao02=;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				
				if( questaoTipoCampo == 'radio_s_n' ){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span>'+ questaoNomeCampo +'</span></div>'+
						'<div class="col05"><span><input type="radio" value="sim" disabled checked/></span></div>'+
						'<div class="col05"><span>Sim</span></div>'+
						'<div class="col05"><span><input type="radio" value="nao" disabled/></span></div>'+
						'<div class="col05"><span>Não</span></div>'+
						'<div class="col15"><span>'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span>'+ obrigatorio +'</span></div>'+
						'<div class="col10 acao">'+
							'<span>'+
								'<div '+
									'class="btn icone" '+
									'onclick="'+
										'editarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/editar.svg'; ?></span></div>'+
								'<div '+
									'class="btn icone vermelho" '+
									'onclick="'+
										'apagarQuestao( '+ counterQuestao +' );'+
									'"'+
								'><span><?php require $raiz_admin .'img/excluir.svg'; ?></span></div>'+
							'</span>'+
						'</div>'+
					'</div>'+
					'';
					
					formulario_input.value +=  ''+
					'questao_'+ counterQuestao +'_start;'+
					'questao_'+ counterQuestao +'_campo='+ questaoNomeCampo +';'+
					'questao_'+ counterQuestao +'_comentario='+ questaoComentario +';'+
					'questao_'+ counterQuestao +'_tipo='+ questaoTipoCampo +';'+
					'questao_'+ counterQuestao +'_opcao01=sim;'+
					'questao_'+ counterQuestao +'_opcao02=nao;'+
					'questao_'+ counterQuestao +'_opcao03=;'+
					'questao_'+ counterQuestao +'_opcao04=;'+
					'questao_'+ counterQuestao +'_opcao05=;'+
					'questao_'+ counterQuestao +'_obrigatorio='+ required +';'+
					'questao_'+ counterQuestao +'_end;'+
					'';
					
					document.querySelector('.questaoNomeCampo').value = '';
					document.querySelector('.questaoComentario').value = '';
					document.querySelector('.questaoTipoCampo').value = '';
					
				}
				
				if( 
					questaoTipoCampo == 'radio' 
					|| questaoTipoCampo == 'checkbox'
				){
				
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'">'+
						'<div class="col10"><span>'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span class="questao_'+ counterQuestao +'_span01"><input type="text" class="questao_'+ counterQuestao +'_opcao01 bordaAzul" /></span></div>'+
						'<div class="col10"><span class="questao_'+ counterQuestao +'_span02"><input type="text" class="questao_'+ counterQuestao +'_opcao02 bordaAzul" /></span></div>'+
						'<div class="col10"><span class="questao_'+ counterQuestao +'_span03"><input type="text" class="questao_'+ counterQuestao +'_opcao03 bordaAzul" /></span></div>'+
						'<div class="col10"><span class="questao_'+ counterQuestao +'_span04"><input type="text" class="questao_'+ counterQuestao +'_opcao04 bordaAzul" /></span></div>'+
						'<div class="col10"><span class="questao_'+ counterQuestao +'_span05"><input type="text" class="questao_'+ counterQuestao +'_opcao05 bordaAzul" /></span></div>'+
						'<div class="col10"><span>'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span>'+ obrigatorio +'</span></div>'+
						'<div class="col10">'+
							'<span>'+
								'<div '+
									'class="btn btn_concluir" '+
									'onclick="'+
										'escreverOpcoes('+
											'`'+ questaoNomeCampo +'`, '+
											'`'+ questaoTipoCampo +'`, '+
											'`'+ questaoComentario +'`, '+
											'`'+ counterQuestao +'`, '+
											'`'+ required +'` '+
										');'+
										'this.classList.add(`off`);'+
									'"'+
								'>Concluir</div>'+
							'</span>'+
						'</div>'+
						'<div class="col10 acao"><span class="questao_'+ counterQuestao +'_span06"></span></div>'+
					'</div>'+
					'';
					
				}
				
				if( questaoTipoCampo == 'select' ){
					
					formulario_campo.innerHTML += ''+
					'<div class="linha linha-auto questao_'+ counterQuestao +'" style="height:10vw;">'+
						'<div class="col10"><span>'+ questaoNomeCampo +'</span></div>'+
						'<div class="col10"><span>'+ questaoComentario +'</span></div>'+
						'<div class="col05"><span>'+ obrigatorio +'</span></div>'+
						
						'<div class="col40"><span class="questao_'+ counterQuestao +'_span01"><textarea class="questao_'+ counterQuestao +'_opcoes bordaAzul"></textarea></span></div>'+
						'<div class="col10"><span>Separe as opções por ,</span></div>'+
						
						'<div class="col10">'+
							'<span>'+
								'<div '+
									'class="btn btn_concluir" '+
									'onclick="'+
										'escreverOpcoesSelect('+
											'`'+ questaoNomeCampo +'`, '+
											'`'+ questaoTipoCampo +'`, '+
											'`'+ questaoComentario +'`, '+
											'`'+ counterQuestao +'`, '+
											'`'+ required +'` '+
										');'+
										'this.classList.add(`off`);'+
									'"'+
								'>Concluir</div>'+
							'</span>'+
						'</div>'+
						'<div class="col10 acao"><span class="questao_'+ counterQuestao +'_span06"></span></div>'+
					'</div>'+
					'';
					
				}
				
			}
			
		</script>
		
	</body>
</html>