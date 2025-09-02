<!-- Start - view/dengue.php !-->
<?php

require 'model/paginas_fixas.php';
require 'model/dengue.php';

$pagina_texto = '';

foreach( $paginas_fixas as $pag ){
	
	if( $pag['pagina'] == $_GET['pagina'] ){ 
		$pagina_link = $pag['pagina']; 
		$pagina_titulo = $pag['titulo']; 
		$pagina_texto = $pag['texto']; 
	}
	
}

$hoje = date( 'Y-m-d H:i:s' );

$data = 0;
$confirmados = 0;
$casos_autoctones = 0;
$casos_importados = 0;
$descartados = 0;
$aguardando = 0;
$notificacoes = 0;
$casos_regiao_norte = 0;
$casos_regiao_sul = 0;
$casos_regiao_central = 0;
$casos_regiao_leste = 0;
$casos_regiao_oeste = 0;

$data = data_tempo( $hoje );

foreach( $dengue_array as $item ){
	
	if( $item['data'] != 0 ){ $data = $item['data']; }
	if( $item['confirmados'] != 0 ){ $confirmados = $item['confirmados']; }
	if( $item['descartados'] != 0 ){ $descartados = $item['descartados']; }
	if( $item['notificacoes'] != 0 ){ $notificacoes = $item['notificacoes']; }
	if( $item['aguardando'] != 0 ){ $aguardando = $item['aguardando']; }
	if( $item['casos_autoctones'] != 0 ){ $casos_autoctones = $item['casos_autoctones']; }
	if( $item['casos_importados'] != 0 ){ $casos_importados = $item['casos_importados']; }
	
	if( $item['casos_regiao_norte'] != 0 ){ $casos_regiao_norte = $item['casos_regiao_norte']; }
	if( $item['casos_regiao_sul'] != 0 ){ $casos_regiao_sul = $item['casos_regiao_sul']; }
	if( $item['casos_regiao_central'] != 0 ){ $casos_regiao_central = $item['casos_regiao_central']; }
	if( $item['casos_regiao_leste'] != 0 ){ $casos_regiao_leste = $item['casos_regiao_leste']; }
	if( $item['casos_regiao_oeste'] != 0 ){ $casos_regiao_oeste = $item['casos_regiao_oeste']; }
	
	$data = data_tempo( $item['data'] );
	
}

?>

<style><?php require 'css/dengue.css'; ?></style>

<section class="dengue">
	
	<div class="box">
	
		<div class="dengue-txt"><?php echo $pagina_texto ?></div>
		
		<div class="dengue-data">Última atualização: <?php echo $data ?></div>
	
		<div class="dengue-grid">
			
			<div class="dengue-linha">
				<div class="dengue-celula">
					<div class="dengue-item vermelho">
						<div class="dengue-icone"><span class="material-symbols-outlined">add_circle</span></div>
						<div class="dengue-nome">Confirmados</div>
						<div class="dengue-valor"><?php echo $confirmados ?></div>
					</div>
				</div>
				<div class="dengue-celula">
					<div class="dengue-item verde">
						<div class="dengue-icone"><span class="material-symbols-outlined">accessibility_new</span></div>
						<div class="dengue-nome">Descartados</div>
						<div class="dengue-valor"><?php echo $descartados ?></div>
					</div>
				</div>
				<div class="dengue-celula">
					<div class="dengue-item amarelo">
						<div class="dengue-icone"><span class="material-symbols-outlined">hourglass_bottom</span></div>
						<div class="dengue-nome">Notificações</div>
						<div class="dengue-valor"><?php echo $notificacoes ?></div>
					</div>
				</div>
			</div>
			
			<div class="dengue-linha">
				<div class="dengue-celula">
					<div class="dengue-item amarelo">
						<div class="dengue-icone"><span class="material-symbols-outlined">hourglass_bottom</span></div>
						<div class="dengue-nome">Aguardando</div>
						<div class="dengue-valor"><?php echo $aguardando ?></div>
					</div>
				</div>
				<div class="dengue-celula" title="Casos de dentro do estado.">
					<div class="dengue-item laranja">
						<div class="dengue-icone"><span class="material-symbols-outlined">sick</span></div>
						<div class="dengue-nome">Casos Autóctones</div>
						<div class="dengue-valor"><?php echo $casos_autoctones ?></div>
					</div>
				</div>
				<div class="dengue-celula" title="Casos vindos de fora do estado.">
					<div class="dengue-item laranja">
						<div class="dengue-icone"><span class="material-symbols-outlined">sick</span></div>
						<div class="dengue-nome">Casos Importados</div>
						<div class="dengue-valor"><?php echo $casos_importados ?></div>
					</div>
				</div>
			</div>
			
		</div>
		
		<div class="separador"></div>
		
		<div class="dengue-grid">
			
			<div class="dengue-linha">
				<div class="dengue-celula">
					<div class="dengue-item">
						<div class="dengue-icone"><span class="material-symbols-outlined">explore</span></div>
						<div class="dengue-nome">Região Norte</div>
						<div class="dengue-valor"><?php echo $casos_regiao_norte ?></div>
					</div>
				</div>
				<div class="dengue-celula">
					<div class="dengue-item">
						<div class="dengue-icone"><span class="material-symbols-outlined">explore</span></div>
						<div class="dengue-nome">Região Sul</div>
						<div class="dengue-valor"><?php echo $casos_regiao_sul ?></div>
					</div>
				</div>
				<div class="dengue-celula">
					<div class="dengue-item">
						<div class="dengue-icone"><span class="material-symbols-outlined">explore</span></div>
						<div class="dengue-nome">Região Centro</div>
						<div class="dengue-valor"><?php echo $casos_regiao_central ?></div>
					</div>
				</div>
			</div>
			
			<div class="dengue-linha">
				<div class="dengue-celula">
					<div class="dengue-item">
						<div class="dengue-icone"><span class="material-symbols-outlined">explore</span></div>
						<div class="dengue-nome">Região Leste</div>
						<div class="dengue-valor"><?php echo $casos_regiao_leste ?></div>
					</div>
				</div>
				<div class="dengue-celula">
					<div class="dengue-item">
						<div class="dengue-icone"><span class="material-symbols-outlined">explore</span></div>
						<div class="dengue-nome">Região Oeste</div>
						<div class="dengue-valor"><?php echo $casos_regiao_oeste ?></div>
					</div>
				</div>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/dengue.php !-->