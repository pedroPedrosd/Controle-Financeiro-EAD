<?php

      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
        UtilDAO::VerificarLogado();
      // =======================================  
      
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$objCategoria = new CategoriaDAO();
$objEmpresa = new EmpresaDAO();
$objConta = new ContaDAO();

$tipo = '';
$categoria = '';
$empresa = '';
$conta = '';

if(isset($_POST['relMovi'])){
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = trim($_POST['valor']);
    $obs = trim($_POST['msg']);
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];  

    $objDAO = new MovimentoDAO();
    $ret = $objDAO->RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta);
}

$categorias = $objCategoria->ConsultarCategoria();
$empresas = $objEmpresa->ConsultarEmpresa();
$contas = $objConta->ConsultarConta();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php'; ?>
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
                        <h2>Realizar Movimentações Financeiras.</h2>
                        <h5>Aqui você pode realizar todas as suas movimentações financeiras.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr/>
                <form action="realizar_movimento.php" method="POST">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selecione um Tipo de Movimento:</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Data:</label>
                            <input type="date" class="form-control" name="data" id="data" value="<?= isset($data) ? $data : '' ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Digite um Valor (R$):</label>
                            <input class="form-control" placeholder="Digite um Valor (R$) aqui..." name="valor" id="valor" value="<?= isset($valor) ? $valor : '' ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Categoria Financeira:</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach($categorias as $ctg){ ?>
                                <option value="<?= $ctg['id_categoria'] ?>"><?= $ctg ['nome_categoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selecione uma Empresa:</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach($empresas as $emp){ ?>
                                <option value="<?= $emp['id_empresa'] ?>"><?= $emp ['nome_empresa'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Conta Bancária:</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach($contas as $ct){ ?>
                                <option value="<?= $ct ['id_conta'] ?>"><?= $ct ['banco_conta'] ?> | R$ <?= number_format($ct ['saldo_conta'], 2, ',', '.') ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Digite uma Observação (Opcional):</label>
                            <textarea class="form-control" rows="4" placeholder="Digite sua Observação aqui..." name="msg" id="msg"></textarea>
                        </div>
                        <button class="btn btn-success" name="relMovi" onclick="return ValidarMovimento()">Realizar Movimento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>