<?php

    require_once '../DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/CategoriaDAO.php';
    require_once '../DAO/EmpresaDAO.php';
    require_once '../DAO/ContaDAO.php';
    require_once '../DAO/MovimentoDAO.php';

    $objCategoria = new CategoriaDAO();
    $objEmpresa = new EmpresaDAO();
    $objConta = new ContaDAO();

    $tipo = '';
    $categoria = '';
    $empresa = '';
    $conta = '';

    if(isset($_POST['btnGravar'])){
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $valor = $_POST['valor'];
        $obs = $_POST['obs'];
        $categoria = $_POST['categoriaMov'];
        $empresa = $_POST['empresaMov'];
        $conta = $_POST['contaMov'];

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        $objdao = new MovimentoDAO();
        $ret = $objdao->RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta);
    }

    $categorias = $objCategoria->ConsultarCategoria();
    $empresas = $objEmpresa->ConsultarEmpresa();
    $contas = $objConta->ConsultarConta();

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
                        <h2>Realizar Movimentos</h2>
                        <h5>Aqui você poderá realizar movimentos de entrada e saída </h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="realizar_movimento.php">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de Movimento</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data</label>
                            <input type="date" class="form-control" name="data" id="data" value="<?= isset($data) ? $data : '' ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input class="form-control" placeholder="Digite o valor do Movimento" id="valor" name="valor" value="<?= isset($valor) ? $valor : '' ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" name="categoriaMov" id="categoriaMov">
                                <option value="">Selecione</option>
                                <?php foreach($categorias as $item){ ?>
                                    <option value="<?= $item['id_categoria'] ?>" <?= $categoria == 1 ? 'selected' : '' ?>>
                                    <?= $item['nome_categoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa</label>
                            <select class="form-control" name="empresaMov" id="empresaMov">
                                <option value="">Selecione</option>
                                <?php foreach($empresas as $item){ ?>
                                    <option value="<?= $item['id_empresa'] ?>" <?= $empresa == 1 ? 'selected' : '' ?>>
                                        <?= $item['nome_empresa'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta</label>
                            <select class="form-control" name="contaMov" id="contaMov">
                                <option value="">Selecione</option>
                                <?php foreach($contas as $item){ ?>
                                    <option value="<?= $item['id_conta'] ?>" <?= $conta == 1 ? 'selected' : '' ?>>
                                        <?= 'Banco: ' . $item['banco_conta'] . ', Agência: ' . $item['agencia_conta'] . ' / ' . $item['numero_conta'] . ' - Saldo: ' . 'R$ ' . $item['saldo_conta'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Obeservação ( opcional )</label>
                            <textarea class="form-control" rows="3" name="obs" placeholder="Digite uma observação aqui..."></textarea>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" name="btnGravar" class="btn btn-success" onclick="return ValidarMovimento()">Finalizar Lançamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>