<?php
$raiz_site = $raiz_admin .'../';
$raiz_admin = $raiz_admin .'';

require $raiz_site .'model/admin_user.php'; 

require $raiz_admin .'css/dinamico.css'; 
require $raiz_admin .'css/animacoes.css'; 
require $raiz_admin .'css/paleta.css'; 

foreach( $admin_user_array as $cfg ){

	if( $cfg['tema'] == 'escuro' && $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $cfg['usuario'] ){ 
		require $raiz_admin .'css/escuro.css'; 
		require $raiz_admin .'css/tail.select-dark.css'; 
	}
	
	if( $cfg['tema'] == 'claro' && $_COOKIE['fronteira_ADMIN_SESSION_usuario'] == $cfg['usuario'] ){ 
		require $raiz_admin .'css/claro.css'; 
		require $raiz_admin .'css/tail.select-light.css'; 
	}
	
}

require $raiz_admin .'css/tail-select.css'; 
require $raiz_admin .'css/estilo.css'; 
require $raiz_admin .'css/tabela.css'; 
require $raiz_admin .'css/menu.css'; 
require $raiz_admin .'css/topo.css'; 
require $raiz_admin .'css/box-usuario.css'; 
require $raiz_admin .'css/conteudo.css'; 
require $raiz_admin .'css/lightbox.css'; 
require $raiz_admin .'css/box.css'; 
require $raiz_admin .'css/escolher-imagem.css'; 
require $raiz_admin .'css/escolher-favicon.css'; 
require $raiz_admin .'css/escolher-img_redes.css'; 
require $raiz_admin .'css/escolher-imagem-adm.css'; 
require $raiz_admin .'css/escolher-imagem-cards.css'; 
require $raiz_admin .'css/loading.css'; 
require $raiz_admin .'css/card.css'; 
require $raiz_admin .'css/documentos-vinculados.css'; 
require $raiz_admin .'css/copiar.css'; 
require $raiz_admin .'css/submenu-novo-btn.css'; 
require $raiz_admin .'css/aviso.css'; 
require $raiz_admin .'css/caixa-checkbox.css'; 
require $raiz_admin .'css/dialogo.css'; 
require $raiz_admin .'css/thumb.css'; 

?>