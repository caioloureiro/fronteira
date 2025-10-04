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

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Criar esic</title>
		
		<!-- Start - JODIT !-->
		<link
		  rel="stylesheet"
		  href="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.css"
		/>
		<!-- End - JODIT !-->
		
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
	
		<div class="lightbox esic-nova on">

			<form action="../controller/criar.php" method="POST">
			
				<div class="lightbox-titulo">

					Novo esic
					<div 
						class="lightbox-fechar" 
						onClick="voltar()" 
						style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );" 
					></div>
					
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Órgão: </span>
					</div>
					<div class="col90">
						<input 
							name="orgao" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Título: </span>
					</div>
					<div class="col90">
						<input 
							name="titulo" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Código: </span>
					</div>
					<div class="col90">
						<input 
							name="codigo" 
						/>
					</div>
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
						<span>Endereço: </span>
					</div>
					<div class="col90">
						<textarea name="endereco"></textarea>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Cidade: </span>
					</div>
					<div class="col90">
						<input 
							name="cidade" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Estado: </span>
					</div>
					<div class="col90">
						<input 
							name="estado" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Email: </span>
					</div>
					<div class="col90">
						<input 
							name="email" 
							type="email" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Telefone: </span>
					</div>
					<div class="col90">
						<input 
							name="telefone" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Telefone 2: </span>
					</div>
					<div class="col90">
						<input 
							name="telefone2" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>CPF: </span>
					</div>
					<div class="col90">
						<input 
							name="cpf" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>CEP: </span>
					</div>
					<div class="col90">
						<input 
							name="cep" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Tipo: </span>
					</div>
					<div class="col90">
						<input 
							name="tipo" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Status: </span>
					</div>
					<div class="col90">
						<select name="status">
							<option value="">Selecione o status</option>
							<option value="Aguardando Departamento Responsável">Aguardando Departamento Responsável</option>
							<option value="Indeferido">Indeferido</option>
							<option value="Prorrogado">Prorrogado</option>
							<option value="Protocolo Registrado">Protocolo Registrado</option>
							<option value="Resolvido">Resolvido</option>
						</select>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Identificação: </span>
					</div>
					<div class="col90">
						<input 
							name="identificacao" 
						/>
					</div>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Data: </span>
					</div>
					<div class="col90">
						<input 
							name="data" 
							type="datetime-local" 
						/>
					</div>
				</div>
				
				<div class="separador"></div>
				
				<div class="linha linha-auto">
					<div class="col100">
						<span>Mensagem: </span>
					</div>
				</div>
				
				<div class="linha linha-auto">
					<textarea id="editor_mensagem" name="mensagem"></textarea>
				</div>
				
				<div class="separador"></div>
				
				<div class="linha linha-auto">
					<div class="col100">
						<span>Resposta: </span>
					</div>
				</div>
				
				<div class="linha linha-auto">
					<textarea id="editor_resposta" name="resposta"></textarea>
				</div>
				
				<div class="linha">
					<div class="col10">
						<span>Anexo: </span>
					</div>
					<div class="col90">
						<input 
							name="anexo" 
						/>
					</div>
				</div>

				<div class="separador"></div>
				
				<div class="linha-acao">
				
					<button type="submit">Gravar</button>
					<div class="btn" onclick="voltar()">Cancelar</div>
					
				</div>
				
				<div class="separador"></div>
				
			</form>

		</div>
		
		<script src="https://unpkg.com/jodit@4.0.1/es2021/jodit.min.js"></script><!-- JODIT !-->
		
		<script>
			
			/*Start - JODIT*/
			const editor_mensagem = new Jodit("#editor_mensagem", {
				language: "pt_br", // Configurar para português brasileiro
			});
			
			const editor_resposta = new Jodit("#editor_resposta", {
				language: "pt_br", // Configurar para português brasileiro
			});
			/*End - JODIT*/
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=esic';
				
			}
			
		</script>
		
	</body>
	
</html>