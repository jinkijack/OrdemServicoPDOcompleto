<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../bd/bd_generico.php");

	$codigo = $_GET['cod'];
	$tabela = "ordem";
	$dados = removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados da ordem se serviço não foram excluidos do sistema!';
		header ("Location:ordem.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados da ordem se serviço foram excluidos do sistema.';
		header ("Location:ordem.php");
	}

?>