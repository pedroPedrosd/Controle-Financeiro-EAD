<?php

      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
        UtilDAO::VerificarLogado();
      // =======================================  
      
require_once '../DAO/EmpresaDAo.php';

if (isset($_POST['gravar'])) {
    $nome = trim($_POST['empresa']);
    $tel = trim($_POST['tel']);
    $end = trim($_POST['end']);

    $objDAO = new EmpresaDAO();
    $ret = $objDAO->CadrastarEmpresa($nome, $tel, $end);
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
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você poderá cadrastar todas as suas empresas.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-goup">
                        <label>Nome da empresa*</label>
                        <input class="form-control" placeholder="Digite o nome da empresa."  name="empresa" id="nomeEmp" value="<?= isset($nome) ? $nome : '' ?>">
                    </div>
                    <div class="form-goup">
                        <label>Telefone (WhatsApps)</label>
                        <input class="form-control" placeholder="Digite o telefone da empresa. (opcional)"  name="tel" id="telefone" value="<?= isset($tel) ? $tel : '' ?>">
                    </div>
                    <div class="form-goup">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Digite o endereço da empresa. (opcional)"  name="end" id="endereco" value="<?= isset($end) ? $end : '' ?>">
                    </div>
                    <button type="submit" class="btn btn-success" name="gravar" onclick="return ValidarEmpresa()">Gravar</button>
                </form>

            </div>
</body>

</html>