<?php 

require_once("conecta_bd.php");

function editarPerfilUsuario($codigo,$nome,$email,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM usuario WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE usuario SET nome = ?, email = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $email);
        $query->bindParam(3, $data);
        $query->bindParam(4, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }        
    }

}

function cadastraUsuario($nome,$senha,$email,$perfil,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO usuario(nome,senha,email,
        perfil,status,data) VALUES (?,?,?,?,?,?)");

    $query->bindParam(1,$nome);
    $query->bindParam(2,$senha);
    $query->bindParam(3,$email);
    $query->bindParam(4,$perfil);
    $query->bindParam(5,$status);
    $query->bindParam(6,$data);
    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}
?>