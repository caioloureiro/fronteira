<?php
/*Start - Head*/

require 'model/settings_admin.php';

foreach( $settings_admin_array as $conf ){

	$cidade = $conf['cidade'];
	$estado = $conf['estado'];
	$uf = $conf['uf'];
	$endereco = $conf['endereco'];
	$atendimento = $conf['atendimento'];
	$email = $conf['email'];
	$telefone = $conf['telefone'];
	$pais = $conf['pais'];
	$logo = $conf['logo'];
	$head_title = $conf['head_title'];
	$head_description = $conf['head_description'];
	$head_link = $conf['head_link'];
	$head_autor = $conf['head_autor'];
	$head_imagem = $conf['head_imagem'];
	$head_nome = $conf['head_nome'];
	$head_favicon = $conf['head_favicon'];
	$boas_vindas = $conf['boas_vindas'];
	$versao = $conf['versao'];
	$release = $conf['release'];

}

/*End - Head*/
?>