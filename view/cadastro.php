<!-- Start - view/cadastro.php !-->
<style>

<?php require 'css/cadastro.css'; ?>

.fonte-vermelha{
color:red;
}
.fonte-verde{
color:green;
font-weight:bold;
}

</style>

<section class="cadastro" title="cadastro">
	
	<div class="cadastro-cabecalho">
	
		<div class="cadastro-titulo-campo">
			<div class="cadastro-titulo">Cadastre-se</div>
		</div>
		
	</div>
	
	<div class="section_gavetas-box-geral">
	
		<div class="section_gavetas-box">
			
			<div class="section_gavetas-gaveta">
			
				<div class="section_gavetas-pergunta section_gavetas-pergunta-on">Formulário de Cadastro</div>
				<div class="section_gavetas-resposta on">

					<form action="controller/cadastro.php" method="POST" enctype="multipart/form-data">
						
						<div class="col100"><h3>Detalhes de conta</h3></div>
						
						<div class="col50">
							<p><label class="cadastro-label" for="id_email">E-mail*:</label></p>
							<p><input type="email" class="cadastro-input email fonte-vermelha" name="email" id="id_email" required /></p>
						</div>
						<div class="col50">
							<p><label class="cadastro-label" for="id_email_confirm">Confirme seu e-mail*:</label></p>
							<p><input type="email" class="cadastro-input comparador_email fonte-vermelha" name="email_confirmacao" id="id_email_confirm" required /></p>
						</div>
						
						<div class="col50">
							<p><label class="cadastro-label" for="id_senha">Senha*:</label></p>
							<p><input type="text" class="cadastro-input senha fonte-vermelha" name="senha" id="id_senha" required /></p>
						</div>
						<div class="col50">
							<p><label class="cadastro-label" for="id_senha_confirm">Confirme a senha*:</label></p>
							<p><input type="text" class="cadastro-input comparador_senha fonte-vermelha" name="senha_confirmacao" id="id_senha_confirm" required /></p>
						</div>
						
						<div class="separador"></div>
						
						<div class="col100"><h3>Informações Pessoais</h3></div>
						
						<div class="col70">
							<p><label class="cadastro-label" for="id_nome">Nome completo (sem abreviações)*:</label></p>
							<p><input type="text" class="cadastro-input" name="nome" id="id_nome" required /></p>
						</div>
						<div class="col30">
							<p><label class="cadastro-label" for="id_cpf">CPF*:</label></p>
							<p><input type="text" class="cadastro-input" name="cpf" id="id_cpf" required onkeypress="MascaraCPF( this );" placeholder="___.___.___-__"  /></p>
						</div>
						
						<div class="col30">
							<p><label class="cadastro-label" for="id_telefone">Telefone para contato*:</label></p>
							<p><input type="text" class="cadastro-input" name="telefone" id="id_telefone" required onkeypress="FoneCelularMask( this );" placeholder="(__) _____-____" /></p>
						</div>
						<div class="col30">
							<p><label class="cadastro-label" for="id_telefone02">Telefone secundário:</label></p>
							<p><input type="text" class="cadastro-input" name="telefone02" id="id_telefone02" required onkeypress="FoneCelularMask( this );" placeholder="(__) _____-____" /></p>
						</div>
						
						<div class="separador"></div>
						
						<div class="col100">
							<button class="cadastro-btn" type="submit">Enviar meus dados</button>
						</div>
						
					</form>

				</div>
				
			</div>
			
		</div>
		
	</div>
	
</section>

<script>
/*Start - COMPARADOR DE SENHAS*/
let senha = document.querySelector('.senha');
let comparador = document.querySelector('.comparador_senha');

comparador.addEventListener("input", event => {
	
	const inputValue = event.target.value;
	//console.log( inputValue, senha.value );
	
	if( inputValue == senha.value ){
		
		//console.log( 'IGUAL' );
		senha.classList.add("fonte-verde");
		comparador.classList.add("fonte-verde");
		
	}
	if( inputValue != senha.value ){
		
		//console.log( 'DIFERENTE' );
		senha.classList.remove("fonte-verde");
		comparador.classList.remove("fonte-verde");
	}
	
});

