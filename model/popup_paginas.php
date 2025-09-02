<?php

$sql_popup_paginas = "SELECT * FROM popup_paginas WHERE ativo = 1";

$popup_paginas_tabela = $conn->query( $sql_popup_paginas );

$popup_paginas_array = array();

while( $popup_paginas_montado = $popup_paginas_tabela->fetch_assoc() ){
	
	$popup_paginas_array[] = $popup_paginas_montado;
	
}

//dd( $popup_paginas_array );

?>