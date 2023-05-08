
<?php
session_start();
 
//Caso o usu�rio n�o esteja autenticado, limpa os dados e redireciona
if ( !isset($_SESSION['email']) and !isset($_SESSION['perfil']) and !isset($_SESSION['status'])) {
    //Limpa sess�o
    unset ($_SESSION['email']);
    unset ($_SESSION['perfil']);
	unset ($_SESSION['status']);
	
	//Destr�i sess�o
    session_destroy();
 
    //Redireciona para a p�gina de autentica��o
    header ("Location:../index.php");
	die();
}


?>