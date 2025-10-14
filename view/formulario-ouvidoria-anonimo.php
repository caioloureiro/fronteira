<!-- Start - view/formulario-ouvidoria-anonimo.php !-->
<style>
<?php 
    require 'css/formulario-esic.css'; 
    require 'css/formularios.css'; 
?>
</style>

<section class="formulario-esic">

    <form 
        action="controller/formulario-ouvidoria-anonimo.php" 
        method="POST" 
        enctype="multipart/form-data"
    >

        <div class="formularios-titulo"><strong>Ouvidoria Municipal</strong> - Denúncia Anônima</div>
        
        <div class="formularios-comentario" style="background: #fff3cd; padding: 0.8vw; border-radius: 0.3vw; border: 0.1vw solid #ffc107; margin-bottom: 1vw;">
            <strong>🔒 MODO ANÔNIMO ATIVADO</strong><br>
            Seus dados pessoais <strong>NÃO</strong> serão solicitados. A resposta será disponibilizada através do número de protocolo gerado.
        </div>
        
        <div class="formularios-comentario">
            <strong>Obs: campos <span style="color:red">VERMELHOS</span> são obrigatórios.</strong>
        </div>
        
        <div class="formularios-separador"></div>
        
        <!-- TIPO DE CHAMADO -->
        <div class="formularios-linha">*Tipo de Chamado:</div>
        <div class="formularios-linha">
            <select name="tipo" required>
                <option value="">Selecione o tipo de chamado</option>
                <option value="Denúncia" selected>Denúncia</option>
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

        <!-- ORIGEM DO CHAMADO -->
        <div class="formularios-linha">Origem do Chamado:</div>
        <div class="formularios-linha">
            <select name="origem">
                <option value="Site da Prefeitura" selected>Site da Prefeitura</option>
                <option value="Presencial">Presencial</option>
                <option value="Telefone">Telefone</option>
                <option value="E-mail">E-mail</option>
                <option value="Redes Sociais">Redes Sociais</option>
                <option value="Outros">Outros</option>
            </select>
        </div>

        <!-- DESCRIÇÃO DA SOLICITAÇÃO -->
        <div class="formularios-linha">*Descrição da Solicitação:</div>
        <div class="formularios-linha">
            <textarea 
                name="mensagem"
                placeholder="Descreva detalhadamente sua solicitação, reclamação, denúncia, elogio, sugestão ou dúvida."
                required
                style="min-height: 10vw;"
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

        <!-- INFORMAÇÕES DO LOCAL (OPCIONAL) -->
        <div class="formularios-linha-titulo">Local da Ocorrência (Opcional)</div>
        
        <div class="formularios-comentario" style="margin-bottom: 0.8vw;">
            Se desejar, você pode informar o local onde ocorreu o fato relatado. Essas informações são <strong>opcionais</strong>.
        </div>

        <div class="formularios-linha">Logradouro:</div>
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
        
        <!-- CAMPOS OCULTOS PARA ANONIMATO -->
        <input type="hidden" name="anonimato" value="sim" />
        <input type="hidden" name="forma_resposta" value="protocolo" />
        
        <div class="formularios-linha">
            <button type="submit">Enviar Denúncia Anônima</button>
        </div>
        
    </form>

</section>

<script>
// Validação antes do envio
document.querySelector('form').addEventListener('submit', function(e) {
    const mensagem = document.querySelector('[name="mensagem"]').value;
    
    if (mensagem.trim().length < 20) {
        e.preventDefault();
        alert('Por favor, descreva sua solicitação com mais detalhes (mínimo 20 caracteres).');
        return false;
    }
});
</script>

<!-- End - view/formulario-ouvidoria-anonimo.php !-->
