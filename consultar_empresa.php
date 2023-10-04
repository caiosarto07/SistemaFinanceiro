<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();
$empresas = $dao->ConsultarEmpresa();

    // echo '<pre>';
    // var_dump($empresas);
    // echo '</pre>';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
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
                        <?php include_once  '_msg.php'; ?>
                        <h2>Consultar empresas</h2>
                        <h5>Consulte todas suas empresas aqui! </h5>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span>Empresas cadastradas. Caso deseja alterar, clique no botão ALTERAR</span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da empresa</th>
                                                <th>Telefone/Whatsapp</th>
                                                <th>Endereço</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($empresas as $emp):  ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $emp['nome_empresa'] ?></td>
                                                    <td><?= $emp['telefone_empresa'] ?></td>
                                                    <td><?= $emp['endereco_empresa'] ?></td>
                                                    <td><a href="alterar_empresa.php?cod=<?= $emp['id_empresa'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>