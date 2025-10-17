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

//dd( $_POST );

if( $_POST['editor_texto'] == '' ){
	
	echo'
	<script>
		alert("O texto não pode ficar em branco.");
		window.history.back();
	</script>
	';
	
	exit;
}

$titulo = $_POST['titulo'];
$texto = $_POST['editor_texto'];
//dd( $texto );

$info = $_POST['info'];
$representante = $_POST['representante'];
$foto = $_POST['imagem'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$horario = $_POST['horario'];
$site = $_POST['site'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$twitter = $_POST['twitter'];
$localizacao = $_POST['localizacao'];

$pagina = renomear( $titulo );
//dd( $pagina );

$titulo = str_replace( "'", "&apos;", $titulo );
$texto = str_replace( "'", "&apos;", $texto );

$sql = "INSERT INTO paginas (
	pagina,
	titulo,
	info,
	representante,
	foto,
	telefone,
	endereco,
	email,
	horario,
	site,
	facebook,
	instagram,
	twitter,
	localizacao,
	texto
) VALUES (".
	"'". $pagina ."',".
	"'". $titulo ."',".
	"'". $info ."',".
	"'". $representante ."',".
	"'". $foto ."',".
	"'". $telefone ."',".
	"'". $endereco ."',".
	"'". $email ."',".
	"'". $horario ."',".
	"'". $site ."',".
	"'". $facebook ."',".
	"'". $instagram ."',".
	"'". $twitter ."',".
	"'". $localizacao ."',".
	"'". $texto ."'".
");";

$sql .= "INSERT INTO rastrear_usuario (usuario, descricao, horario) VALUES ('". $_COOKIE['fronteira_ADMIN_SESSION_usuario'] ." - ". $_SERVER['REMOTE_ADDR'] ."','Criou a página ". $titulo ."','". date( 'Y-m-d H:i:s' ) ."');";

//echo $sql; die();

// Executar SQL e processar anexos
if ( $conn->multi_query( $sql ) === TRUE ) {
	
	// Aguardar todas as queries serem executadas
	do {
		$conn->store_result();
	} while ($conn->next_result());
	
	// Buscar o ID da página recém-criada
	$result = $conn->query("SELECT id FROM paginas WHERE pagina = '". $pagina ."' ORDER BY id DESC LIMIT 1");
	$row = $result->fetch_assoc();
	$pagina_id = $row['id'];
	
	// Processar anexos do computador (enviados temporariamente)
	$pasta_uploads = $raiz_site .'uploads/';
	$arquivos = glob($pasta_uploads . date('Y-m-d-H-i') . '*');
	
	// Adicionar também arquivos do minuto anterior
	$minuto_anterior = date('Y-m-d-H-i', strtotime('-1 minute'));
	$arquivos = array_merge($arquivos, glob($pasta_uploads . $minuto_anterior . '*'));
	
	foreach($arquivos as $arquivo_path) {
		$nome_arquivo = basename($arquivo_path);
		
		$sql_anexo = "INSERT INTO paginas_anexos (
			ativo,
			created_at,
			updated_at,
			nome, 
			arquivo, 
			pagina
		) VALUES (
			1,
			'". date( 'Y-m-d H:i:s' ) ."',
			'". date( 'Y-m-d H:i:s' ) ."', 
			'". addslashes($nome_arquivo) ."', 
			'". addslashes($nome_arquivo) ."', 
			'". $pagina_id ."' 
		)";
		
		$conn->query($sql_anexo);
	}
	
	// Processar anexos do servidor (se houver)
	if(isset($_POST['anexos_servidor']) && is_array($_POST['anexos_servidor'])) {
		foreach($_POST['anexos_servidor'] as $nome_arquivo) {
			$nome_arquivo = basename($nome_arquivo); // Segurança: apenas o nome do arquivo
			
			$sql_anexo = "INSERT INTO paginas_anexos (
				ativo,
				created_at,
				updated_at,
				nome, 
				arquivo, 
				pagina
			) VALUES (
				1,
				'". date( 'Y-m-d H:i:s' ) ."',
				'". date( 'Y-m-d H:i:s' ) ."', 
				'". addslashes($nome_arquivo) ."', 
				'". addslashes($nome_arquivo) ."', 
				'". $pagina_id ."' 
			)";
			
			$conn->query($sql_anexo);
	}
}

$sucesso = true;
} else {
$sucesso = false;
$erro = $conn->error;
}

// NÃO fechar a conexão aqui porque css-modulo.php precisa dela para carregar admin_user.php
// $conn->close();

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
		
		<style><?php require $raiz_admin .'routes/css-modulo.php'; ?></style>		<div class="box">
		
			<?php
			
				if ( $sucesso === true ) {

					echo'
					<div class="alerta-verde">Item criado com sucesso.</div>
					<a href="'. $raiz_admin .'matriz?pagina=paginas" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				} else {

					echo'
					<div class="alerta-vermelho">Error: ' . $erro .'</div>
					<a href="'. $raiz_admin .'matriz?pagina=paginas" ><div class="linha"><button>Retornar</button></div></a>
					';
					
				}
			
		?>
			
		</div>
		
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatable/2.0.1/js/datatable.js" integrity="sha512-9Jte0+zkyqOLUDxEfIz74iRN9geJm2oBwSYDdZVLzBWa3cxGh0YWw4/aBmq2FTJodryloQjd7mCxHo+gHQwzcA==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo $raiz_admin ?>js/motor.js"></script>	
		
	</body>
	
</html>
<?php 
// Fechar conexão no final
if (isset($conn)) {
	$conn->close();
}
?>