<?php 

require_once("conecta_bd.php");
function editarPerfilTerceirizado($codigo,$nome,$email,$telefone,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM terceirizado WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE terceirizado SET nome = ?, email = ?, telefone = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $email);
        $query->bindParam(3, $telefone);
        $query->bindParam(4, $data);
        $query->bindParam(5, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }        
    }

}

function cadastraTerceirizado($nome,$email,$telefone,$senha,$status,$perfil,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO terceirizado(nome,email,telefone,senha,
        status,perfil,data) VALUES (?,?,?,?,?,?)");

    $query->bindParam(1,$nome);
    $query->bindParam(2,$email);
    $query->bindParam(3,$telefone);
    $query->bindParam(4,$senha);
    $query->bindParam(5,$status);
    $query->bindParam(6,$perfil);
    $query->bindParam(7,$data);
    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}
?>