<?php
      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
        UtilDAO::VerificarLogado();
      // =======================================  
      
require_once '../DAO/ContaDAO.php';

if (isset($_POST['gravar'])) {
    $banco = trim($_POST['banco']);
    $agencia = trim($_POST['agen']);
    $number = trim($_POST['num']);
    $saldo = trim($_POST['saldo']); 

    $objDAO = new ContaDAO();

    $ret = $objDAO->CadrastarConta($banco, $agencia, $number, $saldo);
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Nova Conta.</h2>
                        <h5>Aqui você poderá cadrastar todas as suas Contas.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="post">
                <div class="form-goup">
                    <label>Nome do Banco*</label>
                    <input class="form-control" placeholder="Digite o nome do Banco."  name="banco" id="banco" value="<?= isset($banco) ? $banco : null ?>">
                </div>
                <div class="form-goup">
                    <label>Agência*</label>
                    <input class="form-control" placeholder="Digite a Agência.*"  name="agen" id="agen" value="<?= isset($agencia) ? $agencia : null ?>">
                </div>
                <div class="form-goup">
                    <label>Número da Conta*</label>
                    <input type="number" class="form-control" placeholder="Digite o Número da conta.*" name="num" id="num" value="<?= isset($number) ? $number : null ?>">
                </div>
                <div class="form-goup">
                    <label>Saldo*</label>
                    <input type="number" class="form-control" placeholder="Digite o Saldo."  name="saldo" id="saldo" value="<?= isset($saldo) ? $saldo : null ?>">
                </div>
                <button type="submit" class="btn btn-success" name="gravar" onclick="return ValidarConta()">Gravar</button>
                </form>

            </div>
</body>

</html>