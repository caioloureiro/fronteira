<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');
require 'funcoes.php';

$tabela = '';
$sql = '';

/*Start - TABELA: paginas*/
/*
$tabela = 'paginas';
require '../model/'. $tabela .'.php';
//dd( $paginas_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`pagina` TEXT NOT NULL, <br/>
	`titulo` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	`info` TEXT NOT NULL, <br/>
	`representante` TEXT NOT NULL, <br/>
	`foto` TEXT NOT NULL, <br/>
	`telefone` TEXT NOT NULL, <br/>
	`endereco` TEXT NOT NULL, <br/>
	`email` TEXT NOT NULL, <br/>
	`horario` TEXT NOT NULL, <br/>
	`site` TEXT NOT NULL, <br/>
	`facebook` TEXT NOT NULL, <br/>
	`instagram` TEXT NOT NULL, <br/>
	`twitter` TEXT NOT NULL, <br/>
	`localizacao` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $paginas as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`pagina`, 
		`titulo`, 
		`texto`, 
		`info`, 
		`representante`, 
		`foto`, 
		`telefone`, 
		`endereco`, 
		`email`, 
		`horario`, 
		`site`, 
		`facebook`, 
		`instagram`, 
		`twitter`, 
		`localizacao`
	) VALUES ( " .
		
		"'". $item['pagina'] ."', ".
		"'". $item['titulo'] ."', ".
		"'". htmlspecialchars( $item['texto'] ) ."', ".
		"'". $item['info'] ."', ".
		"'". $item['representante'] ."', ".
		"'". $item['foto'] ."', ".
		"'". $item['telefone'] ."', ".
		"'". $item['endereco'] ."', ".
		"'". $item['email'] ."', ".
		"'". $item['horario'] ."', ".
		"'". $item['site'] ."', ".
		"'". $item['facebook'] ."', ".
		"'". $item['instagram'] ."', ".
		"'". $item['twitter'] ."', ".
		"'". htmlspecialchars( $item['localizacao'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: paginas*/

/*Start - TABELA: paginas_fixas*/
/*
$tabela = 'paginas_fixas';
require '../model/'. $tabela .'.php';
//dd( $paginas_fixas_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`pagina` TEXT NOT NULL, <br/>
	`titulo` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $paginas_fixas as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`pagina`, 
		`titulo`, 
		`texto`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['pagina'] ."', ".
		"'". $item['titulo'] ."', ".
		"'". htmlspecialchars( $item['texto'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: paginas_fixas*/

/*Start - TABELA: acesso_facil*/
/*
$tabela = 'acesso_facil';
require '../model/'. $tabela .'.php';
//dd( $acesso_facil_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` VARCHAR(255) NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` VARCHAR(255) NOT NULL, <br/>
	`icone` VARCHAR(255) NOT NULL, <br/>
	`pai` INT NOT NULL DEFAULT '0', <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $acesso_facil_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`target`, 
		`icone`, 
		`pai`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"'". $item['icone'] ."', ".
		"". $item['pai'] ." ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: acesso_facil*/

/*Start - TABELA: acesso_rapido*/
/*
$tabela = 'acesso_rapido';
require '../model/'. $tabela .'.php';
//dd( $acesso_rapido_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` VARCHAR(255) NOT NULL, <br/>
	`icone` VARCHAR(255) NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` VARCHAR(255) NOT NULL, <br/>
	`possui_texto` INT NOT NULL DEFAULT '0', <br/>
	`texto` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $acesso_rapido_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`titulo`, 
		`icone`, 
		`link`, 
		`target`, 
		`possui_texto`, 
		`texto`
	) VALUES ( " .
		
		"'". $item['titulo'] ."', ".
		"'". $item['icone'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"". $item['possui_texto'] .", ".
		"'". $item['texto'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: acesso_rapido*/

