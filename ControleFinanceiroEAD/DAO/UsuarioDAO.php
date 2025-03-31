<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao
{


    public function ValidarLogin($email, $senha)
    {
        if ($email == '' || $senha == '') {
            return 0;
        } else if (strlen($senha) < 6 || strlen($senha) > 8) {
            return -2;
        } else {
            // return 1;

            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT id_usuario, nome_usuario FROM tb_usuario WHERE email_usuario = ? AND senha_usuario = ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $email);
            $sql->bindValue(2, $senha);

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $user = $sql->fetchAll();

            if (count($user) == 0) {
                return -6;
            } else {
                $cod = $user[0]['id_usuario'];
                $nome = $user[0]['nome_usuario'];

                UtilDAO::CriarSessao($cod, $nome);

                header('Location: tela_inicial.php');
                exit;
            }
        }
        //continuar o código dessa função.
        //retornar 1, retornar valor -1.
    }

    public function CadrastarUsuario($nome, $email, $senha, $repsenha)
    {
        if ($nome == '' || $email == '' || $senha == '' || $repsenha == '') {
            return 0;
        } else if (strlen($senha) < 6 || strlen($senha) > 8) {
            return -2;
        } else if ($senha != $repsenha) {
            return -3;
        } else {
            // return 1;
             
            if($this->ValidarEmailDuplicadoCadastro($email) != 0){
                return -5;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'INSERT INTO tb_usuario(nome_usuario, email_usuario, senha_usuario, data_cadastro) VALUES(?, ?, ?, ?);';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $i = 1;

            $sql->bindValue($i++, $nome);
            $sql->bindValue($i++, $email);
            $sql->bindValue($i++, $senha);
            $sql->bindValue($i++, date('Y-m-d'));

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }
    public function CarregarMeusDados()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'SELECT nome_usuario, email_usuario, senha_usuario FROM tb_usuario WHERE id_usuario = ?;';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        // Essa linha de comando, realiza uma consulta de Modo PDO, retornando em um Array tudo que foi encontrado!
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        // Retorna o Array montado pelo PDO com todos os dados da consulta encontrado!
        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email, $senha)
    {
        if ($nome == '' || $email == '' || $senha == '') {
            return 0;
        } else if (strlen($senha) < 6 || strlen($senha) > 8){
            return -2;
        }else{
        if($this->ValidarEmailDuplicadoAlterar($email) != 0){
                return -5;
            }
            $conexao = parent::retornarConexao();

            $comando_sql = 'UPDATE tb_usuario SET nome_usuario = ?, email_usuario = ?, senha_usuario = ? WHERE id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $email);
            $sql->bindValue(3, $senha);
            $sql->bindValue(4, UtilDAO::UsuarioLogado());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ValidarEmailDuplicadoCadastro($email)
    {

        if ($email == '') {
            return 0;
        } else {

            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT COUNT(email_usuario) AS contar FROM tb_usuario WHERE email_usuario = ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $email);

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $contar = $sql->fetchAll();

            return $contar[0]['contar'];
        }
    }

    public function ValidarEmailDuplicadoAlterar($email){
        if ($email == '') {
            return 0;
        } else {

            $conexao = parent::retornarConexao();

            $comando_sql = 'SELECT COUNT(email_usuario) AS contar FROM tb_usuario WHERE email_usuario = ? AND id_usuario != ?;';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $email);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $contar = $sql->fetchAll();

            return $contar[0]['contar'];
        }
    }
}
