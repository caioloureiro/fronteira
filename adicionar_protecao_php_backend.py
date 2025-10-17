#!/usr/bin/env python3
"""
Script para adicionar proteção PHP no backend (controller/criar.php).
Procura por padrão comum de INSERT e adiciona verificação de duplicata.
"""

import os
import re
from pathlib import Path

def adicionar_protecao_php(arquivo):
    """Adiciona verificação de duplicata no controller."""
    try:
        with open(arquivo, 'r', encoding='utf-8', errors='ignore') as f:
            conteudo = f.read()
        
        # Verificar se já tem proteção
        if 'PROTEÇÃO:' in conteudo and 'duplicata' in conteudo.lower():
            return False, "Já possui proteção"
        
        if 'Evitar duplicata' in conteudo or 'evitar submit' in conteudo.lower():
            return False, "Já possui proteção"
        
        # Procurar INSERT INTO para identificar tabela
        match_insert = re.search(r'\$sql\s*=\s*["\']INSERT\s+INTO\s+(\w+)', conteudo, re.IGNORECASE)
        if not match_insert:
            return False, "Não encontrou INSERT"
        
        nome_tabela = match_insert.group(1)
        
        # Procurar por multi_query ou query antes do INSERT
        linhas = conteudo.split('\n')
        
        # Encontrar linha do INSERT
        linha_insert = -1
        for i, linha in enumerate(linhas):
            if 'INSERT INTO' in linha and nome_tabela in linha:
                linha_insert = i
                break
        
        if linha_insert == -1:
            return False, "Não encontrou posição INSERT"
        
        # Procurar por campo único antes do INSERT (nos últimos 30 linhas)
        campo_chave = None
        var_chave = None
        
        for i in range(max(0, linha_insert - 30), linha_insert):
            linha = linhas[i]
            
            # Procurar por: $variavel = renomear() ou slug
            if 'renomear(' in linha or 'slug' in linha.lower():
                match_var = re.search(r'\$(\w+)\s*=', linha)
                if match_var:
                    var_chave = match_var.group(1)
                    campo_chave = var_chave
                    break
            
            # Procurar por título ou nome
            if '$titulo' in linha and '=' in linha and '$_POST' in linha:
                var_chave = 'titulo'
                campo_chave = 'titulo'
            elif '$nome' in linha and '=' in linha and '$_POST' in linha:
                var_chave = 'nome'
                campo_chave = 'nome'
        
        if not campo_chave:
            return False, "Não encontrou campo chave"
        
        # Criar código de proteção
        protecao = f'''
// PROTEÇÃO: Verificar se já existe (evitar duplicatas por submit múltiplo)
$check_duplicate = $conn->query("SELECT id FROM {nome_tabela} WHERE {campo_chave} = '". $conn->real_escape_string(${var_chave}) ."' LIMIT 1");
if ($check_duplicate && $check_duplicate->num_rows > 0) {{
    $row_dup = $check_duplicate->fetch_assoc();
    echo '<script>alert("Este registro já foi criado (ID: '. $row_dup['id'] .'). Evite clicar múltiplas vezes no botão Gravar."); window.history.back();</script>';
    exit;
}}
'''
        
        # Inserir proteção algumas linhas antes do $sql = "INSERT
        linhas.insert(linha_insert, protecao)
        
        # Salvar
        novo_conteudo = '\n'.join(linhas)
        with open(arquivo, 'w', encoding='utf-8', newline='\n') as f:
            f.write(novo_conteudo)
        
        return True, f"✓ Proteção PHP ({nome_tabela}.{campo_chave})"
        
    except Exception as e:
        return False, f"Erro: {str(e)}"

def main():
    base_dir = Path(r'd:\Sites\fronteira\admin\modulos')
    
    # Buscar todos os controller/criar.php
    arquivos = list(base_dir.glob('*/controller/criar.php'))
    
    print(f"Encontrados {len(arquivos)} arquivos criar.php\n")
    
    sucesso_count = 0
    ja_tem_count = 0
    erro_count = 0
    
    resultados = []
    
    for arquivo in sorted(arquivos):
        modulo = arquivo.parts[-3]
        
        sucesso, msg = adicionar_protecao_php(arquivo)
        
        resultados.append({
            'modulo': modulo,
            'sucesso': sucesso,
            'mensagem': msg
        })
        
        if sucesso:
            sucesso_count += 1
        elif 'Já possui' in msg:
            ja_tem_count += 1
        else:
            erro_count += 1
    
    # Exibir resultados organizados
    print("MÓDULOS COM PROTEÇÃO ADICIONADA:")
    print("="*70)
    for r in resultados:
        if r['sucesso']:
            print(f"  ✓ {r['modulo']:30s} - {r['mensagem']}")
    
    print(f"\n\nMÓDULOS QUE JÁ POSSUÍAM PROTEÇÃO:")
    print("="*70)
    for r in resultados:
        if 'Já possui' in r['mensagem']:
            print(f"  ○ {r['modulo']:30s}")
    
    print(f"\n\nMÓDULOS NÃO PROCESSADOS:")
    print("="*70)
    for r in resultados:
        if not r['sucesso'] and 'Já possui' not in r['mensagem']:
            print(f"  ✗ {r['modulo']:30s} - {r['mensagem']}")
    
    print(f"\n{'='*70}")
    print(f"RESUMO:")
    print(f"  ✓ Proteção adicionada: {sucesso_count}")
    print(f"  ○ Já possuía proteção: {ja_tem_count}")
    print(f"  ✗ Não processados: {erro_count}")
    print(f"  Total: {len(arquivos)}")
    print(f"{'='*70}")

if __name__ == '__main__':
    main()
