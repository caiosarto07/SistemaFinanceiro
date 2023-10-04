<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

if(isset($_POST['btnSalvar'])){
$banco = $_POST['banco'];
$numero = $_POST['numero'];
$agencia = $_POST['agencia'];
$saldo = $_POST['saldo'];

$objdao = new ContaDAO();
$ret = $objdao->CadastrarConta($banco, $agencia, $numero, $saldo);
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php';
?>

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
                        <?php  include_once '_msg.php' ?>
                        <h2>Nova Conta</h2>
                        <h5>Aqui você poderá cadastrar todas as suas contas bancárias</h5>

                    </div>
                </div>
                <hr />
                <form method="post" action="nova_conta.php">
                    <div class="form-group">
                        <label>Nome do Banco</label>
                        <input class="form-control" placeholder="Digite o nome do Banco." name="banco" id="banco" />
                    </div>
                    <div class="form-group">
                        <label>Agência</label>
                        <input class="form-control" placeholder="Digite Agência." name="agencia" id="agencia" />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta</label>
                        <input class="form-control" placeholder="Digite o número da Conta." name="numero" id="numero" />
                    </div>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" placeholder="Digite o Saldo da Conta." name="saldo" id="saldo" />
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarConta()">Salvar</button>
                </form>
            </div>
        </div>
    </div>



</body>

</html>