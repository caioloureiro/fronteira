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
require $raiz_site .'model/acessos_log.php'; 

// Agrupar acessos por URL
function agruparAcessosPorURL($acessos_log_array) {
	$acessos_por_url = [];

	foreach ($acessos_log_array as $item) {
		$url = $item['url']; // Supondo que o campo da URL é 'url'
		
		if (!isset($acessos_por_url[$url])) {
			$acessos_por_url[$url] = 0;
		}
		
		$acessos_por_url[$url]++;
	}
	
	return $acessos_por_url;
}

// Acessos por URL
$acessos_por_url = agruparAcessosPorURL($acessos_log_array);

// Ordenar pela quantidade de acessos (decrescente)
arsort($acessos_por_url);

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="lightbox acessos_log-visualizar on">
			
			<div class="lightbox-titulo">

				Páginas mais acessadas
				<div class="lightbox-fechar" onClick="voltar()" style="background-image:url( <?php echo $raiz_admin ?>img/fechar.svg );"></div>
				
			</div>
			
			<div class="linha linha-auto">
			
				<table class="tabela_logs_paginas">
		
					<thead>
						<tr>
							<th style="width:10vw;">Quantidade</th>
							<th>Página</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($acessos_por_url as $url => $quantidade): ?>
							<tr>
								<td><?php echo $quantidade; ?></td>
								<td><a href="<?php echo '../../../..'. htmlspecialchars($url); ?>" target="_blank"><?php echo htmlspecialchars($url); ?></a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					
				</table>
				
				<div id="tabela_logs_paginas_paginacao" class="pagination"></div>
				
			</div>

			<div class="linha-acao"> 
				<div class="btn" onclick="voltar()">Voltar</div>
			</div>
			
			<div class="separador"></div>
			
		</div>
		
		<script>
			
			function voltar(){
				
				window.location.href = '<?php echo $raiz_admin ?>matriz?pagina=acessos_log';
				
			}
			
			let tabela_datatable = document.querySelector('.tabela_logs_paginas');
			
			var datatable = new DataTable(tabela_datatable, {
				pageSize: 100, /* QUANTOS ITENS POR PÁGINA */
				sort: [true], /* QUANTAS COLUNAS? ORDENAÇÃO */
				filters: [true], /* QUANTAS COLUNAS? FILTROS */
				filterText: 'Buscar... ', /* PLACEHOLDER DO FILTRO */
				pagingDivSelector: "#tabela_logs_paginas_paginacao"
			});
			
		</script>
		
	</body>
	
</html>