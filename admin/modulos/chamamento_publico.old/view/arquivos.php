<div class="lightbox item-arquivos" style="z-index:99999">

	<div class="lightbox-titulo">

		Pasta <?php echo $pasta_nome ?>
		<div class="lightbox-fechar" onClick="sair_item_arquivos()" style="background-image:url( ../../../img/fechar.svg );" ></div>
		
	</div>
	
	<div class="escolher-imagem-cards-campo">
		<input type="text" class="escolher-imagem-cards-input" placeholder="Filtrar..."/>
	</div>
	
	<div class="escolher-imagem-cards-box">
	
		<?php
			
			$downloads_array = array_reverse( $downloads_array );
			
			foreach( $downloads_array as $file ){

				echo'
				<div
					onClick="
						let item_arquivos = document.querySelector(`.item-arquivos`);
						let item_escolher_arquivo_input = document.querySelector(`.item-escolher-arquivo-input`);
						item_escolher_arquivo_input.value = item_escolher_arquivo_input.value +`'. $file['id'] .';` ;
						
						let anexos = document.querySelector(`.anexos`);
						
						let criando_anexo = document.createElement(`div`);
						criando_anexo.className = `anexo anexo_'. $file['id'] .'` ;
						anexos.appendChild(criando_anexo);
						
						let preenchendo_anexo = document.querySelector(`.anexo.anexo_'. $file['id'] .'`);
						
						let preenchendo_anexo_div_nome = document.createElement(`div`);
						preenchendo_anexo_div_nome.className = `anexo-nome`;
						preenchendo_anexo_div_nome.innerText = `'. $file['arquivo'] .'`;
						preenchendo_anexo.appendChild(preenchendo_anexo_div_nome);
						
						let preenchendo_anexo_div_excluir = document.createElement(`div`);
						preenchendo_anexo_div_excluir.className = `anexo-excluir`;
						preenchendo_anexo_div_excluir.setAttribute(`onclick`, `excluirArquivo( '. $file['id'] .' )`);
						preenchendo_anexo_div_excluir.innerHTML = `X`;
						preenchendo_anexo.appendChild(preenchendo_anexo_div_excluir);
						
						item_arquivos.classList.remove(`on`);
					"
					class="
						linha 
						escolher-arquivo-cards-card
					"
				>

					<div 
						class="
							col100
							escolher-arquivo-cards-titulo
						"
					><span>'. $file['id'] .': '. $file['nome'] .'</span></div>
					
				</div>
				';
				
			}
			
		?>
		
	</div>

</div>

<script>
/*Start - Filtro REATIVO*/
let itens = document.querySelector('.escolher-imagem-cards-box');
let itens_busca = document.querySelector('.escolher-imagem-cards-input');

if( itens ){
	
	itens_busca.addEventListener('keyup', function() {

		let itens_busca = document.querySelector('.escolher-imagem-cards-input').value.toUpperCase();
		let itens = document.querySelector('.escolher-imagem-cards-box');
		
		let card = itens.querySelectorAll('.escolher-arquivo-cards-card');
		
		for( let i = 0; i < card.length; i++ ){

			let a = card[i].querySelector('.escolher-arquivo-cards-titulo');
			
			if( a.innerHTML.toUpperCase().indexOf( itens_busca ) > -1 ){
				
				card[i].style.display = '';
				
			}else{
				
				card[i].style.display = 'none';
				
			}
			
		}

	});
	
}
/*End - Filtro REATIVO*/

function sair_item_arquivos(){
	
	document.querySelector('.item-arquivos').classList.remove("on");
	
}
</script>