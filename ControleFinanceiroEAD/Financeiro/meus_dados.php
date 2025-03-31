<?php
      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
           UtilDAO::VerificarLogado();
      // =======================================
      
require_once '../DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO();

if (isset($_POST['btnSalvar'])) { 
    $nomeUsuario = trim($_POST['nomeUsuario']);
    $emailUsuario = trim($_POST['emailUsuario']);
    $senha = trim($_POST['senha']);

    $ret = $objDAO->GravarMeusDados($nomeUsuario, $emailUsuario, $senha);
}

// Variável de Tipo Array pois recebeu o Array Montado no Back-End pelo PDO!
$dados = $objDAO->CarregarMeusDados();

// echo '<pre>';
// var_dump($dados);
// echo '</pre>';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php' ?>

<body>
<div id="wrapper">
        <?php 
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar Dados de Acesso.</h2>
                        <h5>Aqui você pode alterar seus Dados de Acesso.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr/>
                <form action="meus_dados.php" method="POST">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite seu Nome:</label>
                            <input type="text" class="form-control" placeholder="Digite seu Nome aqui..." name="nomeUsuario" id="nomeUsuario" value="<?= $dados[0]['nome_usuario'] ?>"/>
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite seu E-mail:</label>
                            <input type="email" class="form-control" placeholder="Digite seu E-mail aqui..." name="emailUsuario" id="emailUsuario" value="<?= $dados[0]['email_usuario'] ?>"/>
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite sua Senha:</label>
                            <div class="box-senha">
                                <input type="password" class="form-control" placeholder="Digite sua Senha aqui..." name="senha" id="senha" value="<?= $dados[0]['senha_usuario'] ?>"/>
                                <img src="./assets/img/img_senha.png" alt="Icone de Ver Senha!" title="Icone de Ver Senha!" id="olho" class="icon-senha">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" name="btnSalvar" onclick="return ValidarMeusDados();">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Código JS para habilitar a visualização da Senha! -->
    <script>
        // Essa function converte o tipo de dados do input de senha para texto!
        $("#olho").mousedown(function(){
            $("#senha").attr("type", "text");
        });

        // Essa function converte o tipo de dados do input de texto para senha!
        $("#olho").mouseup(function(){
            $("#senha").attr("type", "password");
        });
    </script>
</body>

</html>