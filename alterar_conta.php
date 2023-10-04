<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

$objDAO = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];

    $dados = $objDAO->DetalharConta($idConta);

    if (count($dados) == 0) {
        header('location:consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idConta = $_POST['cod'];
    $banco = trim($_POST['banco_conta']);
    $agencia = trim($_POST['agencia_conta']);
    $numero = trim($_POST['numero_conta']);
    $saldo = trim($_POST['saldo_conta']);

    $ret = $objDAO->AlterarConta($banco, $agencia, $numero, $saldo, $idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idConta = $_POST['cod'];

    $ret = $objDAO->ExcluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
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
                        <h2>Alterar Conta</h2>
                        <h5>Aqui você poderá alterar ou excluir suas contas.</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                    <div class="form-group">
                        <label>Nome do Banco</label>
                        <input class="form-control" name="banco_conta" id="bancodaconta" value="<?= $dados[0]['banco_conta']; ?>" placeholder="Digite o nome do Banco..." />
                    </div>
                    <div class="form-group">
                        <label>Agência</label>
                        <input class="form-control" name="agencia_conta" id="agenciadaconta" value="<?= $dados[0]['agencia_conta']; ?>" placeholder="Digite Agência..." />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta</label>
                        <input class="form-control" name="numero_conta" id="numerodaconta" value="<?= $dados[0]['numero_conta']; ?>" placeholder="Digite o número da Conta..." />
                    </div>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" name="saldo_conta" id="saldodaconta" value="<?= $dados[0]['saldo_conta']; ?>" placeholder="Digite o saldo da Conta..." />
                    </div>
                    <button class="btn btn-success" onclick="return ValidarConta()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExccluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExccluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Conta : <?= $dados[0]['banco_conta'] ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" onclick="return ExcluirConta()" class="btn btn-danger" name="btnExcluir">Excluir</button>
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