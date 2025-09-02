<!-- Start - view/organograma.php !-->
<?php

require 'model/organograma.php';

function gerarOrganograma($array, $pai = 0) {
	
	$html = '';

	foreach ($array as $item) {
		
		if ($item['pai'] == $pai) {
			
			// Adiciona o item atual com um <details>
			$html .= '
			<details class="organograma-first" open>
				<summary>' . $item['nome'] . '</summary>';
			
				// Chama a função recursivamente para buscar os filhos
				$html .= gerarOrganograma($array, $item['id']);

				$html .= '
			</details>';
			
		}
		
	}

	return $html;
	
}

?>

<style><?php require 'css/organograma.css'; ?></style>

<section class="organograma">
	
	<div class="box">
		
		<h3><a href="https://leismunicipais.com.br/a/sp/b/cidade/lei-complementar/2011/92/912/lei-complementar-n-912-2011-dispoe-sobre-a-reorganizacao-administrativa-do-poder-executivo-e-da-outras-providencias?q=organograma" target="_blank">LEI COMPLEMENTAR Nº 912, de 13 de dezembro de 2011 - DISPÕE SOBRE A REORGANIZAÇÃO ADMINISTRATIVA DO PODER EXECUTIVO E DÁ OUTRAS PROVIDÊNCIAS.</a></h3>
		
		<p>
			<div 
				class="organograma-btn"
				onclick="recolherTudo()"
			>Recolher todos os itens</div>
			<div 
				class="organograma-btn"
				onclick="expandirTudo()"
			>Expandir todos os itens</div>
		</p>
		
		<div class="separador"></div>
		
		<?php
		
			// Gera a hierarquia a partir do pai inicial (id = 0)
			echo gerarOrganograma($organograma_array);
			
        ?>
		
	</div>
	
</section>

<script>

function recolherTudo() {
	
    // Seleciona todas as tags <details> na página
    const detailsElements = document.querySelectorAll('details');
    
    // Itera sobre cada elemento <details> encontrado
    detailsElements.forEach(detail => {
        // Remove o atributo "open" do elemento <details>
        detail.removeAttribute('open');
    });
	
}

function expandirTudo() {
	
    // Seleciona todas as tags <details> na página
    const detailsElements = document.querySelectorAll('details');
    
    // Itera sobre cada elemento <details> encontrado
    detailsElements.forEach(detail => {
        // Adiciona o atributo "open" ao elemento <details>
        detail.setAttribute('open', '');
    });
	
}

</script>
<!-- End - view/organograma.php !-->