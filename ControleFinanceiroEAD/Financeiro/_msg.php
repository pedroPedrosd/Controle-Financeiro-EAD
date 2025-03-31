<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}

if (isset($ret)) {
    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">Preencher todos os campos obrigatórios!</div>';
            break;

        case 1:
            echo '<div class="alert alert-success">Ação Realizada com sucesso!</div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">Ocorreu um erro. Tente novamente mais tarde!</div>';
            break;
        case -2:
            echo '<div class="alert alert-warning">A SENHA deve conter entre 6 a 8 caracteres!</div>';
            break;
        case -3:
            echo '<div class="alert alert-warning">As senhas devem ser iguais!</div>';
            break;

        case -4:
            echo '<div class="alert alert-warning">Este item não pode ser Excluído, pois está em uso!</div>';
            break;
        case -5:
            echo '<div class="alert alert-warning">Já existe um CADASTRO com esse E-mail!</div>';
            break;
        case -6:
            echo '<div class="alert alert-warning">Cadastro inexistente, nenhum USUÁRIO foi encontrado!</div>';
            break;
    }
}
