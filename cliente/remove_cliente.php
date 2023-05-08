<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../bd/bd_generico.php");

	$codigo = $_GET['cod'];
	$tabela = "cliente";
	$dados = removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados do cliente não foram excluidos do sistema!';
		header ("Location:cliente.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados do cliente foram excluidos do sistema.';
		header ("Location:cliente.php");
	}

?>