/*Start - TABELA: administracao*/
/*
$tabela = 'administracao';
require '../model/'. $tabela .'.php';
//dd( $administracao_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`pagina` TEXT NOT NULL, <br/>
	`titulo` TEXT NOT NULL, <br/>
	`secretario` TEXT NOT NULL, <br/>
	`foto` TEXT NOT NULL, <br/>
	`telefone` TEXT NOT NULL, <br/>
	`endereco` TEXT NOT NULL, <br/>
	`email` TEXT NOT NULL, <br/>
	`horario` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	`site` TEXT NOT NULL, <br/>
	`facebook` TEXT NOT NULL, <br/>
	`instagram` TEXT NOT NULL, <br/>
	`twitter` TEXT NOT NULL, <br/>
	`localizacao` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $administracao_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`id`, 
		
		`pagina`, 
		`titulo`, 
		`secretario`, 
		`foto`, 
		`telefone`, 
		`endereco`, 
		`email`, 
		`horario`, 
		`texto`, 
		`site`, 
		`facebook`, 
		`instagram`, 
		`twitter`, 
		`localizacao`
	) VALUES ( " .
		"". $item['id'] .", ".
		
		"'". $item['pagina'] ."', ".
		"'". $item['titulo'] ."', ".
		"'". $item['secretario'] ."', ".
		"'". $item['foto'] ."', ".
		"'". $item['telefone'] ."', ".
		"'". $item['endereco'] ."', ".
		"'". $item['email'] ."', ".
		"'". $item['horario'] ."', ".
		"'". htmlspecialchars( $item['texto'] ) ."', ".
		"'". $item['site'] ."', ".
		"'". $item['facebook'] ."', ".
		"'". $item['instagram'] ."', ".
		"'". $item['twitter'] ."', ".
		"'". htmlspecialchars( $item['localizacao'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: administracao*/

/*Start - TABELA: audiencias_publicas*/
/*
$tabela = 'audiencias_publicas';
require '../model/'. $tabela .'.php';
//dd( $audiencias_publicas_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` TEXT NOT NULL, <br/>
	`data_publicacao` DATETIME NOT NULL, <br/>
	`data_audiencia` DATETIME NOT NULL, <br/>
	`local` TEXT NOT NULL, <br/>
	`categoria` TEXT NOT NULL, <br/>
	`descricao` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $audiencias_publicas_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`id`, 
		
		`titulo`, 
		`data_publicacao`, 
		`data_audiencia`, 
		`local`, 
		`categoria`, 
		`descricao`
	) VALUES ( " .
		"". $item['id'] .", ".
		
		"'". $item['titulo'] ."', ".
		"'". $item['data_publicacao'] ."', ".
		"'". $item['data_audiencia'] ."', ".
		"'". $item['local'] ."', ".
		"'". $item['categoria'] ."', ".
		"'". htmlspecialchars( $item['descricao'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: audiencias_publicas*/

/*Start - TABELA: banner*/
/*
$tabela = 'banner';
require '../model/'. $tabela .'.php';
//dd( $banner_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`imagem` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $banner_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`imagem`, 
		`link`, 
		`target` 
	) VALUES ( " .
		
		"'". $item['imagem'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: banner*/

/*Start - TABELA: carrossel*/
/*
$tabela = 'carrossel';
require '../model/'. $tabela .'.php';
//dd( $carrossel_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`imagem` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/> <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $carrossel_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`imagem`, 
		`link`, 
		`target`
	) VALUES ( " .
		
		"'". $item['imagem'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: carrossel*/

/*Start - TABELA: chamadas_publicas*/
/*
$tabela = 'chamadas_publicas';
require '../model/'. $tabela .'.php';
//dd( $chamadas_publicas_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` TEXT NOT NULL, <br/>
	`arquivo` TEXT NOT NULL, <br/>
	`data` VARCHAR(255) NOT NULL, <br/>
	`categorias` TEXT NOT NULL, <br/> <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $chamadas_publicas_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`titulo`, 
		`arquivo`, 
		`data`, 
		`categorias`
	) VALUES ( " .
		
		"'". $item['titulo'] ."', ".
		"'". $item['arquivo'] ."', ".
		"'". $item['data'] ."', ".
		"'". $item['categorias'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: chamadas_publicas*/


/*Start - TABELA: chamamento_publico*/
/*
$tabela = 'chamamento_publico';
require '../model/'. $tabela .'.php';
//dd( $chamamento_publico_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` VARCHAR(255) NOT NULL, <br/>
	`arquivo` TEXT NOT NULL, <br/>
	`data` VARCHAR(255) NOT NULL, <br/>
	`categorias` TEXT NOT NULL, <br/> <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $chamamento_publico_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`titulo`, 
		`arquivo`, 
		`data`, 
		`categorias`
	) VALUES ( " .
		
		"'". $item['titulo'] ."', ".
		"'". $item['arquivo'] ."', ".
		"'". $item['data'] ."', ".
		"'". $item['categorias'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: chamamento_publico*/

