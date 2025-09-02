<!-- Start - view/cadastro-ciptea.php !-->
<?php

foreach( $paginas_fixas as $item ){

	if( $item['pagina'] == $_GET['pagina'] ){
		$conteudo_texto = $item['texto'];
	}

}

?>

<style>
	<?php 
		require 'css/cadastro-ciptea.css'; 
		require 'css/formularios.css'; 
	?>
</style>

<section class="cadastro-ciptea">

	<div class="box">

		<div class="cadastro-ciptea-campo"><?php echo $conteudo_texto ?></div>
		<div class="cadastro-ciptea-form">

			<form 
				action="controller/cadastro-ciptea.php" 
				method="POST" 
				enctype="multipart/form-data"
			>
				
				<input 
					type="text" 
					name="formulario_id" 
					value="1" 
					style="display:none" 
				/>

				<div class="formularios-titulo">FICHA CADASTRAL - CIPTEA </div>
				<div class="formularios-comentario"><strong>Obs: campos <span style="color:red">VERMELHOS</span> são obrigatórios.</strong></div>

				<div class="formularios-separador"></div>

				<div class="formularios-titulo">IDENTIFICAÇÃO DA PESSOA COM AUTISMO</div>

				<div class="formularios-linha">Nome completo da pessoa com autismo:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="nome" 
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Nascimento:</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="data_nasc" 
						required 
					/>
				</div>

				<div class="formularios-linha">Local de Nascimento:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="local_nasc" 
						required 
					/>
				</div>

				<div class="formularios-linha">Idade:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="idade" 
						required 
					/>
				</div>

				<div class="formularios-linha">Sexo:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="sexo" 
							value="feminino"
							checked
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Feminino</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="sexo" 
							value="masculino"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Masculino</div>
				</div>

				<div class="formularios-linha">RG:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg" 
						placeholder="Número e dígito do RG"
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Emissão do RG:</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="rg_emissao" 
						required 
					/>
				</div>

				<div class="formularios-linha">Órgão de Emissão do RG:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg_orgao" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do RG:</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input rg_img" 
						name="rg_img" 
						required 
					/>
					<input 
						type="text" 
						class="rg_img_arquivo" 
						name="rg_img_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.rg_img').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'rg_img' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">CPF:</div>
				<div class="formularios-comentario">Informe o seu CPF. CPFs inválidos serão desconsiderados.</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cpf" 
						placeholder="000.000.000-00"
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do CPF: (somente se não houver o número no RG)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input cpf_img" 
						name="cpf_img"  
					/>
					<input 
						type="text" 
						class="cpf_img_arquivo" 
						name="cpf_img_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.cpf_img').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'cpf_img' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">Tipo Sanguíneo: (Obrigatório na CIPTEA)</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="tipo_sanguineo" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar foto da criança (Foto x ou Foto para inserção no documento)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input foto_crianca" 
						name="foto_crianca" 
						required 
					/>
					<input 
						type="text" 
						class="foto_crianca_arquivo" 
						name="foto_crianca_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.foto_crianca').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name,'foto_crianca' );
							
						});
					</script>
				</div>

				<div class="formularios-titulo">ENDEREÇO E IDENTIFICAÇÃO DOS RESPONSÁVEIS</div>

				<div class="formularios-titulo">Mãe / Tutora</div>

				<div class="formularios-linha">Nome completo da mãe/Tutor:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="nome_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Idade:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="idade_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Nascimento:</div>
				<div class="formularios-comentario">Informe a Data no formato dd/mm/yyyy</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="nasc_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">RG:</div>
				<div class="formularios-comentario">Número e dígito do RG</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Emissão do RG:</div>
				<div class="formularios-comentario">Informe a Data no formato dd/mm/yyyy</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="rg_emissao_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Órgão de Emissão do RG:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg_orgao_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do RG:</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input foto_crianca_mae_tutor" 
						name="foto_crianca_mae_tutor" 
						required 
					/>
					<input 
						type="text" 
						class="foto_crianca_mae_tutor_arquivo" 
						name="foto_crianca_mae_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.foto_crianca_mae_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'foto_crianca_mae_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">CPF:</div>
				<div class="formularios-comentario">Informe o seu CPF. CPFs inválidos serão desconsiderados.</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cpf_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do CPF: (somente se não houver o número no RG)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input cpf_img_mae_tutor" 
						name="cpf_img_mae_tutor"  
					/>
					<input 
						type="text" 
						class="cpf_img_mae_tutor_arquivo" 
						name="cpf_img_mae_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.cpf_img_mae_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'cpf_img_mae_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">Profissão:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="profissao_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Horário de Trabalho:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="horario_trabalho_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Telefone Celular:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="telefone_celular_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Telefone Comercial:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="telefone_comercial_mae_tutor" 
					/>
				</div>

				<div class="formularios-linha">Facebook:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="facebook_mae_tutor" 
					/>
				</div>

				<div class="formularios-linha">Instagram:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="instagram_mae_tutor" 
					/>
				</div>

				<div class="formularios-linha">E-mail:</div>
				<div class="formularios-comentario">Informe o seu e-mail legítimo</div>
				<div class="formularios-linha">
					<input 
						type="email" 
						class="contato-form-input" 
						name="email_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Endereço: (Rua/Avenida/etc)</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Número:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_numero_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Complemento:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_complemento_mae_tutor" 
					/>
				</div>

				<div class="formularios-linha">Bairro:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="bairro_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Zona:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_mae_tutor" 
							value="centro"
							checked
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Centro</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_mae_tutor" 
							value="norte"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Norte</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_mae_tutor" 
							value="sul"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sul</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_mae_tutor" 
							value="leste"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Leste</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_mae_tutor" 
							value="oeste"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Oeste</div>
				</div>

				<div class="formularios-linha">Município:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="municipio_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">CEP:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cep_mae_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar comprovante de endereço (recente)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input comprovante_endereco_mae_tutor" 
						name="comprovante_endereco_mae_tutor" 
						required 
					/>
					<input 
						type="text" 
						class="comprovante_endereco_mae_tutor_arquivo" 
						name="comprovante_endereco_mae_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.comprovante_endereco_mae_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'comprovante_endereco_mae_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-titulo">Pai / Tutor</div>

				<div class="formularios-linha">Nome completo da pai / tutor:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="nome_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Idade:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="idade_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Nascimento:</div>
				<div class="formularios-comentario">Informe a Data no formato dd/mm/yyyy</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="nasc_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">RG:</div>
				<div class="formularios-comentario">Número e dígito do RG</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Data de Emissão do RG:</div>
				<div class="formularios-comentario">Informe a Data no formato dd/mm/yyyy</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="rg_emissao_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Órgão de Emissão do RG:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rg_orgao_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do RG:</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input foto_crianca_pai_tutor" 
						name="foto_crianca_pai_tutor" 
						required 
					/>
					<input 
						type="text" 
						class="foto_crianca_pai_tutor_arquivo" 
						name="foto_crianca_pai_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.foto_crianca_pai_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'foto_crianca_pai_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">CPF:</div>
				<div class="formularios-comentario">Informe o seu CPF. CPFs inválidos serão desconsiderados.</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cpf_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar cópia do CPF: (somente se não houver o número no RG)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input cpf_img_pai_tutor" 
						name="cpf_img_pai_tutor"  
					/>
					<input 
						type="text" 
						class="cpf_img_pai_tutor_arquivo" 
						name="cpf_img_pai_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.cpf_img_pai_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'cpf_img_pai_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">Profissão:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="profissao_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Horário de Trabalho:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="horario_trabalho_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Telefone Celular:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="telefone_celular_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Telefone Comercial:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="telefone_comercial_pai_tutor" 
					/>
				</div>

				<div class="formularios-linha">Facebook:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="facebook_pai_tutor" 
					/>
				</div>

				<div class="formularios-linha">Instagram:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="instagram_pai_tutor" 
					/>
				</div>

				<div class="formularios-linha">E-mail:</div>
				<div class="formularios-comentario">Informe o seu e-mail legítimo</div>
				<div class="formularios-linha">
					<input 
						type="email" 
						class="contato-form-input" 
						name="email_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Endereço: (Rua/Avenida/etc)</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Número:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_numero_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Complemento:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="endereco_complemento_pai_tutor" 
					/>
				</div>

				<div class="formularios-linha">Bairro:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="bairro_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Zona:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_pai_tutor" 
							value="centro"
							checked
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Centro</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_pai_tutor" 
							value="norte"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Norte</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_pai_tutor" 
							value="sul"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sul</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_pai_tutor" 
							value="leste"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Leste</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="zona_pai_tutor" 
							value="oeste"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Oeste</div>
				</div>

				<div class="formularios-linha">Município:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="municipio_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">CEP:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cep_pai_tutor" 
						required 
					/>
				</div>

				<div class="formularios-linha">Anexar comprovante de endereço (recente)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input comprovante_endereco_pai_tutor" 
						name="comprovante_endereco_pai_tutor" 
						required 
					/>
					<input 
						type="text" 
						class="comprovante_endereco_pai_tutor_arquivo" 
						name="comprovante_endereco_pai_tutor_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.comprovante_endereco_pai_tutor').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'comprovante_endereco_pai_tutor' );
							
						});
					</script>
				</div>

				<div class="formularios-titulo">INFORMAÇÕES SOCIAIS SOBRE A PESSOA COM AUTISMO</div>

				<div class="formularios-linha">Com quem mora?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="com_quem_mora" 
					/>
				</div>

				<div class="formularios-linha">Número de Irmãos:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="numero_irmaos" 
					/>
				</div>

				<div class="formularios-linha">Posição filiação: (Ex: Primogênito, Segundo filho, terceiro filho, etc ...)</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="posicao_filiacao" 
					/>
				</div>

				<div class="formularios-linha">Está estudando?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="estudando" 
							value="sim"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sim</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="estudando" 
							value="nao"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Não</div>
				</div>

				<div class="formularios-linha">Qual a Escola?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="escola" 
					/>
				</div>

				<div class="formularios-linha">Quem é a diretora?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="diretor" 
					/>
				</div>

				<div class="formularios-linha">Cuidador de Sala:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cuidador_sala" 
					/>
				</div>

				<div class="formularios-linha">Possui Rede de apoio informal (Familiar/Amigo)</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="rede_social_apoio_informal" 
					/>
				</div>

				<div class="formularios-linha">Religião:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="religiao" 
					/>
				</div>

				<div class="formularios-titulo">INFORMAÇÕES ATENDIMENTO SAÚDE</div>

				<div class="formularios-linha">Tem convênio?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="convenio" 
							value="sim"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sim</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="convenio" 
							value="nao"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Não</div>
				</div>

				<div class="formularios-linha">Qual ?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="convenio_nome" 
					/>
				</div>

				<div class="formularios-linha">Qual UBS está inscrito?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="ubs" 
					/>
				</div>

				<div class="formularios-linha">Atendido por entidades do município?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="atendimento_municipio" 
							value="sim"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sim</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="atendimento_municipio" 
							value="nao"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Não</div>
				</div>

				<div class="formularios-linha">Quais:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="atendimento_municipio_nome" 
					/>
				</div>

				<div class="formularios-linha">Programa do Governo?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="programa_governo" 
							value="bolsa_familia"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Bolsa Família</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="programa_governo" 
							value="loas"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">LOAS</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="programa_governo" 
							value="assistencia_municipal"
						/>
					</div>
					<div class="col15 formularios-radio-descricao">Assistência Municipal</div>
				</div>

				<div class="formularios-linha">Qual ?</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="assistencia_municipal_nome" 
					/>
				</div>

				<div class="formularios-linha">Observações:</div>
				<div class="formularios-linha">
					<textarea 
						name="atendimento_saude_observacoes" 
					></textarea>
				</div>

				<div class="formularios-titulo">DIAGNÓSTICO</div>

				<div class="formularios-linha">Anexar Laudo fechado de TEA (Laudo fornecido por Neuropediatra ou Psiquiatra Infantil. Em caso de adulto, laudo fornecido por Psiquiatra ou Neurologista)</div>
				<div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input laudo_tea" 
						name="laudo_tea" 
					/>
					<input 
						type="text" 
						class="laudo_tea_arquivo" 
						name="laudo_tea_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.laudo_tea').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'laudo_tea' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">Avaliações realizadas:</div>
				<div class="formularios-linha">
					<textarea 
						name="avaliacoes_realizadas" 
					></textarea>
				</div>

				<div class="formularios-linha">Laudo fechado em:</div>
				<div class="formularios-comentario">Informe a Data no formato dd/mm/yyyy</div>
				<div class="formularios-linha">
					<input 
						type="date" 
						class="contato-form-input" 
						name="laudo_data" 
					/>
				</div>

				<div class="formularios-linha">CID:</div>
				<div class="formularios-linha">
					<input 
						type="file" 
						class="contato-form-input cid" 
						name="cid" 
					/>
					<input 
						type="text" 
						class="cid_arquivo" 
						name="cid_arquivo" 
						style="display:none;"
					/>
					<script>
						document.querySelector('.cid').addEventListener('change', function() {
							
							//console.log( 'this.files', this.files ); 
							
							uploadFile( this.files );
							preencherInput( this.files[0].name, 'cid' );
							
						});
					</script>
				</div>

				<div class="formularios-linha">Onde foi realizado o Laudo?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="laudo_local" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="laudo_local" 
							value="rede_municipal"
						/>
					</div>
					<div class="col15 formularios-radio-descricao">Rede Municipal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="laudo_local" 
							value="unesp"
						/>
					</div>
					<div class="col15 formularios-radio-descricao">Unesp</div>
				</div>

				<div class="formularios-linha">Tem comorbidades?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="comorbidades" 
							value="sim"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Sim</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="comorbidades" 
							value="nao"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Não</div>
				</div>

				<div class="formularios-linha">CID:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="cid" 
					/>
				</div>

				<div class="formularios-linha">Médico:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="medico" 
					/>
				</div>

				<div class="formularios-linha">CRM:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="medico_crm" 
					/>
				</div>

				<div class="formularios-linha">Observação:</div>
				<div class="formularios-linha">
					<textarea 
						name="diagnostico_obs" 
					></textarea>
				</div>

				<div class="formularios-titulo">Intervenções Adicionais</div>

				<div class="formularios-linha">Uso de Medicação. Quais?</div>
				<div class="formularios-linha">
					<textarea 
						name="medicacao" 
					></textarea>
				</div>

				<div class="formularios-linha">Recebe medicação gratuita?</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="comorbidades" 
							value="nao"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Não</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="comorbidades" 
							value="sim_estado"
						/>
					</div>
					<div class="col15 formularios-radio-descricao">Sim (Rede Estadual)</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="comorbidades" 
							value="sim_municipio"
						/>
					</div>
					<div class="col15 formularios-radio-descricao">Sim (Rede Municipal)</div>
				</div>

				<div class="formularios-linha">Médico responsável pela medicação:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="medico_medicacao" 
					/>
				</div>

				<div class="formularios-linha">CRM:</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="medico_medicacao_crm" 
					/>
				</div>

				<div class="formularios-titulo"><span style="text-decoration: underline;">ACOMPANHAMENTO PROFISSIONAL DE SAÚDE</span></div>

				<div class="formularios-titulo">FONAUDIÓLOGO</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fonoaudiologo_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fonoaudiologo_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fonoaudiologo_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fonoaudiologo_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fonoaudiologo_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">PSICÓLOGO</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicologo_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicologo_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicologo_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicologo_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicologo_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">T.O.</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="to_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="to_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="to_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="to_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="to_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">FISIOTERAPEUTA</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fisioterapeuta_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fisioterapeuta_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fisioterapeuta_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fisioterapeuta_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="fisioterapeuta_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">PSICOPEDAGOGO</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicopedagogo_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicopedagogo_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicopedagogo_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicopedagogo_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psicopedagogo_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">MUSICOTERAPIA</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="musicoterapia_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="musicoterapia_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="musicoterapia_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="musicoterapia_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="musicoterapia_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">EQUOTERAPIA</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="equoterapia_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="equoterapia_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="equoterapia_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="equoterapia_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="equoterapia_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">CIRUR. DENTISTA</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="cirurgiao_dentista_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="cirurgiao_dentista_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="cirurgiao_dentista_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="cirurgiao_dentista_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="cirurgiao_dentista_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">PSIQUIATRA</div>

				<div class="formularios-linha">Frequência do Acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psiquiatra_frequencia" 
							value="semanal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Semanal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psiquiatra_frequencia" 
							value="quinzenal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Quinzenal</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psiquiatra_frequencia" 
							value="mensal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Mensal</div>
				</div>

				<div class="formularios-linha">Instituição a qual é feito o acompanhamento:</div>
				<div class="formularios-linha">
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psiquiatra_instituicao" 
							value="particular"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Particular</div>
					
					<div class="col05 formularios-radio-input">
						<input 
							type="radio" 
							class="contato-form-input" 
							name="psiquiatra_instituicao" 
							value="municipal"
						/>
					</div>
					<div class="col10 formularios-radio-descricao">Municipal</div>
				</div>

				<div class="formularios-titulo">OUTROS</div>

				<div class="formularios-linha">Indicar abaixo:</div>
				<div class="formularios-linha">
					<textarea 
						name="outros_profissionais" 
					></textarea>
				</div>

				<div class="formularios-titulo">.</div>

				<div class="formularios-linha">Nome completo do responsável pelas respostas</div>
				<div class="formularios-linha">
					<input 
						type="text" 
						class="contato-form-input" 
						name="nome_responsavel_respostas" 
						required
					/>
				</div>

				<div class="formularios-linha">E-mail de contato do responsável pelas respostas</div>
				<div class="formularios-linha">
					<input 
						type="email" 
						class="contato-form-input" 
						name="email_responsavel" 
						required
					/>
				</div>
				
				<div class="formularios-linha">
					<button class="contato-form-button" type="submit">Enviar</button>
				</div>
				
			</form>
			
		</div>
		
	</div>

