<!-- Start - admin/modulos/usuarios/wiew/home.php !-->
<div class="conteudo admin_user">
	
	<div class="titulo">Usuários Administradores</div>
	
	<div class="linha-acao">
		<a href="modulos/admin_user/view/novo-02?arquivo=ignorado"><button class="autores-novo-btn">Criar novo Usuário</button></a>
	</div>

	<table class="tabela-uma-coluna">
	
		<thead>
			
			<tr>
			
				<th>Usuário</th>
				<th style="width:10vw">Ação</th>
				
			</tr>
			
		</thead>
		
		<tbody>
		
			<?php
				
				foreach( $admin_user_array as $usuario ){
					
					echo'
					<tr>
						
						<td>
							<div class="item-titulo licitacao-titulo-'.$usuario['id'].'"><span>'. $usuario['nome'].'</span></div>
							<div class="gaveta licitacao-gaveta-'.$usuario['id'].'">
							
								Login: '.$usuario['usuario'].'<br/>
								E-mail: '.$usuario['email'].'<br/>
								Função: '.$usuario['funcao'].'<br/>
								Tipo: '.$usuario['tipo'].'
								
							</div>
						</td>
						<td>
						
							<a href="modulos/admin_user/view/editar?id='. $usuario['id'] .'"><div class="tabela-btn tabela-btn-editar" title="Editar"></div></a>
							<a href="modulos/admin_user/view/excluir?id='. $usuario['id'] .'"><div class="tabela-btn tabela-btn-excluir" title="Excluir"></div></a>
							
						</td>
						
					</tr>
					';
					
				}
			
			?>
			
		</tbody>
	
	</table>
	<div id="paginacao" class="pagination"></div>
	
</div>
<!-- End - admin/modulos/usuarios/wiew/home.php !-->