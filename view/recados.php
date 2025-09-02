<!-- Start - view/recados.php !-->
<?php

$titulo = 'Titulo do assunto';
$mensagem = 'Mensagem.';
$btn_txt = 'Voltar';
$btn_link = './';

//dd( $_GET );

if (!empty($_GET['titulo'])) {
	$titulo = htmlspecialchars($_GET['titulo'], ENT_QUOTES, 'UTF-8');
}
if (!empty($_GET['mensagem'])) {
	$mensagem = htmlspecialchars($_GET['mensagem'], ENT_QUOTES, 'UTF-8');
}
if (!empty($_GET['btn_txt'])) {
	$btn_txt = htmlspecialchars($_GET['btn_txt'], ENT_QUOTES, 'UTF-8');
}
if (!empty($_GET['btn_link'])) {
	$btn_link = htmlspecialchars($_GET['btn_link'], ENT_QUOTES, 'UTF-8');
}

?>

<style>
	<?php 
		require 'css/noticia.css';  
	?>
</style>

<section class="noticia" title="recados">
	
	<div class="box">
		
		<div class="noticia-campo">
			
			<div class="noticia-titulo"><?php echo $titulo; ?></div>
			
			<div class="separador"></div>
			
			<div class="noticia-texto"><?php echo $mensagem; ?></div>
			
			<div class="separador"></div>
			
			<div class="col100">
				<a href="<?php echo $btn_link; ?>"><button class="cadastro-btn"><?php echo $btn_txt; ?></button></a>
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- End - view/recados.php !-->