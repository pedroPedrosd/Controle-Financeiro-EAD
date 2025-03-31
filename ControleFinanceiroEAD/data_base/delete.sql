-- Excluir de Dados (Delete).

-- Exclusão de TODO o Banco de Dados.
DROP DATABASE db_exemplo;

-- Exclusão de TABELA do Banco de Dados.
DROP TABLE tb_exemplo;

DELETE FROM tb_usuario WHERE id_usuario = 4;

DELETE FROM tb_categoria WHERE id_categoria = 1;

DELETE FROM tb_movimento WHERE id_movimento = 2;

DELETE FROM tb_movimento WHERE id_movimento IN (1, 6, 7, 12);
