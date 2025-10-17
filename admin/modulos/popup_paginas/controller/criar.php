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
require $raiz_site .'model/popup_paginas.php';

//dd( $_POST );

$check_alvo = 0;

foreach( $popup_paginas_array as $item ){

	if( 
		$item['alvo'] == $_POST['alvo'] 
		&& $item['alvo_id'] == $_POST['alvo_id'] 
	){
		
		$check_alvo = 1;
		
	}
	
}

//echo '$check_alvo: '. $check_alvo; exit;
if( $check_alvo == 1 ){
	echo'<script>alert("Já existe um Popup para esta página."); window.history.back();</script>';
	exit;
}

if( !isset( $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ) ){
	echo'<script>alert("Você precisa estar logado."); window.history.back();</script>';
	exit;
}

if( $_POST['alvo_id'] == '' ){
	echo'<script>alert("Escolha o destino do popup."); window.history.back();</script>';
	exit;
}

if( $_POST['editor_texto'] == '' ){
	echo'<script>alert("Preencha o conteúdo."); window.history.back();</script>';
	exit;
}

$tipo = $_POST['tipo'];
$alvo = $_POST['alvo'];
$alvo_id = $_POST['alvo_id'];
$conteudo = $_POST['editor_texto'];

$hoje = date( 'Y-m-d H:i:s' ) ;
//dd( $hoje );

$sql = "INSERT INTO popup_paginas (
	ativado, 
	tipo, 
	alvo, 
	alvo_id, 
	conteudo
) VALUES (".
	"1, ".
	"'". $tipo ."', ".
	"'". $alvo ."', ".
	"". $alvo_id .", ".
	"'". $conteudo ."'".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Tabela: popup_paginas. Criou o alvo ". $alvo ." e alvo_id: ". $alvo_id ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

?>
<!doctype html>
<html lang="pt-br" prefix="og: https://ogp.me/ns#">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Painel de Controle</title>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/css/datatable.css" integrity="sha512-zHpjdnFxcMInClTw4ZqdX6NNLuPU+iJMZEQsyIjXuQX8TZXzRhZIlUi0tQTGQxt/UGruFgs0qTBshuGN0ts/vQ==" crossorigin="anonymous" />
	</head>
	<body>
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>
		
		<div class="box">
		
			<?php
			
				if ( $conn->multi_query( $sql ) === TRUE ) {

					echo'
					<script>
						alert("Item criado com sucesso."); 
						window.location.href = "'. $raiz_admin .'matriz?pagina=popup_paginas";
					</script>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=popup_paginas" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}

    // NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php
    // $conn->close();
				
			?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>