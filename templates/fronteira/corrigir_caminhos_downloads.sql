-- ============================================
-- CORREÇÃO DE CAMINHOS DOS ARQUIVOS
-- Atualizar downloads que estão em uploads/pagina/arquivos/
-- para apenas pagina/arquivos/
-- Data: 13/10/2025
-- ============================================

-- ============================================
-- BACKUP ANTES DE ATUALIZAR (RECOMENDADO)
-- ============================================
-- Execute este comando primeiro para fazer backup:
-- CREATE TABLE downloads_backup AS SELECT * FROM downloads;

-- ============================================
-- ATUALIZAÇÃO DOS CAMINHOS
-- ============================================

-- Remover 'uploads/' do início do caminho dos arquivos
-- que estão em 'uploads/pagina/arquivos/'
UPDATE downloads 
SET arquivo = REPLACE(arquivo, 'uploads/pagina/arquivos/', 'pagina/arquivos/')
WHERE arquivo LIKE 'uploads/pagina/arquivos/%'
AND ativo = 1;

-- ============================================
-- VERIFICAÇÃO DOS RESULTADOS
-- ============================================

-- Ver quantos registros foram afetados
SELECT 
    COUNT(*) as total_arquivos_corrigidos
FROM downloads 
WHERE arquivo LIKE 'pagina/arquivos/%'
AND ativo = 1;

-- Ver lista de arquivos corrigidos
SELECT 
    id,
    nome,
    arquivo,
    categorias
FROM downloads 
WHERE arquivo LIKE 'pagina/arquivos/%'
AND ativo = 1
ORDER BY id DESC;

-- ============================================
-- SE PRECISAR REVERTER (usar backup)
-- ============================================
-- DELETE FROM downloads WHERE id IN (SELECT id FROM downloads_backup);
-- INSERT INTO downloads SELECT * FROM downloads_backup;
-- DROP TABLE downloads_backup;

-- ============================================
-- OUTRAS CORREÇÕES POSSÍVEIS
-- ============================================

-- Se houver arquivos com outros padrões errados:

-- Remover 'uploads/' duplicado
-- UPDATE downloads 
-- SET arquivo = REPLACE(arquivo, 'uploads/uploads/', 'uploads/')
-- WHERE arquivo LIKE 'uploads/uploads/%';

-- Remover apenas 'uploads/' do início
-- UPDATE downloads 
-- SET arquivo = SUBSTRING(arquivo, 9)
-- WHERE arquivo LIKE 'uploads/%'
-- AND arquivo NOT LIKE 'uploads/uploads/%';

-- ============================================
-- VERIFICAR ARQUIVOS COM PROBLEMAS
-- ============================================

-- Ver todos os arquivos que começam com 'uploads/'
SELECT 
    id,
    nome,
    arquivo,
    CASE 
        WHEN arquivo LIKE 'uploads/%' THEN 'Tem uploads/ no início'
        ELSE 'Caminho OK'
    END as status
FROM downloads 
WHERE ativo = 1
ORDER BY 
    CASE 
        WHEN arquivo LIKE 'uploads/%' THEN 0
        ELSE 1
    END,
    id DESC;

-- ============================================
-- CORREÇÃO PARA CATEGORIAS CONTÁBEIS
-- ============================================

-- Atualizar especificamente os downloads das categorias contábeis
-- que foram inseridos recentemente
UPDATE downloads 
SET arquivo = REPLACE(arquivo, 'uploads/pagina/arquivos/', 'pagina/arquivos/')
WHERE (
    categorias LIKE '%Contábil%'
    OR categorias LIKE '%Balanços%'
    OR categorias LIKE '%RREO%'
    OR categorias LIKE '%RGF%'
    OR categorias LIKE '%Instrumentos de Planejamento%'
    OR categorias LIKE '%Repasse ao Legislativo%'
    OR categorias LIKE '%Balancetes%'
    OR categorias LIKE '%Demonstrativos Fiscais%'
    OR categorias LIKE '%Prestação de Contas%'
)
AND arquivo LIKE 'uploads/pagina/arquivos/%'
AND ativo = 1;

-- ============================================
-- INSTRUÇÕES DE USO
-- ============================================

/*
COMO EXECUTAR ESTA CORREÇÃO:

1. FAZER BACKUP (IMPORTANTE):
   CREATE TABLE downloads_backup AS SELECT * FROM downloads;

2. EXECUTAR A ATUALIZAÇÃO PRINCIPAL:
   A query UPDATE principal já corrige o caminho

3. VERIFICAR SE FUNCIONOU:
   - Execute a query de verificação
   - Confira se os caminhos estão corretos
   - Teste acessar alguns downloads pelo site

4. SE DEU ERRADO (Reverter):
   DELETE FROM downloads WHERE id IN (SELECT id FROM downloads_backup);
   INSERT INTO downloads SELECT * FROM downloads_backup;
   DROP TABLE downloads_backup;

5. ENTENDENDO O PROBLEMA:
   - Sistema adiciona 'uploads/' automaticamente
   - Arquivos salvos como: 'uploads/pagina/arquivos/arquivo.pdf'
   - Resultado: site busca em 'uploads/uploads/pagina/arquivos/arquivo.pdf' ❌
   - Correção: salvar apenas como 'pagina/arquivos/arquivo.pdf' ✅
   - Sistema vai buscar em: 'uploads/pagina/arquivos/arquivo.pdf' ✅

6. PADRÕES CORRETOS:
   ✅ 'arquivo.pdf' → 'uploads/arquivo.pdf'
   ✅ 'pasta/arquivo.pdf' → 'uploads/pasta/arquivo.pdf'
   ✅ 'pagina/arquivos/arquivo.pdf' → 'uploads/pagina/arquivos/arquivo.pdf'
   ❌ 'uploads/arquivo.pdf' → 'uploads/uploads/arquivo.pdf' (ERRADO)

7. TESTAR APÓS CORREÇÃO:
   - Acesse: /downloads?categoria=contabil
   - Clique em alguns documentos
   - Verifique se o download funciona
*/

-- ============================================
-- QUERIES DE DIAGNÓSTICO
-- ============================================

-- Ver estatísticas dos caminhos
SELECT 
    CASE 
        WHEN arquivo LIKE 'uploads/%' THEN 'Começa com uploads/'
        WHEN arquivo LIKE '%/%' THEN 'Tem pasta'
        ELSE 'Apenas nome do arquivo'
    END as tipo_caminho,
    COUNT(*) as quantidade
FROM downloads 
WHERE ativo = 1
GROUP BY tipo_caminho;

-- Ver exemplos de cada tipo de caminho
(SELECT 'COM UPLOADS' as tipo, arquivo FROM downloads WHERE arquivo LIKE 'uploads/%' AND ativo = 1 LIMIT 5)
UNION ALL
(SELECT 'COM PASTA' as tipo, arquivo FROM downloads WHERE arquivo LIKE '%/%' AND arquivo NOT LIKE 'uploads/%' AND ativo = 1 LIMIT 5)
UNION ALL
(SELECT 'SÓ ARQUIVO' as tipo, arquivo FROM downloads WHERE arquivo NOT LIKE '%/%' AND ativo = 1 LIMIT 5);

-- ============================================
-- FIM DO SCRIPT DE CORREÇÃO
-- ============================================
