<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../bd/bd_generico.php");

	$codigo = $_GET['cod'];

	if($codigo == $_SESSION['cod_usu']){
		$_SESSION['texto_erro'] = 'Os dados do usuário não foram excluidos do sistema,pois está logado!';
		header ("Location:usuario.php");
	}
	else{
		$tabela = "usuario";
		$dados = removeDados($tabela,$codigo);

		if($dados == 0){
			$_SESSION['texto_erro'] = 'Os dados do usuário não foram excluidos do sistema!';
			header ("Location:usuario.php");
		}else{
			$_SESSION['texto_sucesso'] = 'Os dados do usuário foram excluidos do sistema.';
			header ("Location:usuario.php");
		}
	}
?>