</section>

<script>

function uploadFile( files ){
	
	//console.log( 'files', files ); 
	
	for( let i = 0; i < files.length; i++ ){ 

		var formData = new FormData();
		formData.append( 'arquivo', files[i] );
		
		var xhr = new XMLHttpRequest();
		xhr.open( 'POST', 'controller/CIPTEA_incluirImagem.php', true );
		
		xhr.onload = function () {
			
			if ( xhr.status === 200 ) {

				//console.log( 'xhr.responseText', xhr.responseText );
				alert( xhr.responseText );
				
			}
			
		};
		
		xhr.send( formData );
		
	}
	
};

function preencherInput( filename, classe ){
	
	//console.log( 'filename', filename );
	
	var renomear = limpar_caracteres( filename );
	
	//console.log( 'renomear', renomear );
	
	var date = new Date();
	let dia = date.getDate();
	let mes_num = date.getMonth() + 1;
	let mes = '';
	if( mes_num < 10 ){ mes = '0'+ mes_num; }else{ mes = mes_num; }
	let ano = date.getFullYear();
	let hora_num = date.getHours();
	let hora = '';
	if( hora_num < 10 ){ hora = '0'+ hora_num; }else{ hora = hora_num; }
	let min_num = date.getMinutes();
	let min = '';
	if( min_num < 10 ){ min = '0'+ min_num; }else{ min = min_num; }
	let sec = date.getSeconds();
	let data_invertida = ano+'-'+mes+'-'+dia+'-'+hora+'-'+min+'-';
	
	var nome_final = data_invertida + renomear;
	
	//console.log( 'nome_final', nome_final );
	
	var classe_nome = '.'+ classe +'_arquivo';
	//console.log( 'classe_nome', classe_nome );
	
	document.querySelector( classe_nome ).value = '';
	document.querySelector( classe_nome ).value = nome_final;
	
}

