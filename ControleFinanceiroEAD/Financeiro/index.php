<?php
require_once "../DAO/UsuarioDAO.php";

if (isset($_POST["btnAcessar"])) {
    $emailUsuario = trim($_POST["emailUsuario"]);
    $senha = trim($_POST["senha"]);

    $objDAO = new UsuarioDAO();
    $ret = $objDAO->ValidarLogin($emailUsuario, $senha);
}
?>

<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "_head.php"; ?>

<body>
<div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br/>
                <br/>
                <h2>Sistema de Controle Financeiro.</h2>
                <h5>(Realize seu Login de acesso aqui).</h5>
                <br/>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Preencha todos os dados:</strong>
                    </div>
                    <?php include_once '_msg.php'; ?>
                    <div class="panel-body">
                        <br/>
                        <form action="index.php" method="POST" role="form">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="email" class="form-control" placeholder="Digite seu E-mail aqui..." name="emailUsuario" id="email" value="<?= isset($emailUsuario) ? $emailUsuario : '' ?>"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <div class="box-senha">
                                    <input type="password" class="form-control border-camp" placeholder="Digite sua Senha aqui..." name="senha" id="senha" value="<?= isset($senha) ? $senha : '' ?>"/>
                                    <img src="./assets/img/img_senha.png" alt="Icone de Ver Senha!" title="Icone de Ver Senha!" id="olho" class="icon-senha">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btnAcessar" onclick="return ValidarLogin();">Acessar</button>
                        </form>
                        <hr/>
                        <span>Não possui uma Conta?</span> <a href="cadastro.php">Clique aqui...</a>
                    </div>
                </div>
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