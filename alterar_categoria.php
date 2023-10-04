<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objDAO = new CategoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idCategoria = $_GET['cod'];

    $dados = $objDAO->DetalharCategoria($idCategoria);

    if (count($dados) == 0) {
        header('location:consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idCategoria = $_POST['cod'];
    $nome = trim($_POST['nomecategoria']);

    $ret = $objDAO->AlterarCategoria($nome, $idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idCategoria = $_POST['cod'];
    $ret = $objDAO->ExcluirCategoria($idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
} else {
    header('location: consultar_categoria.php');
    exit;
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
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você poderá alterar ou excluir suas categorias </h5>

                    </div>
                </div>
                <hr />
                <form get method="post" action="alterar_categoria.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group" id="divCategoria">
                        <label>Nome da categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: Conta de luz" id="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?> " name="nomecategoria" onchange="ValidarCampoCategoriaAlterar()" value=<?= $dados[0]['nome_categoria'] ?> maxlength="35" />
                    </div>
                    <button class="btn btn-success" onclick="return ValidarCategoria()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExccluir" class="btn btn-danger">Excluir</button>
                    <div class="modal fade" id="modalExccluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a categoria : <?= $dados[0]['nome_categoria'] ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" onclick="return ExcluirCategoria()" class="btn btn-danger" name="btnExcluir">Excluir</button>
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