<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

if (isset($_POST['btnSalvar'])) {
$nome = $_POST['nome'];
$tel = $_POST['telefone'];
$end = $_POST['endereco'];

$objdao = new EmpresaDAO();

$ret = $objdao->CadastrarEmpresa($nome, $tel, $end);
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
                        <?php include_once '_msg.php' ?>
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você poderá cadastrar todos os nomes das suas empresas </h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="nova_empresa.php">
                    <div class="form-group">
                        <label>Nome da empresa</label>
                        <input class="form-control" placeholder="Digite o nome da empresa." name="nome" id="nomeempresa" />
                    </div>
                    <div class="form-group">
                        <label>Telefone/Whatsapp</label>
                        <input class="form-control" placeholder="Digite Telefone/Whatsapp da sua empresa ( Opcional )" name="telefone" />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Digite o endereço da empresa ( Opcional )" name="endereco" />
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarEmpresa()">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>