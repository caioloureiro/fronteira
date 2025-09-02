<!-- Start - view/acessibilidade.php !-->
<style><?php require 'css/acessibilidade.css'; ?></style>

<div class="acessibilidade">
	
	<div class="acessibilidade-itens">
		
		<!-- 
		<div class="acessibilidade-btn"><span class="material-symbols-outlined">Extension</span></div>
		<div class="acessibilidade-btn"><span class="material-symbols-outlined">branding_watermark</span></div>
		!-->
		
		<div 
			class="acessibilidade-btn accessibilidade_reset"
			onclick="resetFonte()"
			title="Reiniciar tamanho do texto"
		><span class="material-symbols-outlined">restart_alt</span></div>
		
		<div 
			class="acessibilidade-btn"
			onclick="aumentarFonte()"
			title="Aumentar tamanho do texto"
		><span class="material-symbols-outlined">Add</span></div>
		
		<div 
			class="acessibilidade-btn"
			onclick="diminuirFonte()"
			title="Diminuir tamanho do texto"
		><span class="material-symbols-outlined">Remove</span></div>
		
		<div 
			class="acessibilidade-btn"
			onclick="modoEscuro()"
			title="Modo Escuro"
		><span class="material-symbols-outlined">Contrast</span></div>
		
		<div 
			class="acessibilidade-btn"
			title="Mapa do portal"
		><a href="mapa"><span class="material-symbols-outlined">Schema</span></a></div>
		
		<div 
			class="acessibilidade-btn"
			title="Página de Acessibilidade"
		><a href="acessibilidade"><span class="material-symbols-outlined">Accessible</span></a></div>
		
		<form action="pesquisa" method="POST">
			<input 
				type="text" 
				class="acessibilidade-input" 
				name="busca" 
				required 
				placeholder="O que você procura?"
			/>
			<button class="acessibilidade-button" type="submit"><span class="material-symbols-outlined">Search</span></button>
		</form>
		
	</div>
	
</div>

<script>

function modoEscuro(){
	
	let body = document.querySelector('body');
	body.classList.toggle("modo_escuro");
	
}

const fontResize = [
	//'body',
	'.conteudo-html p',
	'.noticia-descricao',
	'.secretarias-txt',
];

//console.log( 'fontResize', fontResize );

function aumentarFonte(){
	
	//console.log( 'aumentarFonte' ); 
	
	document.querySelector('.accessibilidade_reset').classList.add('on');
	
	fontResize.forEach( alvo => {
		
		//console.log( 'alvo', alvo ); 
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo == '.conteudo-html p' 
				|| alvo == '.secretarias-txt' 
			)
		){
			
			let el = document.querySelectorAll( alvo );
			
			//console.log( 'el', el ); 
			
			for( var el_i in el ) {
				
				//console.log( el[el_i] );
				
				let fonSizeFull = window.getComputedStyle( el[el_i], null ).getPropertyValue("font-size");
				let fonSizeStr = fonSizeFull.replace('px', '');
				let letFonSize = parseFloat( fonSizeStr );
				
				let lineHeightFull = window.getComputedStyle( el[el_i], null ).getPropertyValue("line-height");
				let lineHeightStr = lineHeightFull.replace('px', '');
				let letLineHeight = parseFloat( lineHeightStr );
				
				let FonSizeResult = 'font-size:'+ ( letFonSize + 5 ) +'px; line-height:'+ ( letLineHeight + 5 ) +'px;';
				
				el[el_i].setAttribute('style', FonSizeResult);
				
			}
			
		}
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo != '.conteudo-html p' 
				|| alvo != '.secretarias-txt' 
			)
		){
			
			let el = document.querySelector( alvo );
			
			if( el ){
			
				let fonSizeFull = window.getComputedStyle( el, null ).getPropertyValue("font-size");
				let fonSizeStr = fonSizeFull.replace('px', '');
				let letFonSize = parseFloat( fonSizeStr );
				
				let lineHeightFull = window.getComputedStyle( el, null ).getPropertyValue("line-height");
				let lineHeightStr = lineHeightFull.replace('px', '');
				let letLineHeight = parseFloat( lineHeightStr );
				
				let FonSizeResult = 'font-size:'+ ( letFonSize + 5 ) +'px; line-height:'+ ( letLineHeight + 5 ) +'px;';
				
				el.setAttribute('style', FonSizeResult);
				
			}
			
		}
		
	});
	
}

function diminuirFonte(){
	
	//console.log( 'diminuirFonte' ); 
	
	document.querySelector('.accessibilidade_reset').classList.add('on');
	
	fontResize.forEach( alvo => {
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo == '.conteudo-html p' 
				|| alvo == '.secretarias-txt' 
			)
		){
			
			let el = document.querySelectorAll( alvo );
			
			//console.log( 'el', el ); 
			
			for( var el_i in el ) {
				
				//console.log( el[el_i] );
				
				let fonSizeFull = window.getComputedStyle( el[el_i], null ).getPropertyValue("font-size");
				let fonSizeStr = fonSizeFull.replace('px', '');
				let letFonSize = parseFloat( fonSizeStr );
				
				let lineHeightFull = window.getComputedStyle( el[el_i], null ).getPropertyValue("line-height");
				let lineHeightStr = lineHeightFull.replace('px', '');
				let letLineHeight = parseFloat( lineHeightStr );
				
				let FonSizeResult = 'font-size:'+ ( letFonSize - 5 ) +'px; line-height:'+ ( letLineHeight - 5 ) +'px;';
				
				el[el_i].setAttribute('style', FonSizeResult);
				
			}
			
		}
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo != '.conteudo-html p' 
				|| alvo != '.secretarias-txt' 
			)
		){
			
			let el = document.querySelector( alvo );
			
			if( el ){
			
				let fonSizeFull = window.getComputedStyle( el, null ).getPropertyValue("font-size");
				let fonSizeStr = fonSizeFull.replace('px', '');
				let letFonSize = parseFloat( fonSizeStr );
				
				let lineHeightFull = window.getComputedStyle( el, null ).getPropertyValue("line-height");
				let lineHeightStr = lineHeightFull.replace('px', '');
				let letLineHeight = parseFloat( lineHeightStr );
				
				let FonSizeResult = 'font-size:'+ ( letFonSize - 5 ) +'px; line-height:'+ ( letLineHeight - 5 ) +'px;';
				
				el.setAttribute('style', FonSizeResult);
				
			}
			
		}
		
	});
	
}

function resetFonte(){
	
	//console.log( 'resetFonte' ); 
	
	document.querySelector('.accessibilidade_reset').classList.remove('on');
	
	fontResize.forEach( alvo => {
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo == '.conteudo-html p' 
				|| alvo == '.secretarias-txt' 
			)
		){
			
			let el = document.querySelectorAll( alvo );
			
			//console.log( 'el', el ); 
			
			for( var el_i in el ) {
				
				//console.log( el[el_i] );
		
				if( el[el_i] ){ el[el_i].removeAttribute('style'); }
				
			}
			
		}
		
		if( 
			document.querySelector( alvo )
			&& (
				alvo != '.conteudo-html p' 
				|| alvo != '.secretarias-txt' 
			)
		){
			
			let el = document.querySelector( alvo );
			
			if( el ){
			
				let el = document.querySelector( alvo );
		
				if( el ){ el.removeAttribute('style'); }
				
			}
			
		}
		
	})
	
}

</script>
<!-- End - view/acessibilidade.php !-->