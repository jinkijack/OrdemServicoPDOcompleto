
<?php
require_once('../valida_session/valida_session.php');
require_once('../layout/header.php'); 
require_once('../layout/sidebar.php'); 
require_once ("../bd/bd_ordem.php");
require_once ("../bd/bd_cliente.php");
require_once ("../bd/bd_terceirizado.php");

$dados = buscaOrdemadd();

$nome_cliente = $dados['nome_cliente'];
$nome_terceirizado = $dados['nome_terceirizada'];
$nome_servico = $dados['nome_servico'];
$valor_servico = $dados['valor_servico'];
$data_servico = $dados['data_servico'];
$status = $dados['status'];
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
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ORDEM DE SERVIÇO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <?php
            if (isset($_SESSION['texto_sucesso'])):
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['texto_sucesso']);
            endif;
            ?>

                <form class="user" action="cad_ordem_envia.php" method="post" >
                    
                        <div class="form-group">
                            <label> Nome do Cliente </label>
                            <input type="text" class="form-control form-control-user" id="nome_cliente" name="nome_cliente" value="<?= $nome_cliente ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label> Serviço </label>
                            <input type="text" class="form-control form-control-user" id="nome_servico" name="nome_servico" value="<?= $nome_servico ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label> Valor do Serviço </label>
                            <input type="text" class="form-control form-control-user"
                            id="valor_servico" name="valor_servico" value="<?= $valor_servico?>" readonly>
                        </div> 

                        <div class="form-group">
                            <label> Terceirizado </label>
                            <input type="text" class="form-control form-control-user" id="nome_terceirizado" name="nome_terceirizado" value="<?= $nome_servico ?>" readonly>
                        </div>

                         <div class="form-group">
                            <label> Data do Serviço </label>
                            <input type="text" class="form-control form-control-user" id="data_servico" name="data_servico" value="<?= date('d/m/Y',strtotime($data_servico)) ?>" readonly>
                        </div>                          

                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="ordem.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
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


