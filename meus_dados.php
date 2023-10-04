<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO();
$nome = '';
$email = '';

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $ret = $objDAO->GravarMeusDados($nome, $email);
}

$usuario = $objDAO->CarregarMeusDados();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php'
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php'
        ?>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php'; ?>

                        <h2>Meus Dados</h2>
                        <h5>Nesta página, você poderá alterar seus dados</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="meus_dados.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite seu nome" name="nome" id="nome" value="<?= $usuario[0]['nome_usuario'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email" id="email" value="<?= $usuario[0]['email_usuario'] ?>" />
                    </div>
                    <button onclick="return ValidarMeusDados()" class="btn btn-success" name="btnSalvar">Salvar</button>
                </form>
            </div>

</body>

</html>