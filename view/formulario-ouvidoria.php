<!-- Start - view/formulario-ouvidoria.php !-->
<style>
<?php 
    require 'css/formulario-esic.css'; 
    require 'css/formularios.css'; 
?>
</style>

<section class="formulario-esic">

    <form 
        action="controller/formulario-ouvidoria.php" 
        method="POST" 
        enctype="multipart/form-data"
    >

        <div class="formularios-titulo"><strong>Ouvidoria Municipal</strong> - Abrir um novo protocolo</div>
        
        <div class="formularios-comentario">
            <strong>Obs: campos <span style="color:red">VERMELHOS</span> são obrigatórios.</strong>
        </div>
        
        <div class="formularios-separador"></div>
        
        <!-- TIPO DE CHAMADO -->
        <div class="formularios-linha">*Tipo de Chamado:</div>
        <div class="formularios-linha">
            <select name="tipo" required>
                <option value="">Selecione o tipo de chamado</option>
                <option value="Denúncia">Denúncia</option>
                <option value="Dúvida">Dúvida</option>
                <option value="Elogio">Elogio</option>
                <option value="Reclamação">Reclamação</option>
                <option value="Solicitação">Solicitação</option>
                <option value="Sugestão">Sugestão</option>
                <option value="Outros">Outros</option>
            </select>
        </div>

        <!-- SECRETARIA/ÓRGÃO -->
        <div class="formularios-linha">*Secretaria/Órgão:</div>
        <div class="formularios-linha">
            <select name="orgao" required>
                <option value="">Escolha a secretaria</option>
                <option value="Gabinete do Prefeito">Gabinete do Prefeito</option>
                <option value="Secretaria Municipal de Agricultura e Meio Ambiente">Secretaria Municipal de Agricultura e Meio Ambiente</option>
                <option value="Secretaria Municipal da Saúde">Secretaria Municipal da Saúde</option>
                <option value="Secretaria Municipal de Ação Social">Secretaria Municipal de Ação Social</option>
                <option value="Secretaria Municipal de Cultura e Turismo">Secretaria Municipal de Cultura e Turismo</option>
                <option value="Secretaria Municipal de Desportos e Lazer">Secretaria Municipal de Desportos e Lazer</option>
                <option value="Secretaria Municipal de Educação">Secretaria Municipal de Educação</option>
                <option value="Secretaria Municipal de Gestão Financeira e Planejamento Estratégico">Secretaria Municipal de Gestão Financeira e Planejamento Estratégico</option>
                <option value="Secretaria Municipal de Serviços Urbanos">Secretaria Municipal de Serviços Urbanos</option>
                <option value="Secretaria Municipal de Transportes">Secretaria Municipal de Transportes</option>
                <option value="Conselho do Idoso">Conselho do Idoso</option>
                <option value="Conselho Municipal de Educação">Conselho Municipal de Educação</option>
                <option value="Conselho Tutelar">Conselho Tutelar</option>
            </select>
        </div>

        <!-- ASSUNTO -->
        <div class="formularios-linha">*Assunto:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="titulo" 
                placeholder="Descreva brevemente o assunto"
                required 
            />
        </div>

        <!-- FORMA DE RESPOSTA -->
        <div class="formularios-linha">*Forma de Resposta Desejada:</div>
        <div class="formularios-linha">
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="forma_resposta" 
                    value="email"
                    checked
                />
            </div>
            <div class="col15 formularios-radio-descricao">E-mail</div>
            
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="forma_resposta" 
                    value="telefone"
                />
            </div>
            <div class="col15 formularios-radio-descricao">Telefone</div>
            
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="forma_resposta" 
                    value="correspondencia"
                />
            </div>
            <div class="col20 formularios-radio-descricao">Correspondência</div>
        </div>

        <!-- ORIGEM DO CHAMADO -->
        <div class="formularios-linha">Origem do Chamado:</div>
        <div class="formularios-linha">
            <select name="origem">
                <option value="">Selecione a origem</option>
                <option value="Site da Prefeitura">Site da Prefeitura</option>
                <option value="Presencial">Presencial</option>
                <option value="Telefone">Telefone</option>
                <option value="E-mail">E-mail</option>
                <option value="Redes Sociais">Redes Sociais</option>
                <option value="Outros">Outros</option>
            </select>
        </div>

        <!-- SIGILO E ANONIMATO -->
        <div class="formularios-linha">Deseja sigilo na tramitação?</div>
        <div class="formularios-linha">
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="sigilo" 
                    value="sim"
                />
            </div>
            <div class="col10 formularios-radio-descricao">Sim</div>
            
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="sigilo" 
                    value="nao"
                    checked
                />
            </div>
            <div class="col10 formularios-radio-descricao">Não</div>
        </div>

        <div class="formularios-linha">Deseja anonimato?</div>
        <div class="formularios-linha">
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="anonimato" 
                    value="sim"
                />
            </div>
            <div class="col10 formularios-radio-descricao">Sim</div>
            
            <div class="col05 formularios-radio-input">
                <input 
                    type="radio" 
                    name="anonimato" 
                    value="nao"
                    checked
                />
            </div>
            <div class="col10 formularios-radio-descricao">Não</div>
        </div>

        <!-- DESCRIÇÃO DA SOLICITAÇÃO -->
        <div class="formularios-linha">*Descrição da Solicitação:</div>
        <div class="formularios-linha">
            <textarea 
                name="mensagem"
                placeholder="Descreva detalhadamente sua solicitação, reclamação, denúncia, elogio, sugestão ou dúvida."
                required
            ></textarea>
        </div>

        <!-- ANEXO -->
        <div class="formularios-linha">Anexar arquivo (opcional):</div>
        <div class="formularios-comentario">Extensões permitidas: pdf, jpg, png, jpeg, doc, docx - Tamanho máximo: 5MB</div>
        <div class="formularios-linha">
            <input 
                type="file" 
                name="anexo"
                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
            />
        </div>

        <div class="formularios-separador"></div>
        
        <!-- INFORMAÇÕES PESSOAIS -->
        <div class="formularios-linha-titulo">Dados Pessoais</div>

        <div class="formularios-linha">*Nome Completo:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="nome" 
                required 
            />
        </div>

        <div class="formularios-linha">*CPF:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="cpf" 
                id="cpf"
                placeholder="000.000.000-00"
                required 
            />
        </div>

        <div class="formularios-linha">*E-mail:</div>
        <div class="formularios-linha">
            <input 
                type="email" 
                name="email" 
                placeholder="Digite um e-mail válido"
                required 
            />
        </div>

        <div class="formularios-linha">*Telefone para contato:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="telefone" 
                id="telefone"
                placeholder="(00) 0 0000-0000"
                required 
            />
        </div>

        <div class="formularios-linha">Telefone adicional:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="telefone2" 
                id="telefone2"
                placeholder="(00) 0 0000-0000"
            />
        </div>

        <!-- ENDEREÇO -->
        <div class="formularios-linha-titulo">Endereço</div>

        <div class="formularios-linha">*CEP:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="cep" 
                id="cep"
                placeholder="00000-000"
                required 
            />
        </div>

        <div class="formularios-linha">*Logradouro:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="endereco" 
                id="endereco"
                placeholder="Rua, Avenida, etc."
                required 
            />
        </div>

        <div class="formularios-linha">*Número:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="numero" 
                required 
            />
        </div>

        <div class="formularios-linha">Complemento:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="complemento" 
                placeholder="Apartamento, casa, etc."
            />
        </div>

        <div class="formularios-linha">*Bairro:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="bairro" 
                id="bairro"
                required 
            />
        </div>

        <div class="formularios-linha">*Cidade:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="cidade" 
                id="cidade"
                required 
            />
        </div>

        <div class="formularios-linha">*Estado:</div>
        <div class="formularios-linha">
            <select name="estado" id="estado" required>
                <option value="">Selecione um estado</option>
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
        </div>

        <div class="formularios-linha">Ponto de referência:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="ponto_referencia" 
                placeholder="Ponto de referência próximo ao endereço"
            />
        </div>

        <!-- INFORMAÇÕES DO LOCAL (se aplicável) -->
        <div class="formularios-linha-titulo">Local da Ocorrência (se diferente do endereço pessoal)</div>

        <div class="formularios-linha">Logradouro da ocorrência:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="local_endereco" 
                placeholder="Endereço onde ocorreu o fato relatado"
            />
        </div>

        <div class="formularios-linha">Número:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="local_numero" 
            />
        </div>

        <div class="formularios-linha">Bairro:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="local_bairro" 
            />
        </div>

        <div class="formularios-linha">Complemento:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="local_complemento" 
            />
        </div>

        <div class="formularios-linha">Ponto de referência:</div>
        <div class="formularios-linha">
            <input 
                type="text" 
                name="local_referencia" 
            />
        </div>

        <div class="formularios-separador"></div>
        
        <div class="formularios-linha">
            <button type="submit">Enviar Solicitação</button>
        </div>
        
    </form>

