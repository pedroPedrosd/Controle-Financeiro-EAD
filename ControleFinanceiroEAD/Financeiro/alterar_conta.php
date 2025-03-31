<?php

      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
        UtilDAO::VerificarLogado();
      // =======================================  
    require_once '../DAO/ContaDAO.php';

    $objDAO = new ContaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idConta = $_GET['cod'];

        $dados = $objDAO->DetalharConta($idConta);

        if(count($dados) == 0){ 
            header('location: consultar_conta.php');
            exit;
        }
    }else if(isset($_POST['btnSalvar'])){
        $banco = trim($_POST['banco']);
        $agencia = trim($_POST['agencia']);
        $numero = trim($_POST['numero']);
        $saldo = trim($_POST['saldo']);
        $idConta = $_POST['cod'];

        $ret = $objDAO->AlterarConta($banco, $agencia, $numero, $saldo, $idConta);

        header('location: consultar_conta.php?ret=' . $ret);
        exit;
    }else if(isset($_POST['btnExcluir'])){

        $idConta = $_POST['cod'];
        $ret = $objDAO->ExcluirConta($idConta);

        header('location: consultar_conta.php?ret=' . $ret);
        exit;
       
    }else{
        header('location: consultar_conta.php');
        exit;
    }
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
                        <h2>Alterar Conta.</h2>
                        <h5>Aqui você poderá Alterar suas Contas.</h5>

                        <?php include_once '_msg.php'; ?>

                    </div>
                </div> 
                <!-- /. ROW  -->
                <form action="alterar_conta.php" method="post">
                <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                <div class="form-group">
                        <label>Digite o Nome do Banco:</label>
                        <input class="form-control" placeholder="Digite o Nome do Banco aqui..." name="banco" id="banco" value="<?= $dados[0]['banco_conta'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Digite a Agência:</label>
                        <input type="number" class="form-control" placeholder="Digite a Agência aqui..." name="agencia" id="agen" value="<?= $dados[0]['agencia_conta'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Digite o Número da Conta:</label>
                        <input type="number" class="form-control" placeholder="Digite o Número da Conta aqui..." name="numero" id="num" value="<?= $dados[0]['numero_conta'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Digite o Saldo (R$):</label>
                        <input class="form-control" placeholder="Digite o Saldo da Conta aqui..." name="saldo" id="saldo" value="<?= $dados[0]['saldo_conta'] ?>">
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarConta();">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Você realmente deseja excluir sua Conta Bancária?</h4>
                                </div>
                                <div class="modal-body">
                            <span>Nome do Banco: </span><strong><?= $dados[0]['banco_conta'] ?></strong>
                            <br>
                            <span>Nome da Agência: </span><strong><?= $dados[0]['agencia_conta'] ?></strong>
                            <br>
                            <span>Número da conta: </span><strong><?= $dados[0]['numero_conta'] ?></strong>
                            <br>
                            <span>Saldo da Conta: </span><strong>R$ <?= number_format($dados[0]['saldo_conta'], 2, ',', '.') ?></strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                                </div>
                </form>
                
            </div>
</body>

</html>