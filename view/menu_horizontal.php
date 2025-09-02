<!-- Start - view/menu_horizontal.php !-->
<?php

$menu_array = array(
	
	array(
		'id' => 1,
		'nome' => 'Menu',
		'link' => '#',
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 1,
		'ordem' => 0,
	),
	array(
		'id' => 2,
		'nome' => 'Diário Oficial',
		'link' => '/portal/diario-oficial', 
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 0,
		'ordem' => 2,
	),
	array(
		'id' => 3,
		'nome' => 'Secretarias',
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/', 
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 1,
		'ordem' => 3,
	),
	array(
		'id' => 4,
		'nome' => 'Transparência',
		'link' => 'https://transparencia-cidade.smarapd.com.br', 
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 1,
		'ordem' => 4,
	),
	array(
		'id' => 5,
		'nome' => 'Editais',
		'link' => '#',
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 1,
		'ordem' => 5,
	),
	array(
		'id' => 6,
		'nome' => 'Vagas de Emprego',
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/94/pat---posto-de-atendimento-ao-trabalhador/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 7,
		'nome' => 'História',
		'link' => '/portal/servicos/1001/historia/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 12,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 8,
		'nome' => 'Localização',
		'link' => '/portal/servicos/1058/localizacao/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 12,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 9,
		'nome' => 'Dados Gerais',
		'link' => '/portal/servicos/1004/dados-gerais/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 12,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 10,
		'nome' => 'Símbolos',
		'link' => '/portal/servicos/1003/simbolos/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 12,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 11,
		'nome' => 'Assistência Social',
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/4/secretaria-de-assistencia-social/', 
		'target' => '_self',
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'ordem' => 0,
	),
	array(
		'id' => 12,
		'nome' => 'A Nossa Cidade',
		'link' => '#',
		'target' => '_self',
		'nivel' => 0,
		'pai' => 0,
		'submenu' => 1,
		'ordem' => 1,
	),
	array(
		'id' => 13,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/15/secretaria-de-participacao-populacao-comunicacao/', 
		'target' => '_self',
		'nome' => 'Participação Popular e Comunicação',
		'ordem' => 0,
	),
	array(
		'id' => 14,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/3/secretaria-de-cultura/', 
		'target' => '_self',
		'nome' => 'Cultura',
		'ordem' => 0,
	),
	array(
		'id' => 15,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/5/secretaria-de-desenvolvimento-economico-relacoes-institucionais-e-trabalho/', 
		'target' => '_self',
		'nome' => 'Desenvolvimento Econômico, Relações Institucionais e Trabalho',
		'ordem' => 0,
	),
	array(
		'id' => 16,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/7/secretaria-de-educacao/', 
		'target' => '_self',
		'nome' => 'Educação',
		'ordem' => 0,
	),
	array(
		'id' => 17,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/8/secretaria-de-esportes-e-promocao-da-qualidade-de-vida/', 
		'target' => '_self',
		'nome' => 'Esportes e Promoção da Qualidade de Vida',
		'ordem' => 0,
	),
	array(
		'id' => 18,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/9/secretaria-de-governo/', 
		'target' => '_self',
		'nome' => 'Governo',
		'ordem' => 0,
	),
	array(
		'id' => 19,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/10/secretaria-de-habitacao-e-urbanismo/', 
		'target' => '_self',
		'nome' => 'Habitação e Urbanismo',
		'ordem' => 0,
	),
	array(
		'id' => 20,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/331/secretaria-de-infraestrutura/', 
		'target' => '_self',
		'nome' => 'Infraestrutura',
		'ordem' => 0,
	),
	array(
		'id' => 21,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/12/secretaria-de-saude/', 
		'target' => '_self',
		'nome' => 'Saúde',
		'ordem' => 0,
	),
	array(
		'id' => 22,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/13/secretaria-de-seguranca/', 
		'target' => '_self',
		'nome' => 'Segurança',
		'ordem' => 0,
	),
	array(
		'id' => 23,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/14/secretaria-do-verde/', 
		'target' => '_self',
		'nome' => 'Verde',
		'ordem' => 0,
	),
	array(
		'id' => 24,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/340/secretaria-de-zeladoria-e-servicos/', 
		'target' => '_self',
		'nome' => 'Zeladoria e Serviços',
		'ordem' => 0,
	),
	array(
		'id' => 25,
		'nivel' => 1,
		'pai' => 3,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/333/secretaria-adjunta-de-turismo/', 
		'target' => '_self',
		'nome' => 'Secretaria Adjunta de Turismo',
		'ordem' => 0,
	),
	array(
		'id' => 26,
		'nivel' => 1,
		'pai' => 4,
		'submenu' => 0,
		'link' => 'https://transparencia-cidade.smarapd.com.br', 
		'target' => '_blank',
		'nome' => 'Portal da Transparencia',
		'ordem' => 0,
	),
	array(
		'id' => 27,
		'nivel' => 1,
		'pai' => 4,
		'submenu' => 0,
		'link' => '/portal/servicos/1027/ouvidoria/', 
		'target' => '_self',
		'nome' => 'Ouvidoria',
		'ordem' => 0,
	),
	array(
		'id' => 28,
		'nivel' => 1,
		'pai' => 4,
		'submenu' => 0,
		'link' => 'https://transparencia-cidade.smarapd.com.br/#/esic', 
		'target' => '_blank',
		'nome' => 'Acesso à Informação',
		'ordem' => 0,
	),
	array(
		'id' => 29,
		'nivel' => 1,
		'pai' => 4,
		'submenu' => 0,
		'link' => 'http://www.botuprev.sp.gov.br/portal/#', 
		'target' => '_blank',
		'nome' => 'Botuprev',
		'ordem' => 0,
	),
	array(
		'id' => 30,
		'nivel' => 1,
		'pai' => 4,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/arquivos/codigo_meio_ambiente_01091525.pdf', 
		'target' => '_blank',
		'nome' => 'Código Meio Ambiente',
		'ordem' => 0,
	),
	array(
		'id' => 31,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/editais/5', 
		'target' => '_self',
		'nome' => 'Chamamento Publico',
		'ordem' => 0,
	),
	array(
		'id' => 32,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/contratos', 
		'target' => '_blank',
		'nome' => 'Contratos',
		'ordem' => 0,
	),
	array(
		'id' => 33,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => 'https://www.cidade.swop.com.br/portal/arquivos/1/5/0/0/0/0/0', 
		'target' => '_self',
		'nome' => 'Chamadas Públicas',
		'ordem' => 0,
	),
	array(
		'id' => 34,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => '/portal/editais/1', 
		'target' => '_self',
		'nome' => 'Licitações',
		'ordem' => 0,
	),
	array(
		'id' => 35,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => '/portal/editais/3', 
		'target' => '_self',
		'nome' => 'Concursos e Processos Seletivos',
		'ordem' => 0,
	),
	array(
		'id' => 36,
		'nivel' => 1,
		'pai' => 5,
		'submenu' => 0,
		'link' => 'https://caipimes.selecao.net.br/index/todos/?busca=cidade', 
		'target' => '_blank',
		'nome' => 'Concursos Antigos',
		'ordem' => 0,
	),
	array(
		'id' => 37,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/93/Conselhos-Municipais', 
		'target' => '_self',
		'nome' => 'Conselhos Municipais',
		'ordem' => 0,
	),
	array(
		'id' => 38,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias/341/procuradoria-geral-do-municipio/', 
		'target' => '_self',
		'nome' => 'Procuradoria Geral do Município',
		'ordem' => 0,
	),
	array(
		'id' => 39,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/conecta-mais', 
		'target' => '_self',
		'nome' => 'Conecta + | Praças Digitais',
		'ordem' => 0,
	),
	array(
		'id' => 40,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/audiencias-publicas', 
		'target' => '_self',
		'nome' => 'Audiências Públicas',
		'ordem' => 0,
	),
	array(
		'id' => 41,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/55/diprourb/', 
		'target' => '_self',
		'nome' => 'Diprourb',
		'ordem' => 0,
	),
	array(
		'id' => 42,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/69/tributos/', 
		'target' => '_self',
		'nome' => 'Tributos',
		'ordem' => 0,
	),
	array(
		'id' => 43,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/servicos/1063/fundo-social-de-solidariedade/', 
		'target' => '_self',
		'nome' => 'Fundo Social de Solidariedade',
		'ordem' => 0,
	),
	array(
		'id' => 44,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://leismunicipais.com.br/prefeitura/sp/cidade', 
		'target' => '_blank',
		'nome' => 'Leis Municipais',
		'ordem' => 0,
	),
	array(
		'id' => 45,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/2/mapas/', 
		'target' => '_self',
		'nome' => 'Mapas e Plantas',
		'ordem' => 0,
	),
	array(
		'id' => 46,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/noticias/3', 
		'target' => '_self',
		'nome' => 'Notícias',
		'ordem' => 0,
	),
	array(
		'id' => 47,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/20/cerest/', 
		'target' => '_self',
		'nome' => 'CEREST',
		'ordem' => 0,
	),
	array(
		'id' => 48,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/19/vigilancia-ambiental-em-saude/', 
		'target' => '_self',
		'nome' => 'Vigilância Ambiental em Saúde',
		'ordem' => 0,
	),
	array(
		'id' => 49,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/90/canil-municipal/', 
		'target' => '_self',
		'nome' => 'Canil Municipal',
		'ordem' => 0,
	),
	array(
		'id' => 50,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/servicos/1041/procon/', 
		'target' => '_self',
		'nome' => 'Procon',
		'ordem' => 0,
	),
	array(
		'id' => 51,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/semutran', 
		'target' => '_self',
		'nome' => 'Semutran',
		'ordem' => 0,
	),
	array(
		'id' => 52,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/terminal-rodoviario/', 
		'target' => '_self',
		'nome' => 'Terminal Rodoviário',
		'ordem' => 0,
	),
	array(
		'id' => 53,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/95/servico-de-coleta-seletiva/', 
		'target' => '_self',
		'nome' => 'Serviço de Coleta Seletiva',
		'ordem' => 0,
	),
	array(
		'id' => 54,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/servicos/1051/links-uteis/', 
		'target' => '_self',
		'nome' => 'Links úteis',
		'ordem' => 0,
	),
	array(
		'id' => 55,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/telefones/', 
		'target' => '_self',
		'nome' => 'Telefones Úteis',
		'ordem' => 0,
	),
	array(
		'id' => 56,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/contato', 
		'target' => '_self',
		'nome' => 'Contato',
		'ordem' => 0,
	),
	array(
		'id' => 57,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => 'https://www.cidade.sp.gov.br/portal/secretarias-paginas/3/logomarcas/', 
		'target' => '_self',
		'nome' => 'Logos da Prefeitura',
		'ordem' => 0,
	),
	array(
		'id' => 58,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/arquivos', 
		'target' => '_self',
		'nome' => 'Galeria de Arquivos',
		'ordem' => 0,
	),
	array(
		'id' => 59,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/galeria-de-fotos/', 
		'target' => '_self',
		'nome' => 'Galeria de Fotos',
		'ordem' => 0,
	),
	array(
		'id' => 60,
		'nivel' => 1,
		'pai' => 1,
		'submenu' => 0,
		'link' => '/portal/galeria-de-videos/', 
		'target' => '_self',
		'nome' => 'Galeria de Vídeos',
		'ordem' => 0,
	),

);

