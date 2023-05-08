<?php 

require_once("conecta_bd.php");

function cadastraServico($nome,$valor,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO servico(nome,valor,data) VALUES (?,?,?)");

    $query->bindParam(1,$nome);
    $query->bindParam(2,$valor);
    $query->bindParam(3,$data);
    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}

function editarServico($codigo,$nome,$valor,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM servico WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE servico SET nome = ?, valor = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $valor);
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
?>