/*Start - TABELA: conselhos_municipais*/
/*
$tabela = 'conselhos_municipais';
require '../model/'. $tabela .'.php';
//dd( $conselhos_municipais_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`pagina` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $conselhos_municipais_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`pagina`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['pagina'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: conselhos_municipais*/

/*Start - TABELA: contato*/
/*
$tabela = 'contato';
require '../model/'. $tabela .'.php';
//dd( $contato_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`endereco` TEXT NOT NULL, <br/>
	`telefone` TEXT NOT NULL, <br/>
	`horario` TEXT NOT NULL, <br/>
	`mapa` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $contato_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`endereco`, 
		`telefone`, 
		`horario`, 
		`mapa`
	) VALUES ( " .
		
		"'". $item['endereco'] ."', ".
		"'". $item['telefone'] ."', ".
		"'". $item['horario'] ."', ".
		"'". htmlspecialchars( $item['mapa'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: contato*/

/*Start - TABELA: departamentos*/
/*
$tabela = 'departamentos';
require '../model/'. $tabela .'.php';
//dd( $departamentos_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`email` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $departamentos_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`email`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['email'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: departamentos*/

/*Start - TABELA: diario_oficial*/
/*
$tabela = 'diario_oficial';
require '../model/'. $tabela .'.php';
//dd( $diario_oficial_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` TEXT NOT NULL, <br/>
	`edicao_extra` INT NOT NULL DEFAULT '0', <br/>
	`arquivo` TEXT NOT NULL, <br/>
	`data` DATETIME NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $diario_oficial_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`titulo`, 
		`edicao_extra`, 
		`arquivo`, 
		`data`
	) VALUES ( " .
		
		"'". $item['titulo'] ."', ".
		"". $item['edicao_extra'] .", ".
		"'". $item['arquivo'] ."', ".
		"'". $item['data'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: diario_oficial*/

/*Start - TABELA: downloads*/
/*
$tabela = 'downloads';
require '../model/'. $tabela .'.php';
//dd( $downloads_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`data` TEXT NOT NULL, <br/>
	`tipo` TEXT NOT NULL, <br/>
	`arquivo` TEXT NOT NULL, <br/>
	`categorias` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $downloads_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`data`, 
		`tipo`, 
		`arquivo`, 
		`categorias`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['data'] ."', ".
		"'". $item['tipo'] ."', ".
		"'". $item['arquivo'] ."', ".
		"'". $item['categorias'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: downloads*/

/*Start - TABELA: menu*/
/*
$tabela = 'menu';
require '../model/'. $tabela .'.php';
//dd( $menu_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/>
	`nivel` INT NOT NULL, <br/>
	`pai` INT NOT NULL, <br/>
	`submenu` INT NOT NULL, <br/>
	`ordem` INT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $menu_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`target`, 
		`nivel`, 
		`pai`, 
		`submenu`, 
		`ordem`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"". $item['nivel'] .", ".
		"". $item['pai'] .", ".
		"". $item['submenu'] .", ".
		"". $item['ordem'] ." ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: menu*/

/*Start - TABELA: menu_interno*/
/*
$tabela = 'menu_interno';
require '../model/'. $tabela .'.php';
//dd( $menu_interno_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/>
	`pagina_alvo` TEXT NOT NULL, <br/>
	`subpagina_alvo` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $menu_interno_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`target`, 
		`pagina_alvo`, 
		`subpagina_alvo`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"'". $item['pagina_alvo'] ."', ".
		"'". $item['subpagina_alvo'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: menu_interno*/

/*Start - TABELA: menu_servicos*/
/*
$tabela = 'menu_servicos';
require '../model/'. $tabela .'.php';
//dd( $menu_servicos_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/>
	`realce` INT NOT NULL, <br/>
	`ordem` INT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $menu_servicos_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`target`, 
		`realce`, 
		`ordem`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"". $item['realce'] .", ".
		"". $item['ordem'] ." ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: menu_servicos*/

