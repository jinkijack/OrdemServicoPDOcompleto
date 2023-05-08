<?php
session_start();
require_once ("../bd/bd_generico.php");

if ((empty($_POST['email'])) OR (empty($_POST['senha'])) OR (empty($_POST['perfil']))){
    header("Location: ../index.php"); 
}
else{

	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$perfil = $_POST["perfil"];

	if ($perfil == 1) {
		$tabela= "usuario";
		$dados = checaLogin($tabela,$email,$senha);
	}elseif($perfil == 2){
		$tabela= "cliente";
		$dados = checaLogin($tabela,$email,$senha);
	}else{
		$tabela= "terceirizado";
		$dados = checaLogin($tabela,$email,$senha);
	}

	if($dados == "") {
		$_SESSION['texto_erro_login'] = 'Email, Senha ou Perfil Inválido!';
	    header("Location:../index.php");
	}
	elseif($dados['status'] != 1){
		$_SESSION['texto_erro_login'] = 'Acesso bloqueado ao sistema!';
	    header("Location:../index.php");	
	}
	else {
	    // Salva os dados encontrados na sessão
	    $_SESSION['cod_usu'] = $dados['cod'];
		$_SESSION['nome_usu'] = $dados['nome'];
		$_SESSION['perfil'] = $dados['perfil'];
		$_SESSION['status'] = $dados['status'];
	    header("Location:../home/home.php");
	}
	die();
}


?>