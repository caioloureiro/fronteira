<!-- Start - admin/modulos/acessos_log/wiew/home.php !-->
<?php 
require $raiz_site .'model/acessos_log.php'; 

// Função para contar acessos por período
function contarAcessosPorPeriodo($acessos_log_array, $intervalo) {
	$contagem = 0;
	$data_atual = strtotime(date('Y-m-d H:i:s')); // Converte a data atual para timestamp

	foreach ($acessos_log_array as $item) {
		$data_acesso = strtotime($item['horario']); // Converte o campo 'horario' em timestamp

		// Calcula a diferença entre a data atual e a data do acesso em segundos
		$diferenca_segundos = $data_atual - $data_acesso;

		// Converte a diferença para dias, meses ou anos
		switch ($intervalo) {
			case 'diario':
				// Verifica se está no mesmo dia
				if (date('Y-m-d', $data_atual) === date('Y-m-d', $data_acesso)) {
					$contagem++;
				}
				break;
			case 'mensal':
				// Verifica se está dentro do mesmo mês
				if (date('Y-m', $data_atual) === date('Y-m', $data_acesso)) {
					$contagem++;
				}
				break;
			case 'bimestral':
				// Verifica se está dentro dos últimos 2 meses
				$mes_atual = date('Y-m', $data_atual);
				$mes_acesso = date('Y-m', $data_acesso);
				$dif_meses = abs((date('Y', $data_atual) - date('Y', $data_acesso)) * 12 + (date('m', $data_atual) - date('m', $data_acesso)));
				if ($dif_meses < 2) {
					$contagem++;
				}
				break;
			case 'trimestral':
				// Verifica se está dentro dos últimos 3 meses
				$dif_meses = abs((date('Y', $data_atual) - date('Y', $data_acesso)) * 12 + (date('m', $data_atual) - date('m', $data_acesso)));
				if ($dif_meses < 3) {
					$contagem++;
				}
				break;
			case 'semestral':
				// Verifica se está dentro dos últimos 6 meses
				$dif_meses = abs((date('Y', $data_atual) - date('Y', $data_acesso)) * 12 + (date('m', $data_atual) - date('m', $data_acesso)));
				if ($dif_meses < 6) {
					$contagem++;
				}
				break;
			case 'anual':
				// Verifica se está dentro do mesmo ano
				if (date('Y', $data_atual) === date('Y', $data_acesso)) {
					$contagem++;
				}
				break;
		}
	}

	return $contagem;
}

// Total de acessos por intervalo
$total_acessos_diario = contarAcessosPorPeriodo($acessos_log_array, 'diario');
$total_acessos_mensal = contarAcessosPorPeriodo($acessos_log_array, 'mensal');
$total_acessos_bimestral = contarAcessosPorPeriodo($acessos_log_array, 'bimestral');
$total_acessos_trimestral = contarAcessosPorPeriodo($acessos_log_array, 'trimestral');
$total_acessos_semestral = contarAcessosPorPeriodo($acessos_log_array, 'semestral');
$total_acessos_anual = contarAcessosPorPeriodo($acessos_log_array, 'anual');

?>

<style><?php require 'css/destaque-btn.css'; ?></style>

<div class="conteudo acessos_log">
	<div class="titulo">Log de Acessos</div>
	<div class="conteudo-tabela-janela">
		<?php
		$total_de_acessos = count($acessos_log_array);
		?>
		
		<p>Total de acessos desde 08-jan-2025: <strong><?php echo $total_de_acessos ?></strong></p>
		<p>Acessos no último dia: <strong><?php echo $total_acessos_diario ?></strong></p>
		<p>Acessos no último mês: <strong><?php echo $total_acessos_mensal ?></strong></p>
		<p>Acessos nos últimos 2 meses (bimestral): <strong><?php echo $total_acessos_bimestral ?></strong></p>
		<p>Acessos nos últimos 3 meses (trimestral): <strong><?php echo $total_acessos_trimestral ?></strong></p>
		<p>Acessos nos últimos 6 meses (semestral): <strong><?php echo $total_acessos_semestral ?></strong></p>
		<p>Acessos no último ano: <strong><?php echo $total_acessos_anual ?></strong></p>
		
		<div class="separador"></div>
		
		<a href="<?php echo $raiz_admin ?>modulos/acessos_log/view/mais_acessadas.php"><div class="btn">Páginas mais acessadas</div></a>
		
	</div>
</div>
<!-- End - admin/modulos/acessos_log/wiew/home.php !-->