/*Start - TABELA: noticias*/
/*
$tabela = 'noticias';
require '../model/'. $tabela .'.php';
//dd( $noticias_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`titulo` TEXT NOT NULL, <br/>
	`subtitulo` TEXT NOT NULL, <br/>
	`data_publicacao` DATETIME NOT NULL, <br/>
	`data_atualizacao` DATETIME NOT NULL, <br/>
	`imagem` TEXT NOT NULL, <br/>
	`destaque` INT NOT NULL DEFAULT '0', <br/>
	`destaque_ordem` INT NOT NULL DEFAULT '0', <br/>
	`utilidade_publica` INT NOT NULL DEFAULT '0', <br/>
	`categorias` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $noticias_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`titulo`, 
		`subtitulo`, 
		`data_publicacao`, 
		`data_atualizacao`, 
		`imagem`, 
		`destaque`, 
		`destaque_ordem`, 
		`utilidade_publica`, 
		`categorias`, 
		`texto`
	) VALUES ( " .
		
		"'". $item['titulo'] ."', ".
		"'". $item['subtitulo'] ."', ".
		"'". $item['data_publicacao'] ."', ".
		"'". $item['data_atualizacao'] ."', ".
		"'". $item['imagem'] ."', ".
		"'". $item['destaque'] ."', ".
		"'". $item['destaque_ordem'] ."', ".
		"'". $item['utilidade_publica'] ."', ".
		"'". $item['categorias'] ."', ".
		"'". $item['texto'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: noticias*/

/*Start - TABELA: noticias_categorias*/
/*
$tabela = 'noticias_categorias';
require '../model/'. $tabela .'.php';
//dd( $noticias_categorias_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $noticias_categorias_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`
	) VALUES ( " .
		
		"'". $item['nome'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: noticias_categorias*/

/*Start - TABELA: periodo_eleitoral*/
/*
$tabela = 'periodo_eleitoral';
require '../model/'. $tabela .'.php';
//dd( $periodo_eleitoral_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>

	`ativado` INT NOT NULL DEFAULT '0', <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $periodo_eleitoral_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`ativado`
	) VALUES ( " .
		
		"". $item['ativado'] ." ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: periodo_eleitoral*/

/*Start - TABELA: prefeitos*/
/*
$tabela = 'prefeitos';
require '../model/'. $tabela .'.php';
//dd( $prefeitos_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`foto` TEXT NOT NULL, <br/>
	`data_ini` TEXT NOT NULL, <br/>
	`data_fim` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $prefeitos_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`foto`, 
		`data_ini`, 
		`data_fim`, 
		`texto`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['foto'] ."', ".
		"'". $item['data_ini'] ."', ".
		"'". $item['data_fim'] ."', ".
		"'". htmlspecialchars( $item['texto'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: prefeitos*/

/*Start - TABELA: secretarias*/
/*
$tabela = 'secretarias';
require '../model/'. $tabela .'.php';
//dd( $secretarias_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`pagina` TEXT NOT NULL, <br/>
	`titulo` TEXT NOT NULL, <br/>
	`secretario` TEXT NOT NULL, <br/>
	`foto` TEXT NOT NULL, <br/>
	`telefone` TEXT NOT NULL, <br/>
	`endereco` TEXT NOT NULL, <br/>
	`email` TEXT NOT NULL, <br/>
	`horario` TEXT NOT NULL, <br/>
	`texto` TEXT NOT NULL, <br/>
	`site` TEXT NOT NULL, <br/>
	`facebook` TEXT NOT NULL, <br/>
	`instagram` TEXT NOT NULL, <br/>
	`twitter` TEXT NOT NULL, <br/>
	`localizacao` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $secretarias_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`pagina`, 
		`titulo`, 
		`secretario`, 
		`foto`, 
		`telefone`, 
		`endereco`, 
		`email`, 
		`horario`, 
		`texto`, 
		`site`, 
		`facebook`, 
		`instagram`, 
		`twitter`, 
		`localizacao`
	) VALUES ( " .
		
		"'". $item['pagina'] ."', ".
		"'". $item['titulo'] ."', ".
		"'". $item['secretario'] ."', ".
		"'". $item['foto'] ."', ".
		"'". $item['telefone'] ."', ".
		"'". $item['endereco'] ."', ".
		"'". $item['email'] ."', ".
		"'". $item['horario'] ."', ".
		"'". htmlspecialchars( $item['texto'] ) ."', ".
		"'". $item['site'] ."', ".
		"'". $item['facebook'] ."', ".
		"'". $item['instagram'] ."', ".
		"'". $item['twitter'] ."', ".
		"'". htmlspecialchars( $item['localizacao'] ) ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: secretarias*/

