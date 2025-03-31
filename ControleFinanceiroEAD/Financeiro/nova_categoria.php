<?php

      // ========== SESSÃO DO USUÁRIO ==========

      require_once '../DAO/UtilDAO.php';
        UtilDAO::VerificarLogado();
      // =======================================  
      
require_once '../DAO/CategoriaDAO.php';


if(isset($_POST['gravar'])){
    $nome = trim($_POST['nome']);

    $objDAO = new CategoriaDAO();

    $ret = $objDAO->CadrastarCategoria($nome);
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
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadrastar todas as suas categorias.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-goup">
                    <label>Nome da categoria</label>
                    <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: conta de luz." name="nome" id="nomeCategoria" value="<?= isset($nome) ? $nome : null ?>">
                </div>

                <button type="submit" class="btn btn-success" onclick="return ValidarCategoria()" name="gravar">Gravar</button>
                </form>
                
            </div>
</body>

</html>