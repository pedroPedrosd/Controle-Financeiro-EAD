<?php
    
    require_once '../DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/EmpresaDAO.php';

    $objDAO = new EmpresaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idEmpresa = $_GET['cod'];

        $dados = $objDAO->DetalharEmpresa($idEmpresa);

        if(count($dados) == 0){
            header('location: consultar_empresa.php');
            exit;
        }
    }else if (isset($_POST['btnSalvar'])){
        $nomeEmp = trim($_POST['nomeEmp']);
        $telefone = trim($_POST['telefone']);
        $endereco = trim($_POST['endereco']);
        $idEmpresa = $_POST['cod'];

        $ret = $objDAO->AlterarEmpresa($nomeEmp, $telefone, $endereco, $idEmpresa);

        header('location: consultar_empresa.php?ret='. $ret);
        exit;
    }else if (isset($_POST['btnExcluir'])){
        $idEmpresa = $_POST ['cod'];

        $ret = $objDAO->ExcluirEmpresa($idEmpresa);

        header('location: consultar_empresa.php?ret='. $ret);
        exit;

    }else{
        header('location: consultar_empresa.php');
        exit;
    }
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
                        <h2>Alterar ou Excluir Empresa.</h2>
                        <h5>Aqui você pode alterar ou excluir sua Empresa.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr/>
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0] ['id_empresa'] ?>" >
                    <div class="form-group">
                        <label>Digite o Nome da Empresa:</label>
                        <input class="form-control" placeholder="Digite o Nome da Empresa aqui..." name="nomeEmp" id="nomeEmp" value="<?= $dados[0]['nome_empresa'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Digite o Telefone (WhatsApp):</label>
                        <input type="number" class="form-control" placeholder="Digite o Telefone aqui..." name="telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Digite o Endereço:</label>
                        <input class="form-control" placeholder="Digite o Endereço aqui..." name="endereco" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>"/>
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarEmpresa();">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Excluir</button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Você realmente deseja excluir sua Empresa?</h4>
                                </div>
                                <div class="modal-body">
                                    <span>Nome da Empresa: </span><strong><?= $dados[0] ['nome_empresa'] ?>.</strong>
                                    <br>
                                    <span>Telefone: </span><strong><?= $dados[0] ['telefone_empresa'] ?>.</strong>
                                    <br>
                                    <span>Endereço: </span><strong><?= $dados[0] ['endereco_empresa'] ?>.</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger" name="btnExcluir">Exluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>