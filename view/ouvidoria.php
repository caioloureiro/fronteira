<!-- Start - view/ouvidoria.php !-->
<style>
	<?php 
		require 'css/ouvidoria.css'; 
		require 'css/formularios.css'; 
	?>
	
	/* Estilos para o botão de alternância de modo */
	.ouvidoria-modo-toggle {
		width: 100%;
		height: auto;
		float: left;
		margin-bottom: 1.5vw;
		padding: 1vw;
		background: linear-gradient(135deg, var(--padrao01) 0%, var(--padrao05) 100%);
		border-radius: 0.5vw;
		box-shadow: 0 0.2vw 0.8vw var(--preto_lente02);
	}
	
	.ouvidoria-modo-titulo {
		width: 100%;
		float: left;
		color: white;
		font-size: 1vw;
		font-weight: 700;
		margin-bottom: 0.8vw;
		text-align: center;
	}
	
	.ouvidoria-modo-botoes {
		width: 100%;
		float: left;
		display: flex;
		gap: 1vw;
	}
	
	.ouvidoria-modo-btn {
		flex: 1;
		padding: 0.8vw 1.5vw;
		border: 0.15vw solid var(--branco_lente03);
		border-radius: 0.4vw;
		background: var(--branco_lente01);
		color: white;
		font-size: 0.9vw;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s ease;
		text-align: center;
		backdrop-filter: blur(10px);
	}
	
	.ouvidoria-modo-btn:hover {
		background: var(--branco_lente02);
		border-color: var(--branco_lente05);
		transform: translateY(-0.1vw);
	}
	
	.ouvidoria-modo-btn.ativo {
		background: white;
		color: var(--padrao01);
		border-color: white;
		box-shadow: 0 0.2vw 0.6vw var(--preto_lente02);
	}
	
	.ouvidoria-modo-btn .icone {
		font-size: 1.2vw;
		margin-right: 0.3vw;
	}
	
	.ouvidoria-formulario-container {
		width: 100%;
		float: left;
	}
	
	.formulario-wrapper {
		display: none;
	}
	
	.formulario-wrapper.ativo {
		display: block;
	}
	
	@media (max-width: 768px) {
		.ouvidoria-modo-titulo {
			font-size: 3vw;
		}
		.ouvidoria-modo-btn {
			font-size: 2.5vw;
			padding: 2vw 3vw;
		}
		.ouvidoria-modo-btn .icone {
			font-size: 3vw;
		}
	}
</style>

<section class="ouvidoria">
	
	<div class="box">
		
		<?= $pagina['texto'] ?>
		
		<div class="ouvidoria-itens">
			
			<div class="col40">
			
				<?php require 'view/acesso-protocolo.php'; ?>
				
			</div>
			<div class="col60">
			
				<!-- Botão de Alternância de Modo -->
				<div class="ouvidoria-modo-toggle">
					<div class="ouvidoria-modo-titulo">Escolha o tipo de solicitação:</div>
					<div class="ouvidoria-modo-botoes">
						<div class="ouvidoria-modo-btn ativo" id="btn-modo-identificado" onclick="alternarModo('identificado')">
							<span class="icone">👤</span> Solicitação Identificada
						</div>
						<div class="ouvidoria-modo-btn" id="btn-modo-anonimo" onclick="alternarModo('anonimo')">
							<span class="icone">🔒</span> Denúncia Anônima
						</div>
					</div>
				</div>
				
				<!-- Container dos Formulários -->
				<div class="ouvidoria-formulario-container">
					
					<!-- Formulário Identificado -->
					<div class="formulario-wrapper ativo" id="formulario-identificado">
						<?php require 'view/formulario-ouvidoria.php'; ?>
					</div>
					
					<!-- Formulário Anônimo -->
					<div class="formulario-wrapper" id="formulario-anonimo">
						<?php require 'view/formulario-ouvidoria-anonimo.php'; ?>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</section>

<script>
// Função para alternar entre os modos de formulário
function alternarModo(modo) {
	const btnIdentificado = document.getElementById('btn-modo-identificado');
	const btnAnonimo = document.getElementById('btn-modo-anonimo');
	const formIdentificado = document.getElementById('formulario-identificado');
	const formAnonimo = document.getElementById('formulario-anonimo');
	
	if (modo === 'identificado') {
		// Ativar modo identificado
		btnIdentificado.classList.add('ativo');
		btnAnonimo.classList.remove('ativo');
		formIdentificado.classList.add('ativo');
		formAnonimo.classList.remove('ativo');
	} else if (modo === 'anonimo') {
		// Ativar modo anônimo
		btnAnonimo.classList.add('ativo');
		btnIdentificado.classList.remove('ativo');
		formAnonimo.classList.add('ativo');
		formIdentificado.classList.remove('ativo');
	}
	
	// Scroll suave até o formulário
	const container = document.querySelector('.ouvidoria-formulario-container');
	if (container) {
		container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	}
}

// Salvar preferência no sessionStorage
document.addEventListener('DOMContentLoaded', function() {
	const modoSalvo = sessionStorage.getItem('ouvidoriaModo');
	if (modoSalvo) {
		alternarModo(modoSalvo);
	}
	
	// Salvar quando trocar de modo
	document.getElementById('btn-modo-identificado').addEventListener('click', function() {
		sessionStorage.setItem('ouvidoriaModo', 'identificado');
	});
	
	document.getElementById('btn-modo-anonimo').addEventListener('click', function() {
		sessionStorage.setItem('ouvidoriaModo', 'anonimo');
	});
});
</script>

<!-- End - view/ouvidoria.php !-->