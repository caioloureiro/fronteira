<?php

$lorem_ipsum = '
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu lacinia orci. Nulla euismod hendrerit orci, vel consectetur ipsum efficitur in. In hac habitasse platea dictumst. Nulla sit amet mi et lectus molestie vestibulum. Proin vel faucibus diam. In accumsan, massa ut interdum laoreet, mi arcu laoreet erat, ac tincidunt nunc turpis eu ipsum. Aliquam ultrices, augue sit amet dapibus eleifend, mauris arcu luctus libero, tincidunt varius nunc ex non sapien. Nunc egestas purus quis augue condimentum, id finibus lectus ultricies. Ut suscipit malesuada blandit. Ut mollis, diam semper luctus condimentum, nulla tortor interdum quam, id semper dolor ligula a erat. Duis fermentum viverra molestie. Nulla facilisi. Nulla ac mauris sed elit imperdiet lobortis. Nulla ullamcorper pretium molestie.</p>
<p>Nam eleifend orci dolor, vitae pretium orci feugiat eu. Quisque facilisis pulvinar mi iaculis lobortis. Cras congue interdum varius. Nam dapibus viverra enim et dapibus. Mauris euismod venenatis arcu, eget dictum sapien ultricies in. Nunc sit amet maximus sem. Maecenas sit amet massa felis. Fusce congue arcu et leo pellentesque pellentesque. Nunc suscipit mi ac urna lacinia euismod. Duis dui est, iaculis ac feugiat quis, molestie vel est. Donec mauris justo, malesuada sodales aliquet vel, suscipit in sem. Nam bibendum aliquam varius.</p>
<p>Duis pulvinar convallis dapibus. In ut sapien pharetra, scelerisque nisl eget, molestie ligula. Fusce nec ipsum tempor, sagittis lorem id, ornare ligula. Aenean et tincidunt orci. Nam eu ullamcorper libero. Nullam lorem neque, feugiat a ornare vitae, molestie ut nulla. Sed aliquam id ipsum nec luctus. Donec ut vulputate felis.</p>
<p>Praesent consequat nisl dui. Donec sodales bibendum mi non posuere. Suspendisse potenti. Nam pretium vel lectus non luctus. Nam non elit eros. Vivamus hendrerit fermentum nibh non egestas. Praesent condimentum lacus dui, ultricies lacinia ipsum euismod a. Vestibulum ultricies sagittis orci cursus tempus. Nunc egestas erat laoreet interdum tristique. Maecenas consequat elementum varius.</p>
<p>Donec urna odio, ultrices id euismod eu, suscipit nec odio. Nulla et justo consectetur odio suscipit molestie ut nec ex. Aliquam erat volutpat. Morbi sodales metus nec elit sagittis, a eleifend nisi cursus. Proin mauris ante, imperdiet a magna at, maximus dignissim sem. Ut condimentum finibus metus, in egestas diam sagittis eu. Donec imperdiet turpis quis nisi interdum rhoncus. Phasellus eu lacinia nulla. Phasellus luctus ac lorem eget faucibus. </p>
';

$titulo_generico = 'Título da notícia Título da notícia Título da notícia Título da notícia Título da notícia Título da notícia ';
$resumo_generico = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu lacinia orci. Nulla euismod hendrerit orci, vel consectetur ipsum efficitur in. In hac habitasse platea dictumst. Nulla sit amet mi et lectus molestie vestibulum. Proin vel faucibus diam. In accumsan, massa ut interdum laoreet, mi arcu laoreet erat, ac tincidunt nunc turpis eu ipsum. Aliquam ultrices, augue sit amet dapibus eleifend, mauris arcu luctus libero, tincidunt varius nunc ex non sapien. Nunc egestas purus quis augue condimentum, id finibus lectus ultricies. Ut suscipit malesuada blandit. Ut mollis, diam semper luctus condimentum, nulla tortor interdum quam, id semper dolor ligula a erat. Duis fermentum viverra molestie. Nulla facilisi. Nulla ac mauris sed elit imperdiet lobortis. Nulla ullamcorper pretium molestie.';

function btn( $texto, $classe, $id, $tipo, $parametro ){
	
	return '<button class="'.$classe.'" type="'.$tipo.'" id="'.$id.'" '.$parametro.' >'.$texto.'</button>';
	
}

function btn_vermelho( $texto ){
	
	return btn(
		$texto,
		'',
		'',
		'',
		'style="background-color:red"'
	);
	
}

?>