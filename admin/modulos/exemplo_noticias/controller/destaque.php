<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
date_default_timezone_set('America/Sao_Paulo');

if( $_SERVER['HTTP_HOST'] == 'localhost' ){

	require $raiz_site .'model/conexao-off.php';

}else{
	
	require $raiz_site .'model/conexao-on.php';
	
}

require $raiz_site .'controller/funcoes.php';
require $raiz_site .'model/exemplos.php';

//dd( $_GET );

$novo_status = 0;
$nova_ordem = 0;

$nova_ordem_1 = 0;
$nova_ordem_2 = 0;
$nova_ordem_3 = 0;

if( $_GET['btn_status'] == 0 ){ 

	$novo_status = 1; 
	
	foreach( $exemplos_array as $item ){

		if( $item['destaque'] == 1 ){ 
			
			//echo $item['destaque_ordem'] .'<br/>';
			if( $item['destaque_ordem'] == 1 ){ $nova_ordem_1 = 1; }
			if( $item['destaque_ordem'] == 2 ){ $nova_ordem_2 = 1; }
			if( $item['destaque_ordem'] == 3 ){ $nova_ordem_3 = 1; }
			
		}

	}
	
	if( $nova_ordem_1 == 0 ){ $nova_ordem = 1; }
	if( $nova_ordem_2 == 0 ){ $nova_ordem = 2; }
	if( $nova_ordem_3 == 0 ){ $nova_ordem = 3; }
	
	//dd( $nova_ordem );
	
}

if( $_GET['btn_status'] == 1 ){ 

	$novo_status = 0; 
	$nova_ordem = 0;
	
}

$count_destaques = 0;

foreach( $exemplos_array as $item ){

	if( $item['destaque'] == 1 ){ $count_destaques++; }

}

//dd( $count_destaques );

if( 
	$count_destaques >= 3 &&
	$novo_status == 1
){
	echo'
	<script>
		alert("Só pode haver 3 destaques por vez.");
		window.history.back();
	</script>
	';
	exit;
}

$sql = "UPDATE exemplos SET ".
"destaque = '". $novo_status ."', ".
"destaque_ordem = '". $nova_ordem ."' ".
"WHERE id = ". $_GET['id'] .";";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Modificou o destaque do exemplo ID: ". $_GET['id'] ."','". date( 'Y-m-d H:i:s' ) ."');";

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
			
				if ($conn->multi_query( $sql ) === TRUE) {

					echo'
					<div class="alerta-verde">Item destacado com sucesso.</div>
					<a href="'. $raiz_admin .'matriz?pagina=exemplos" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Erro: ' . $sql . '<br/><br/>' . $conn->error .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=exemplos" ><div class="linha"><button>Retornar</button></div></a>
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