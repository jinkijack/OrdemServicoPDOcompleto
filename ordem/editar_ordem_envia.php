<?php
require_once("../valida_session/valida_session.php");
require_once ("../bd/bd_ordem.php");
	     
$codigo = $_POST["cod"];
$cod_terceirizado = $_POST["cod_terceirizado"];
$data_servico = $_POST["data_servico"];
$status = $_POST["status"];
$data=date("y/m/d");

$dados = editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data);
if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados da ordem de serviço foram alterados no sistema.';
	header ("Location:ordem.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados da ordem de serviço não foram alterados no sistema!';
	header ("Location:ordem.php");
}

		
?>