<?php

// ========== SESSÃO DO USUÁRIO ==========
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
// =======================================

require_once '../DAO/MovimentoDAO.php';

$objDAO = new MovimentoDAO();

$totalEntrada = $objDAO->TotaldeEntrada();
$totalSaida = $objDAO->TotaldeSaida();
$movs = $objDAO->UltimosDezMovimentos();
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
                        <h2>Sistema de Controle Financeiro.</h2>
                        <h5>Seja Bem Vindo <strong><?= UtilDAO::NomeLogado(); ?></strong>, esse é seu Sistema de Controle Financeiro (Fluxo de Caixa), para acessar os Módulos, utilize o MENU lateral.</h5>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?= number_format($totalEntrada[0]['Total'], 2, ',', '.'); ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <span>Total de Entrada:</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>R$ <?= number_format($totalSaida[0]['Total'], 2, ',', '.'); ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                <span>Total de Saída:</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>Essas são as movimentações financeiras realizadas:</span>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Qtd</th>
                                        <th>Tipo do Movimento</th>
                                        <th>Data</th>
                                        <th>Valor (R$)</th>
                                        <th>Categoria</th>
                                        <th>Empresa</th>
                                        <th>Conta Bancária</th>
                                        <th>Observação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // essa varial vai ser somada com o valor que for direcionado pelo consultar movimento
                                    $total = 0;

                                    for ($i = 0; $i < count($movs); $i++) {
                                        if ($movs[$i]['tipo_movimento'] == 1) {
                                            $total = $total + $movs[$i]['valor_movimento'];
                                        } else {
                                            $total = $total - $movs[$i]['valor_movimento'];
                                        }
                                    ?>

                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $movs[$i]['tipo_movimento'] == 1 ? '<strong style="color: #006400;">ENTRADA</strong>' : '<strong style="color: #ff0000;">SAÍDA</strong>' ?></td>
                                            <td><?= $movs[$i]['data_movimento'] ?></td>
                                            <td><?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                            <td><?= $movs[$i]['nome_categoria'] ?></td>
                                            <td><?= $movs[$i]['nome_empresa'] ?></td>
                                            <td>Banco: <?= $movs[$i]['banco_conta'] ?> | Agência: <?= $movs[$i]['agencia_conta'] ?> | Saldo: R$ <?= number_format($movs[$i]['saldo_conta'], 2, ',', '.') ?></td>
                                            <td><?= $movs[$i]['obs_movimento'] ?></td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                            <div style="text-align: center;">
                                <strong>Total:</strong>
                                <span style="color: <?= $total <= 0 ? '#ff0000' : '#006400' ?>;">
                                    <strong>
                                        R$ <?= number_format($total, 2, ',', '.') ?>
                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>