/*Start - TABELA: usuarios*/
/*
$tabela = 'usuarios';
require '../model/'. $tabela .'.php';
//dd( $usuarios_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`email` TEXT NOT NULL, <br/>
	`email02` TEXT NULL, <br/>
	`senha` TEXT NOT NULL, <br/>
	`cpf` TEXT NULL, <br/>
	`telefone` TEXT NULL, <br/>
	`telefone01` TEXT NULL, <br/>
	`telefone02` TEXT NULL, <br/>
	`rg` TEXT NULL, <br/>
	`data_nasc` TEXT NULL, <br/>
	`genero` TEXT NULL, <br/>
	`escolaridade` TEXT NULL, <br/>
	`profissao` TEXT NULL, <br/>
	`cep` TEXT NULL, <br/>
	`estado` TEXT NULL, <br/>
	`cidade` TEXT NULL, <br/>
	`logradouro` TEXT NULL, <br/>
	`numero` TEXT NULL, <br/>
	`bairro` TEXT NULL, <br/>
	`complemento` TEXT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $usuarios_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`email`, 
		`email02`, 
		`senha`, 
		`cpf`, 
		`telefone`, 
		`telefone01`, 
		`telefone02`, 
		`rg`, 
		`data_nasc`, 
		`genero`, 
		`escolaridade`, 
		`profissao`, 
		`cep`, 
		`estado`, 
		`cidade`, 
		`logradouro`, 
		`numero`, 
		`bairro`, 
		`complemento`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['email'] ."', ".
		"'". $item['email02'] ."', ".
		"'". $item['senha'] ."', ".
		"'". $item['cpf'] ."', ".
		"'". $item['telefone'] ."', ".
		"'". $item['telefone01'] ."', ".
		"'". $item['telefone02'] ."', ".
		"'". $item['rg'] ."', ".
		"'". $item['data_nasc'] ."', ".
		"'". $item['genero'] ."', ".
		"'". $item['escolaridade'] ."', ".
		"'". $item['profissao'] ."', ".
		"'". $item['cep'] ."', ".
		"'". $item['estado'] ."', ".
		"'". $item['cidade'] ."', ".
		"'". $item['logradouro'] ."', ".
		"'". $item['numero'] ."', ".
		"'". $item['bairro'] ."', ".
		"'". $item['complemento'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: usuarios*/

/*Start - TABELA: vagas*/
/*
$tabela = 'vagas';
require '../model/'. $tabela .'.php';
//dd( $vagas_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`quantidade` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $vagas_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`quantidade`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['quantidade'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: vagas*/

/*Start - TABELA: exemplo*/
/*
$tabela = 'exemplo';
require '../model/'. $tabela .'.php';
//dd( $exemplo_array );

$sql .="
<p>
CREATE TABLE `$tabela` ( <br/>
	`id` INT NOT NULL AUTO_INCREMENT, <br/>
	`ativo` INT NOT NULL DEFAULT '1', <br/>
	
	`nome` TEXT NOT NULL, <br/>
	`link` TEXT NOT NULL, <br/>
	`target` TEXT NOT NULL, <br/>
	`icone` TEXT NOT NULL, <br/>
	`pai` TEXT NOT NULL, <br/>
	
	PRIMARY KEY (`id`) <br/>
) ENGINE = MyISAM;
</p>
";

$sql .= "<p>";
foreach( $exemplo_array as $item ){

	$sql .= "INSERT INTO `$tabela` (
		`nome`, 
		`link`, 
		`target`, 
		`icone`, 
		`pai`
	) VALUES ( " .
		
		"'". $item['nome'] ."', ".
		"'". $item['link'] ."', ".
		"'". $item['target'] ."', ".
		"'". $item['icone'] ."', ".
		"'". $item['pai'] ."' ".
		
	" );<br/>";

}
$sql .= "</p>";
*/
/*End - TABELA: exemplo*/

echo $sql;

?>