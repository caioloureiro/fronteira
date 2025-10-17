#!/usr/bin/env python3
"""
Script para adicionar proteção contra submit múltiplo em todos os módulos.
Adiciona tanto proteção JavaScript no formulário quanto verificação PHP no controller.
"""

import os
import re
from pathlib import Path

def adicionar_protecao_javascript(arquivo_view):
    """Adiciona proteção JavaScript no arquivo de view (novo.php ou novo-02.php)."""
    try:
        with open(arquivo_view, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se já tem a proteção
        if 'PROTEÇÃO CONTRA SUBMIT MÚLTIPLO' in conteudo:
            return False, "Já possui proteção JavaScript"
        
        # Procurar pelo fechamento do script antes de </body>
        # Padrão: </script>\s*</body>
        padrao = r'(\s*)(</script>)(\s*)(</body>)'
        
        if not re.search(padrao, conteudo):
            return False, "Não encontrou padrão </script></body>"
        
        # JavaScript de proteção
        protecao_js = '''
		/*Start - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		const form = document.querySelector('form');
		const submitButton = document.querySelector('button[type="submit"]');
		
		if (form && submitButton) {
			let formularioEnviado = false;
			
			form.addEventListener('submit', function(e) {
				if (formularioEnviado) {
					e.preventDefault();
					alert('O formulário já está sendo processado. Por favor, aguarde.');
					return false;
				}
				
				formularioEnviado = true;
				submitButton.disabled = true;
				submitButton.textContent = 'Gravando...';
				submitButton.style.opacity = '0.6';
				submitButton.style.cursor = 'not-allowed';
			});
		}
		/*End - PROTEÇÃO CONTRA SUBMIT MÚLTIPLO*/
		'''
        
        # Inserir antes de </script>
        novo_conteudo = re.sub(
            padrao,
            r'\1' + protecao_js + r'\2\3\4',
            conteudo
        )
        
        # Salvar arquivo
        with open(arquivo_view, 'w', encoding='utf-8', newline='\n') as f:
            f.write(novo_conteudo)
        
        return True, "JavaScript adicionado"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def adicionar_protecao_php(arquivo_controller):
    """Adiciona verificação de duplicata no controller (criar.php)."""
    try:
        with open(arquivo_controller, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se já tem a proteção
        if 'PROTEÇÃO: Verificar se' in conteudo or 'Evitar duplicatas' in conteudo:
            return False, "Já possui proteção PHP"
        
        # Procurar por padrão comum: geração do nome/slug antes do INSERT
        # Padrões possíveis:
        # 1. $nome = renomear($titulo);
        # 2. $slug = ...
        # 3. Antes de $sql = "INSERT INTO
        
        linhas = conteudo.split('\n')
        linha_insert = -1
        linha_renomear = -1
        nome_tabela = ""
        campo_nome = ""
        campo_titulo = ""
        
        # Identificar tabela e campos
        for i, linha in enumerate(linhas):
            # Procurar INSERT INTO
            if 'INSERT INTO' in linha and linha_insert == -1:
                match = re.search(r'INSERT INTO\s+(\w+)', linha)
                if match:
                    nome_tabela = match.group(1)
                    linha_insert = i
            
            # Procurar renomear() ou similar
            if 'renomear(' in linha and linha_renomear == -1:
                # Ex: $pagina = renomear($titulo);
                match = re.search(r'\$(\w+)\s*=\s*renomear', linha)
                if match:
                    campo_nome = match.group(1)
                    linha_renomear = i
        
        if linha_renomear == -1 or not nome_tabela:
            return False, "Não encontrou padrão de criação"
        
        # Identificar campo título
        for i in range(max(0, linha_renomear - 20), linha_renomear):
            if '$titulo' in linhas[i] and '=' in linhas[i] and '$_POST' in linhas[i]:
                campo_titulo = 'titulo'
                break
            elif '$nome' in linhas[i] and '=' in linhas[i] and '$_POST' in linhas[i]:
                campo_titulo = 'nome'
                break
        
        if not campo_titulo:
            campo_titulo = 'titulo'  # Assumir título como padrão
        
        # Código PHP de proteção
        protecao_php = f'''
// PROTEÇÃO: Verificar se já existe (evitar duplicatas por submit múltiplo)
$check_sql = "SELECT id FROM {nome_tabela} WHERE {campo_nome} = '". $conn->real_escape_string(${campo_nome}) ."'";
if (!empty(${campo_titulo})) {{
    $check_sql .= " AND {campo_titulo} = '". $conn->real_escape_string(${campo_titulo}) ."'";
}}
$check_sql .= " LIMIT 1";
$check_result = $conn->query($check_sql);

if ($check_result && $check_result->num_rows > 0) {{
    $row_existente = $check_result->fetch_assoc();
    echo'
    <script>
        alert("Este registro já foi criado recentemente (ID: '. $row_existente['id'] .'). Evite clicar múltiplas vezes no botão Gravar.");
        window.location.href = "../view/?m={nome_tabela}";
    </script>
    ';
    exit;
}}
'''
        
        # Inserir após a linha de renomear
        linhas.insert(linha_renomear + 1, protecao_php)
        
        # Salvar arquivo
        novo_conteudo = '\n'.join(linhas)
        with open(arquivo_controller, 'w', encoding='utf-8', newline='\n') as f:
            f.write(novo_conteudo)
        
        return True, f"PHP adicionado (tabela: {nome_tabela})"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def main():
    """Função principal."""
    base_dir = Path(r'd:\Sites\fronteira\admin\modulos')
    
    # Ler lista de arquivos corrigidos anteriormente
    lista_arquivo = Path(r'd:\Sites\fronteira\arquivos_corrigir_conexao.txt')
    
    if not lista_arquivo.exists():
        print("Arquivo arquivos_corrigir_conexao.txt não encontrado!")
        return
    
    with open(lista_arquivo, 'r', encoding='utf-8') as f:
        arquivos_corrigidos = [linha.strip() for linha in f if linha.strip()]
    
    # Extrair módulos únicos
    modulos = set()
    for arquivo in arquivos_corrigidos:
        parts = Path(arquivo).parts
        if 'modulos' in parts:
            idx = parts.index('modulos')
            if idx + 1 < len(parts):
                modulos.add(parts[idx + 1])
    
    print(f"Total de módulos a processar: {len(modulos)}\n")
    
    resultados_js = []
    resultados_php = []
    
    for i, modulo in enumerate(sorted(modulos), 1):
        print(f"[{i}/{len(modulos)}] Processando módulo: {modulo}")
        
        modulo_path = base_dir / modulo
        
        # Procurar arquivo de view (novo.php ou novo-02.php)
        arquivo_view = None
        for nome_view in ['novo-02.php', 'novo.php', 'criar.html']:
            view_path = modulo_path / 'view' / nome_view
            if view_path.exists():
                arquivo_view = view_path
                break
        
        # Procurar arquivo controller (criar.php)
        arquivo_controller = modulo_path / 'controller' / 'criar.php'
        
        # Adicionar proteção JavaScript
        if arquivo_view and arquivo_view.exists():
            sucesso, msg = adicionar_protecao_javascript(arquivo_view)
            resultados_js.append({
                'modulo': modulo,
                'arquivo': arquivo_view.name,
                'sucesso': sucesso,
                'mensagem': msg
            })
            if sucesso:
                print(f"  ✓ JavaScript: {msg}")
            else:
                print(f"  ○ JavaScript: {msg}")
        else:
            print(f"  ✗ Arquivo view não encontrado")
        
        # Adicionar proteção PHP
        if arquivo_controller.exists():
            sucesso, msg = adicionar_protecao_php(arquivo_controller)
            resultados_php.append({
                'modulo': modulo,
                'sucesso': sucesso,
                'mensagem': msg
            })
            if sucesso:
                print(f"  ✓ PHP: {msg}")
            else:
                print(f"  ○ PHP: {msg}")
        else:
            print(f"  ✗ Arquivo criar.php não encontrado")
        
        print()
    
    # Resumo
    print(f"\n{'='*80}")
    print(f"RESUMO DA APLICAÇÃO DE PROTEÇÕES")
    print('='*80)
    
    js_sucesso = sum(1 for r in resultados_js if r['sucesso'])
    js_ja_tem = sum(1 for r in resultados_js if 'Já possui' in r['mensagem'])
    
    php_sucesso = sum(1 for r in resultados_php if r['sucesso'])
    php_ja_tem = sum(1 for r in resultados_php if 'Já possui' in r['mensagem'])
    
    print(f"\nProteção JavaScript:")
    print(f"  ✓ Adicionada: {js_sucesso}")
    print(f"  ○ Já possuía: {js_ja_tem}")
    print(f"  ✗ Não processado: {len(resultados_js) - js_sucesso - js_ja_tem}")
    
    print(f"\nProteção PHP:")
    print(f"  ✓ Adicionada: {php_sucesso}")
    print(f"  ○ Já possuía: {php_ja_tem}")
    print(f"  ✗ Não processado: {len(resultados_php) - php_sucesso - php_ja_tem}")
    
    print(f"\n{'='*80}")
    print("Aplicação de proteções concluída!")

if __name__ == '__main__':
    main()
