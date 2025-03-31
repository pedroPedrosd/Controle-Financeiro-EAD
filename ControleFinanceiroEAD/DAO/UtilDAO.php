<?php

class UtilDAO
{

    // Inicia a sessão do usuário para a parte interna da aplicação

    public static function IniciarSessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($cod, $nome)
    {
        self::IniciarSessao();

        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }

    public static function NomeLogado()
    {
        self::IniciarSessao();

        return $_SESSION['nome'];
    }

    // Verifica se o usuário está logado

    public static function UsuarioLogado()
    {
        self::IniciarSessao();

        return $_SESSION['cod'];
    }

    // 5° Passo - Essa função identifica os dados de permissão do usuário e limpa, destroi a sessão.

    public static function Deslogar(){
        self::IniciarSessao();

        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        header('Location: index.php');
        exit;

    }

    // 6° Passo - Essa função monitora se, existe dados de Usuario na sessão, se não existir, redireciona para a página de login.

    public static function VerificarLogado(){
        
        self::IniciarSessao();

        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
            header('Location: index.php');
            exit;
            
        }
    }
}