</section>

<script>
// Máscaras e validações
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');
    const cepInput = document.getElementById('cep');
    const telefoneInput = document.getElementById('telefone');
    const telefone2Input = document.getElementById('telefone2');
    
    // Máscara para CPF
    cpfInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        this.value = value;
    });
    
    // Máscara para CEP
    cepInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        value = value.replace(/^(\d{5})(\d)/, '$1-$2');
        this.value = value;
    });
    
    // Buscar endereço quando o CEP estiver completo
    cepInput.addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep.length === 8) {
            buscarEnderecoPorCEP(cep);
        }
    });
    
    // Máscara para telefones
    function aplicarMascaraTelefone(input) {
        input.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            this.value = value;
        });
    }
    
    aplicarMascaraTelefone(telefoneInput);
    aplicarMascaraTelefone(telefone2Input);
});

// Função para buscar endereço via API do ViaCEP
function buscarEnderecoPorCEP(cep) {
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (!data.erro) {
                document.getElementById('endereco').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
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

// Validação de CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false;
    
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;
    
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(10))) return false;
    
    return true;
}

// Validação antes do envio
document.querySelector('form').addEventListener('submit', function(e) {
    const cpf = document.getElementById('cpf').value;
    
    if (!validarCPF(cpf)) {
        e.preventDefault();
        alert('CPF inválido. Por favor, verifique o número digitado.');
        return false;
    }
});
</script>

<!-- End - view/formulario-ouvidoria.php !-->