let email = document.querySelector('.email');
let comparador_email = document.querySelector('.comparador_email');

comparador_email.addEventListener("input", event => {
	
	const inputValue_email = event.target.value;
	//console.log( inputValue, email.value );
	
	if( inputValue_email == email.value ){
		
		//console.log( 'IGUAL' );
		email.classList.add("fonte-verde");
		comparador_email.classList.add("fonte-verde");
		
	}
	if( inputValue_email != email.value ){
		
		//console.log( 'DIFERENTE' );
		email.classList.remove("fonte-verde");
		comparador_email.classList.remove("fonte-verde");
	}
	
});
/*End - COMPARADOR DE SENHAS*/

/*Start - MÁSCARAS*/
/*Se o onkeypress não funcionar no mobile use oninput ou ainda onkeydown*/
function tirar_pontos( vcamp ){
	
	//console.log( vcamp.value.replace('.', '') );
	var text = vcamp.value.replace('.', '');
	vcamp.value = text;

}

function cpfCnpjMask( vcamp ){
	
	var text = vcamp.value.replace('.', '').replace('.', '').replace('/', '').replace('-', '');
	
	if( text.length > 11 ){
		
		MascaraCNPJ(vcamp);
		
	}else{
		
		MascaraCPF(vcamp);
		
	}
	
}

function MascaraCNPJ( cnpj ){
	
	if( mascaraInteiro( cnpj ) == false ){
		
		event.returnValue = false;
		
	}       
	
	return formataCampo( cnpj, '00.000.000/0000-00', event );
	
}

function MascaraCPF( cpf ){
	
	if(mascaraInteiro(cpf)==false){
		
		event.returnValue = false;
		
	}
	
	return formataCampo(cpf, '000.000.000-00', event);
	
}

function FoneCelularMask( vcamp ){
	
	var text = vcamp.value.replace('.', '').replace('.', '').replace('/', '').replace('-', '');
	
	if( text.length > 12 ){
		
		MascaraCelular(vcamp);
		
	}else{
		
		MascaraTelefone(vcamp);
		
	}
	
}

function MascaraTelefone( telefone ){
	
	if(mascaraInteiro(telefone)==false){
		
		event.returnValue = false;
		
	}
	
	return formataCampo(telefone, '(00) 0000-0000', event);
	
}

function MascaraCelular( celular ){
	
	if(mascaraInteiro(celular)==false){
		
		event.returnValue = false;
		
	}
	
	return formataCampo(celular, '(00) 0 0000-0000', event);
	
}

//valida numero inteiro com mascara
function mascaraInteiro(){
	
	if ( event.keyCode < 48 || event.keyCode > 57 ){
		
		event.returnValue = false;
		return false;
		
	}
	
	return true;
	
}

//formata de forma generica os campos
function formataCampo( campo, Mascara, evento ) {
	
	var boleanoMascara; 

	var Digitato = evento.keyCode;
	
	exp = /\-|\.|\/|\(|\)| /g;
	
	campoSoNumeros = campo.value.toString().replace( exp, "" );

	var posicaoCampo = 0;    
	var NovoValorCampo = "";
	var TamanhoMascara = campoSoNumeros.length;

	if ( Digitato != 8 ) { // backspace
	
		for(i=0; i<= TamanhoMascara; i++) {

			boleanoMascara  = (
				( Mascara.charAt(i) == "-" ) || 
				( Mascara.charAt(i) == "." ) || 
				( Mascara.charAt(i) == "/" )
			);
			
			boleanoMascara = boleanoMascara || 
			(
				( Mascara.charAt(i) == "(" ) || 
				( Mascara.charAt(i) == ")" ) || 
				( Mascara.charAt(i) == " " )
			) 
			
			if ( boleanoMascara ) { 
			
				NovoValorCampo += Mascara.charAt(i); 
				TamanhoMascara++;
				
			}else { 
			
				NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
				posicaoCampo++; 
				
			}
			
		}
		
		campo.value = NovoValorCampo;
		
		return true; 
		
	}else{ return true; }
	
}
/*End - MÁSCARAS*/
</script>
<!-- End - view/cadastro.php !-->