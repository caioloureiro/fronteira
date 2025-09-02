<!-- start - view/popup.php !-->
<?php 
require 'model/popup.php'; 
$popup = 0;
foreach( $popup_array as $pop ){
	
	$popup_ativado = $pop['ativado'];
	$popup_conteudo = $pop['conteudo'];
	$popup_tipo = $pop['tipo'];
	
}
?>

<style><?php require 'css/popup.css'; ?></style>

<div class="popup-escurecer <?php if( $popup_ativado == 1 ){ echo'on'; } ?>">
	<div class="popup-escurecer-fechar"><?php require 'img/fechar.svg'; ?></div>
</div>
<div class="popup-item <?php if( $popup_tipo == 'imagem' ){ echo'transparente popup-somenteimagem '; } if( $popup_ativado == 1 ){ echo'on'; } ?>"><?php echo $popup_conteudo ?></div>

<script>

let popup_escurecer = document.querySelector('.popup-escurecer');
let popup_item = document.querySelector('.popup-item');

popup_escurecer.addEventListener("click", function() {
	
	popup_escurecer.classList.remove("on");
	popup_item.classList.remove("on");
	
});

</script>
<!-- end - view/popup.php !-->