function limpar_caracteres( limpar ){

	limpar = limpar.replaceAll(' ', '-')
		.replaceAll("'", '')
		.replaceAll('&#039', '')
		.replaceAll('&Auml', 'A')
		.replaceAll('&Ouml', 'Oe')
		.replaceAll('&Uuml', 'Ue')
		.replaceAll('&amp', '')
		.replaceAll('&auml', 'ae')
		.replaceAll('&gt', '')
		.replaceAll('&lt', '')
		.replaceAll('&ouml', 'oe')
		.replaceAll('&quot', '')
		.replaceAll('&uuml', 'ue')
		.replaceAll('À', 'A')
		.replaceAll('Á', 'A')
		.replaceAll('Â', 'A')
		.replaceAll('Ã', 'A')
		.replaceAll('Ä', 'Ae')
		.replaceAll('Å', 'A')
		.replaceAll('Æ', 'Ae')
		.replaceAll('Ç', 'C')
		.replaceAll('È', 'E')
		.replaceAll('É', 'E')
		.replaceAll('Ê', 'E')
		.replaceAll('Ë', 'E')
		.replaceAll('Ì', 'I')
		.replaceAll('Í', 'I')
		.replaceAll('Î', 'I')
		.replaceAll('Ï', 'I')
		.replaceAll('Ð', 'D')
		.replaceAll('Ñ', 'N')
		.replaceAll('Ò', 'O')
		.replaceAll('Ó', 'O')
		.replaceAll('Ô', 'O')
		.replaceAll('Õ', 'O')
		.replaceAll('Ö', 'Oe')
		.replaceAll('Ø', 'O')
		.replaceAll('Ù', 'U')
		.replaceAll('Ú', 'U')
		.replaceAll('Û', 'U')
		.replaceAll('Ü', 'Ue')
		.replaceAll('Ý', 'Y')
		.replaceAll('Þ', 'T')
		.replaceAll('ß', 'ss')
		.replaceAll('à', 'a')
		.replaceAll('á', 'a')
		.replaceAll('â', 'a')
		.replaceAll('ã', 'a')
		.replaceAll('ä', 'ae')
		.replaceAll('å', 'a')
		.replaceAll('æ', 'ae')
		.replaceAll('ç', 'c')
		.replaceAll('è', 'e')
		.replaceAll('é', 'e')
		.replaceAll('ê', 'e')
		.replaceAll('ë', 'e')
		.replaceAll('ì', 'i')
		.replaceAll('í', 'i')
		.replaceAll('î', 'i')
		.replaceAll('ï', 'i')
		.replaceAll('ð', 'd')
		.replaceAll('ñ', 'n')
		.replaceAll('ò', 'o')
		.replaceAll('ó', 'o')
		.replaceAll('ô', 'o')
		.replaceAll('õ', 'o')
		.replaceAll('ö', 'oe')
		.replaceAll('ø', 'o')
		.replaceAll('ù', 'u')
		.replaceAll('ú', 'u')
		.replaceAll('û', 'u')
		.replaceAll('ü', 'ue')
		.replaceAll('ý', 'y')
		.replaceAll('þ', 't')
		.replaceAll('ÿ', 'y')
		.replaceAll('Ā', 'A')
		.replaceAll('ā', 'a')
		.replaceAll('Ă', 'A')
		.replaceAll('ă', 'a')
		.replaceAll('Ą', 'A')
		.replaceAll('ą', 'a')
		.replaceAll('Ć', 'C')
		.replaceAll('ć', 'c')
		.replaceAll('Ĉ', 'C')
		.replaceAll('ĉ', 'c')
		.replaceAll('Ċ', 'C')
		.replaceAll('ċ', 'c')
		.replaceAll('Č', 'C')
		.replaceAll('č', 'c')
		.replaceAll('Ď', 'D')
		.replaceAll('ď', 'd')
		.replaceAll('Đ', 'D')
		.replaceAll('đ', 'd')
		.replaceAll('Ē', 'E')
		.replaceAll('ē', 'e')
		.replaceAll('Ĕ', 'E')
		.replaceAll('ĕ', 'e')
		.replaceAll('Ė', 'E')
		.replaceAll('ė', 'e')
		.replaceAll('Ę', 'E')
		.replaceAll('ę', 'e')
		.replaceAll('Ě', 'E')
		.replaceAll('ě', 'e')
		.replaceAll('Ĝ', 'G')
		.replaceAll('ĝ', 'g')
		.replaceAll('Ğ', 'G')
		.replaceAll('ğ', 'g')
		.replaceAll('Ġ', 'G')
		.replaceAll('ġ', 'g')
		.replaceAll('Ģ', 'G')
		.replaceAll('ģ', 'g')
		.replaceAll('Ĥ', 'H')
		.replaceAll('ĥ', 'h')
		.replaceAll('Ħ', 'H')
		.replaceAll('ħ', 'h')
		.replaceAll('Ĩ', 'I')
		.replaceAll('ĩ', 'i')
		.replaceAll('Ī', 'I')
		.replaceAll('ī', 'i')
		.replaceAll('Ĭ', 'I')
		.replaceAll('ĭ', 'i')
		.replaceAll('Į', 'I')
		.replaceAll('į', 'i')
		.replaceAll('İ', 'I')
		.replaceAll('ı', 'i')
		.replaceAll('Ĳ', 'IJ')
		.replaceAll('ĳ', 'ij')
		.replaceAll('Ĵ', 'J')
		.replaceAll('ĵ', 'j')
		.replaceAll('Ķ', 'K')
		.replaceAll('ķ', 'k')
		.replaceAll('ĸ', 'k')
		.replaceAll('Ĺ', 'K')
		.replaceAll('ĺ', 'l')
		.replaceAll('Ļ', 'K')
		.replaceAll('ļ', 'l')
		.replaceAll('Ľ', 'K')
		.replaceAll('ľ', 'l')
		.replaceAll('Ŀ', 'K')
		.replaceAll('ŀ', 'l')
		.replaceAll('Ł', 'K')
		.replaceAll('ł', 'l')
		.replaceAll('Ń', 'N')
		.replaceAll('ń', 'n')
		.replaceAll('Ņ', 'N')
		.replaceAll('ņ', 'n')
		.replaceAll('Ň', 'N')
		.replaceAll('ň', 'n')
		.replaceAll('ŉ', 'n')
		.replaceAll('Ŋ', 'N')
		.replaceAll('ŋ', 'n')
		.replaceAll('Ō', 'O')
		.replaceAll('ō', 'o')
		.replaceAll('Ŏ', 'O')
		.replaceAll('ŏ', 'o')
		.replaceAll('Ő', 'O')
		.replaceAll('ő', 'o')
		.replaceAll('Œ', 'OE')
		.replaceAll('œ', 'oe')
		.replaceAll('Ŕ', 'R')
		.replaceAll('ŕ', 'r')
		.replaceAll('Ŗ', 'R')
		.replaceAll('ŗ', 'r')
		.replaceAll('Ř', 'R')
		.replaceAll('ř', 'r')
		.replaceAll('Ś', 'S')
		.replaceAll('Ŝ', 'S')
		.replaceAll('Ş', 'S')
		.replaceAll('Š', 'S')
		.replaceAll('š', 's')
		.replaceAll('Ţ', 'T')
		.replaceAll('Ť', 'T')
		.replaceAll('Ŧ', 'T')
		.replaceAll('Ũ', 'U')
		.replaceAll('ũ', 'u')
		.replaceAll('Ū', 'U')
		.replaceAll('ū', 'u')
		.replaceAll('Ŭ', 'U')
		.replaceAll('ŭ', 'u')
		.replaceAll('Ů', 'U')
		.replaceAll('ů', 'u')
		.replaceAll('Ű', 'U')
		.replaceAll('ű', 'u')
		.replaceAll('Ų', 'U')
		.replaceAll('ų', 'u')
		.replaceAll('Ŵ', 'W')
		.replaceAll('ŵ', 'w')
		.replaceAll('Ŷ', 'Y')
		.replaceAll('ŷ', 'y')
		.replaceAll('Ÿ', 'Y')
		.replaceAll('Ź', 'Z')
		.replaceAll('ź', 'z')
		.replaceAll('Ż', 'Z')
		.replaceAll('ż', 'z')
		.replaceAll('Ž', 'Z')
		.replaceAll('ž', 'z')
		.replaceAll('ſ', 'ss')
		.replaceAll('ƒ', 'f')
		.replaceAll('Ș', 'S')
		.replaceAll('Ț', 'T')
		.replaceAll('Ё', 'YO')
		.replaceAll('А', 'A')
		.replaceAll('Б', 'B')
		.replaceAll('В', 'V')
		.replaceAll('Г', 'G')
		.replaceAll('Д', 'D')
		.replaceAll('Е', 'E')
		.replaceAll('Ж', 'ZH')
		.replaceAll('З', 'Z')
		.replaceAll('И', 'I')
		.replaceAll('Й', 'Y')
		.replaceAll('К', 'K')
		.replaceAll('Л', 'L')
		.replaceAll('М', 'M')
		.replaceAll('Н', 'N')
		.replaceAll('О', 'O')
		.replaceAll('П', 'P')
		.replaceAll('Р', 'R')
		.replaceAll('С', 'S')
		.replaceAll('Т', 'T')
		.replaceAll('У', 'U')
		.replaceAll('Ф', 'F')
		.replaceAll('Х', 'H')
		.replaceAll('Ц', 'C')
		.replaceAll('Ч', 'CH')
		.replaceAll('Ш', 'SH')
		.replaceAll('Щ', 'SCH')
		.replaceAll('Ъ', '')
		.replaceAll('Ы', 'Y')
		.replaceAll('Ь', '')
		.replaceAll('Э', 'E')
		.replaceAll('Ю', 'YU')
		.replaceAll('Я', 'YA')
		.replaceAll('а', 'a')
		.replaceAll('б', 'b')
		.replaceAll('в', 'v')
		.replaceAll('г', 'g')
		.replaceAll('д', 'd')
		.replaceAll('е', 'e')
		.replaceAll('ж', 'zh')
		.replaceAll('з', 'z')
		.replaceAll('и', 'i')
		.replaceAll('й', 'y')
		.replaceAll('к', 'k')
		.replaceAll('л', 'l')
		.replaceAll('м', 'm')
		.replaceAll('н', 'n')
		.replaceAll('о', 'o')
		.replaceAll('п', 'p')
		.replaceAll('р', 'r')
		.replaceAll('с', 's')
		.replaceAll('т', 't')
		.replaceAll('у', 'u')
		.replaceAll('ф', 'f')
		.replaceAll('х', 'h')
		.replaceAll('ц', 'c')
		.replaceAll('ч', 'ch')
		.replaceAll('ш', 'sh')
		.replaceAll('щ', 'sch')
		.replaceAll('ъ', '')
		.replaceAll('ы', 'y')
		.replaceAll('ый', 'iy')
		.replaceAll('ь', '')
		.replaceAll('э', 'e')
		.replaceAll('ю', 'yu')
		.replaceAll('я', 'ya')
		.replaceAll('ё', 'yo');
		
	limpar = limpar.replaceAll('---', '-');
	
	return limpar;
	
}

</script>
<!-- End - view/cadastro-ciptea.php !-->