<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$status = $_POST["status"];
$perfil = 3;
$data=date("y/m/d");

require_once ("../bd/bd_terceirizado.php");
require_once ("../bd/bd_generico.php");

$tabela = "terceirizado";
$dados = consultaEmail($tabela,$email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	$_SESSION['telefone'] = $telefone;
	header ("Location:cad_terceirizado.php");
}else{

	$dados = cadastraTerceirizado($nome,$email,$telefone,$senha,$status,$perfil,$data);

	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		unset ($_SESSION['telefone']);
		header ("Location:terceirizado.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['telefone'] = $telefone;
		header ("Location:cad_terceirizado.php");
	}
}

?>