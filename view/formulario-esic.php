<!-- Start - view/formulario-esic.php !-->
<style><?php require 'css/formulario-esic.css'; ?></style>

<section class="formulario-esic">

	<form 
		action="controller/formulario-esic.php" 
		method="POST" 
	>

		<div class="formularios-titulo"><strong>Abrir</strong> um novo protocolo</div>
		
		<div class="formularios-separador"></div>
		
		<div class="formularios-linha">*Assunto:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="assunto" 
					placeholder="Abrir um novo protocolo *Assunto: Departamento: *Tipo:"
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">Departamento:</div>
		<div class="formularios-linha">
			<span>
				<select 
					name="departamento"
					required
				>
					<option>Escolha o departamento</option>
					<option>Gabinete do Prefeito</option>
					<option>Secretaria Municipal Agricultura e Meio Ambiente</option>
					<option>Secretaria Municipal da Saúde</option>
					<option>Secretaria Municipal de Ação Social</option>
					<option>Secretaria Municipal de Cultura e Turismo</option>
					<option>Secretaria Municipal de Desportos e Lazer </option>
					<option>Secretaria Municipal de Educação</option>
					<option>Secretaria Municipal de Gestão Financeira e Planejamento Estratégico</option>
					<option>Secretaria Municipal de Serviços Urbanos</option>
					<option>Secretaria Municipal de Transportes</option>
					<option>Conselho do Idoso</option>
					<option>Conselho Municipal de Educação</option>
					<option>CONSELHO TUTELAR </option>
				</select>
			</span>
		</div>

		<div class="formularios-linha">*Tipo:</div>
		<div class="formularios-linha">
			<span>
				<select 
					name="tipo"
					required
				>
					<option>Selecione um tipo</option>
					<option>Denúncia</option>
					<option>Elogio</option>
					<option>Reclamação</option>
					<option>Solicitação</option>
					<option>Sugestão</option>
					<option>Outro</option>
				</select>
			</span>
		</div>

		<div class="formularios-linha">*Mensagem:</div>
		<div class="formularios-linha">
			<span>
				<textarea 
					name="mensagem"
					required
				></textarea>
			</span>
		</div>

		<div class="formularios-linha">*Nome:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="nome" 
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*CPF:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="cpf" 
					id="cpf"
					placeholder="000.000.000-00"
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*E-mail:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="email" 
					class="contato-form-input" 
					name="email" 
					placeholder="Digite um e-mail válido."
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*CEP:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="cep" 
					id="cep"
					placeholder="Digite primeiro o CEP e seu endereço preenche automatiamente."
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*Endereço:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="endereco" 
					id="endereco"
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*Cidade:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="cidade" 
					id="cidade"
					required 
				/>
			</span>
		</div>

		<div class="formularios-linha">*Estado:</div>
		<div class="formularios-linha">
			<span>
				<select 
					name="estado"
					id="estado"
					required
				>
					<option value=""> - Selecione um estado - </option>
					<option value="AC">Acre</option>
					<option value="AL">Alagoas</option>
					<option value="AP">Amapá</option>
					<option value="AM">Amazonas</option>
					<option value="BA">Bahia</option>
					<option value="CE">Ceará</option>
					<option value="DF">Distrito Federal</option>
					<option value="ES">Espírito Santo</option>
					<option value="GO">Goiás</option>
					<option value="MA">Maranhão</option>
					<option value="MT">Mato Grosso</option>
					<option value="MS">Mato Grosso do Sul</option>
					<option value="MG">Minas Gerais</option>
					<option value="PA">Pará</option>
					<option value="PB">Paraíba</option>
					<option value="PR">Paraná</option>
					<option value="PE">Pernambuco</option>
					<option value="PI">Piauí</option>
					<option value="RJ">Rio de Janeiro</option>
					<option value="RN">Rio Grande do Norte</option>
					<option value="RS">Rio Grande do Sul</option>
					<option value="RO">Rondônia</option>
					<option value="RR">Roraima</option>
					<option value="SC">Santa Catarina</option>
					<option value="SP">São Paulo</option>
					<option value="SE">Sergipe</option>
					<option value="TO">Tocantins</option>
				</select>
			</span>
		</div>

		<div class="formularios-linha">*Telefone para contato:</div>
		<div class="formularios-linha">
			<span>
				<input 
					type="text" 
					class="contato-form-input" 
					name="telefone" 
					id="telefone"
					placeholder="(00) 0 0000-0000"
					required 
				/>
			</span>
		</div>
		
		<div class="formularios-separador"></div>
		
		<div class="formularios-linha">
			<button class="contato-form-button" type="submit">Enviar</button>
		</div>
		
	</form>

</section>

<script>
// Função para aplicar máscara de CPF
function mascaraCPF(cpf) {
	cpf = cpf.replace(/\D/g, "");
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
	cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
	return cpf;
}

// Função para aplicar máscara de CEP
function mascaraCEP(cep) {
	cep = cep.replace(/\D/g, "");
	cep = cep.replace(/^(\d{5})(\d)/, "$1-$2");
	return cep;
}

// Função para aplicar máscara de telefone
function mascaraTelefone(telefone) {
	telefone = telefone.replace(/\D/g, "");
	telefone = telefone.replace(/^(\d{2})(\d)/g, "($1) $2");
	telefone = telefone.replace(/(\d)(\d{4})$/, "$1-$2");
	return telefone;
}

// Aplicar máscaras aos campos
document.addEventListener('DOMContentLoaded', function() {
	const cpfInput = document.getElementById('cpf');
	const cepInput = document.getElementById('cep');
	const telefoneInput = document.getElementById('telefone');
	
	// Máscara para CPF
	cpfInput.addEventListener('input', function() {
		this.value = mascaraCPF(this.value);
	});
	
	// Máscara para CEP
	cepInput.addEventListener('input', function() {
		this.value = mascaraCEP(this.value);
	});
	
	// Buscar endereço quando o CEP estiver completo
	cepInput.addEventListener('blur', function() {
		const cep = this.value.replace(/\D/g, '');
		if (cep.length === 8) {
			buscarEnderecoPorCEP(cep);
		}
	});
	
	// Máscara para telefone
	telefoneInput.addEventListener('input', function() {
		this.value = mascaraTelefone(this.value);
	});
});

// Função para buscar endereço via API do ViaCEP
function buscarEnderecoPorCEP(cep) {
	fetch(`https://viacep.com.br/ws/${cep}/json/`)
		.then(response => response.json())
		.then(data => {
			if (!data.erro) {
				document.getElementById('endereco').value = data.logradouro || '';
				document.getElementById('cidade').value = data.localidade || '';
				
				const estadoSelect = document.getElementById('estado');
				if (data.uf) {
					for (let i = 0; i < estadoSelect.options.length; i++) {
						if (estadoSelect.options[i].value === data.uf) {
							estadoSelect.selectedIndex = i;
							break;
						}
					}
				}
			} else {
				alert('CEP não encontrado. Por favor, verifique o CEP digitado.');
			}
		})
		.catch(error => {
			console.error('Erro ao buscar CEP:', error);
			alert('Erro ao buscar o CEP. Tente novamente.');
		});
}
</script>
<!-- End - view/formulario-esic.php !-->