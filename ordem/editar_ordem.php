
<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php');
require_once ("../bd/bd_ordem.php");
require_once ("../bd/bd_terceirizado.php");
require_once ("../bd/bd_generico.php");

$codigo = $_GET['cod'];
$dados = buscaOrdemeditar($codigo);

$cod = $dados["cod"];
$nome_cliente = $dados["nome_cliente"];
$nome_terceirizado = $dados["nome_terceirizada"];
$nome_servico = $dados["nome_servico"];
$data_servico = $dados["data_servico"];
$status = $dados["status"];
$cod_terceirizado = $dados["cod_terceirizado"];

$tabela = 'terceirizado';
$dados = listaDados($tabela);

?>

<!-- Main Content -->
<div id="content">

    <?php require_once('../layout/navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DA ORDEM DE SERVIÇO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_ordem_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$cod?>">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Nome do Cliente </label>
                            <input type="text" class="form-control form-control-user" id="nome_cliente" name="nome_cliente" value="<?= $nome_cliente ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label> Serviço </label>
                            <input type="text" class="form-control form-control-user" id="nome_servico" name="nome_servico" value="<?= $nome_servico ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label> Terceirizado </label>
                            <select class="form-control" id="cod_terceirizado" name="cod_terceirizado" required>
                                <option value="<?=$cod_terceirizado?>"><?=$nome_terceirizado?></option> 
                                <?php foreach($terceirizados as $dados):?>
                                <option value="<?=$dados['cod']?>"><?=$dados['nome']?></option> 
                                <?php endforeach ?>
                                </select>
                        </div>
                        <div class="col-sm-6">
                            <label> Data do Serviço </label>
                            <input type="date" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= $data_servico ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                             <div class="col-sm-6">
                                <label> Situação </label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" <?php echo ($status == 1) ? 'selected': ''; ?>>Aberto</option>
                                    <option value="2" <?php echo ($status == 2) ? 'selected': ''; ?>>Executando</option>
                                    <option value="3" <?php echo ($status == 3) ? 'selected': ''; ?>>Concluida</option>
                                </select>
                            </div>                   
                    </div>
                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="ordem.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <a title="Adicionar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button> </a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layout/footer.php');
?>