usort($menu_array, function( $a, $b ){//Função responsável por ordenar

	$al = mb_strtolower($a['ordem']);
	$bl = mb_strtolower($b['ordem']);
	
	if ($al == $bl){
		return 0;
	}
	
	return ($bl > $al) ? +1 : -1;
	
});


?>

<style><?php require 'css/menu_horizontal.css'; ?></style>

<div class="menu">

	<div class="menu-btns-campo">
	
		<div class="menu-btn menu_item_1">
			<span class="menu-btn-nome material-symbols-outlined">menu</span>
			<span class="menu-btn-base"></span>
		</div>
		
		<?php
			
			foreach( $menu_array as $menu ){
				
				if( 
					$menu['id'] > 1 
					&& $menu['nivel'] == 0
				){
					
					echo '
					<div class="menu-btn menu_item_'. $menu['id'] .'">
						<a href="'. $menu['link'] .'" target="'. $menu['target'] .'">
							<span class="menu-btn-nome">'. $menu['nome'] .' </span>
							<span class="menu-btn-base"></span>
						</a>
					</div>
					';
					
				}
				
			}
			
		?>
		
	</div>
	
</div>

<?php

foreach( $menu_array as $menu ){
	
	if( 
		$menu['nivel'] == 0 
		&& $menu['submenu'] == 1 
	){
		
		echo'
		<div class="submenu submenu_'. $menu['id'] .'">
			
			<div class="submenu-box submenu_box_'. $menu['id'] .'">
				';
				
				foreach( $menu_array as $submenu ){
					
					if( 
						$submenu['pai'] == $menu['id'] 
						&& $submenu['nivel'] == 1
					){
						
						echo'
						<div class="submenu-btn">
							<a href="'. $submenu['link'] .'" target="'. $submenu['target'] .'">
								<span>'. $submenu['nome'] .'</span>
							</a>
						</div>
						';
						
					}
					
				}
				
				echo'
			</div>
			
		</div>
		<script>
			
			if( document.querySelector(".submenu_'. $menu['id'] .'") ){
				
				let menu_item_'. $menu['id'] .' = document.querySelector(".menu_item_'. $menu['id'] .'");
				let submenu_'. $menu['id'] .' = document.querySelector(".submenu_'. $menu['id'] .'");
				let submenu_box_'. $menu['id'] .' = document.querySelector(".submenu_box_'. $menu['id'] .'");
				
				menu_item_'. $menu['id'] .'.addEventListener("mouseover", function() {
					menu_item_'. $menu['id'] .'.classList.add("on");
					submenu_'. $menu['id'] .'.classList.add("on");
					submenu_box_'. $menu['id'] .'.classList.add("on");
				});
				
				menu_item_'. $menu['id'] .'.addEventListener("mouseleave", function() {
					menu_item_'. $menu['id'] .'.classList.remove("on");
					submenu_'. $menu['id'] .'.classList.remove("on");
					submenu_box_'. $menu['id'] .'.classList.remove("on");
				});
				
				submenu_'. $menu['id'] .'.addEventListener("mouseover", function() {
					menu_item_'. $menu['id'] .'.classList.add("on");
					submenu_'. $menu['id'] .'.classList.add("on");
					submenu_box_'. $menu['id'] .'.classList.add("on");
				});
				
				submenu_'. $menu['id'] .'.addEventListener("mouseleave", function() {
					menu_item_'. $menu['id'] .'.classList.remove("on");
					submenu_'. $menu['id'] .'.classList.remove("on");
					submenu_box_'. $menu['id'] .'.classList.remove("on");
				});
				
			}
			
		</script>
		';
		
	}

}

?>
<!-- End - view/menu_horizontal.php !-->