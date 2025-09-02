<!-- Start - view/matriz.php !-->
<?php

if(
	isset( $_COOKIE['cidade_SESSION_usuario'] ) &&
	isset( $_COOKIE['cidade_SESSION_senha'] )
){
	require 'model/usuarios.php';
	
	$usuario_nome = '';
	$usuario_email = '';
	$usuario_email02 = '';
	$usuario_senha = '';
	$usuario_cpf = '';
	$usuario_telefone = '';
	$usuario_telefone01 = '';
	$usuario_telefone02 = '';
	$usuario_rg = '';
	$usuario_data_nasc = '';
	$usuario_genero = '';
	$usuario_escolaridade = '';
	$usuario_profissao = '';
	$usuario_cep = '';
	$usuario_estado = '';
	$usuario_cidade = '';
	$usuario_logradouro = '';
	$usuario_numero = '';
	$usuario_bairro = '';
	$usuario_complemento = '';
	
	foreach( $usuarios_array as $usr ){

		if( $usr['email'] == $_COOKIE['cidade_SESSION_usuario'] ){
			
			$usuario_nome = $usr['nome'];
			$usuario_email = $usr['email'];
			$usuario_email02 = $usr['email02'];
			$usuario_senha = $usr['senha'];
			$usuario_cpf = $usr['cpf'];
			$usuario_telefone = $usr['telefone'];
			$usuario_telefone01 = $usr['telefone01'];
			$usuario_telefone02 = $usr['telefone02'];
			$usuario_rg = $usr['rg'];
			$usuario_data_nasc = $usr['data_nasc'];
			$usuario_genero = $usr['genero'];
			$usuario_escolaridade = $usr['escolaridade'];
			$usuario_profissao = $usr['profissao'];
			$usuario_cep = $usr['cep'];
			$usuario_estado = $usr['estado'];
			$usuario_cidade = $usr['cidade'];
			$usuario_logradouro = $usr['logradouro'];
			$usuario_numero = $usr['numero'];
			$usuario_bairro = $usr['bairro'];
			$usuario_complemento = $usr['complemento'];
			
		}
		
	}

}else{
	
	echo '<script> window.location.href = "recados&titulo=Login&mensagem=Você não está logado em nosso sistema.&btn_link=acesso-restrito-login"; </script>';
	
}

?>

<style><?php require 'css/conteudo.css'; ?></style>

<section class="conteudo">
	
	<div class="box">
	
		<style><?php require 'css/conteudo-titulo.css'; ?></style>

		<section class="conteudo-titulo">
			
			<div class="box">
				
				<div class="conteudo-titulo-campo"><?php echo $pagina['titulo'] ?></div>
				
			</div>
			
		</section>
		
		<div class="perfil-subtitulo">Dados Pessoais</div>

			<table class="perfil-tabela">
				<thead style="display:none">
					<tr>
						<th>Titulo</th>
						<th>Titulo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:40%">Nome:</td>
						<td style="width:60%"><?php echo $usuario_nome ?></td>
					</tr>
					<tr>
						<td>CPF:</td>
						<td><?php echo $usuario_cpf ?></td>
					</tr>
					<tr>
						<td>RG:</td>
						<td><?php echo $usuario_rg ?></td>
					</tr>
					<tr>
						<td>Data de Nascimento:</td>
						<td><?php if( $usuario_data_nasc != '' ){ echo data( $usuario_data_nasc ); } ?></td>
					</tr>
					<tr>
						<td>CEP:</td>
						<td><?php echo $usuario_cep ?></td>
					</tr>
					<tr>
						<td>Logradouro:</td>
						<td><?php echo $usuario_logradouro ?></td>
					</tr>
					<tr>
						<td>Número:</td>
						<td><?php echo $usuario_numero ?></td>
					</tr>
					<tr>
						<td>Bairro:</td>
						<td><?php echo $usuario_bairro ?></td>
					</tr>
					<tr>
						<td>Cidade:</td>
						<td><?php echo $usuario_cidade ?></td>
					</tr>
					<tr>
						<td>Estado:</td>
						<td><?php echo $usuario_estado ?></td>
					</tr>
					<tr>
						<td>Telefone para contato:</td>
						<td><?php echo $usuario_telefone ?></td>
					</tr>
				</tbody>
			</table>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/matriz.php !-->