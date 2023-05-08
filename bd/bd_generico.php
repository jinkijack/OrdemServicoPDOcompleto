<?php 

require_once("conecta_bd.php");

function checaLogin($tabela,$email,$senha){
    $conexao = conecta_bd();
    $senhaMD5 = md5($senha);
    $query = $conexao->prepare("SELECT * 
              FROM 	$tabela
              WHERE email= ? and 
                senha= ? ");

    $query->bindParam(1,$email);
    $query->bindParam(2,$senhaMD5);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}

function consultaStatusClienteTercerizado($tabela,$cod_usuario,$status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total
                FROM $tabela
                WHERE cod_cliente = ? AND status = ?");

    $query->bindParam(1,$cod_usuario);
    $query->bindParam(2,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);

    return $total;
}

function listaDados($tabela){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                ORDER BY nome");

    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);

    return $lista;
}

function buscaDadoseditarPerfil($tabela,$codigo){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                WHERE cod = ?");

    $query->bindParam(1,$codigo);
    $query->execute();
    $lista = $query->fetch(PDO::FETCH_ASSOC);

    return $lista;
}

function editardados($codigo,$tabela,$dados){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                WHERE codigo = ?");

    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if (count($retorno) > 0) {

        $campos = implode(' = ?, ', array_keys($dados)) . ' = ?';
        $sql = "UPDATE $tabela SET " . $campos . " WHERE codigo = " . $codigo;

        $stmt = $conexao->prepare($sql);
        $cont = 1;

        foreach ($dados as $valor) {
            $stmt->bindParam($cont,$valor);
            $cont++;
        }
    }

    $stmt->bindParam($cont, $codigo);
    $stmt->execute();

}

function editarSenha($tabela,$codigo,$senha){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM $tabela WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE $tabela SET senha = ? WHERE cod = ?");
        $query->bindParam(1, $senha);
        $query->bindParam(2, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }      
    }

}

function consultaEmail($tabela,$email){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM $tabela
                WHERE email = ?");

    $query->bindParam(1,$email);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if ($retorno) {
        return 1;
    }else{
        return 0;
    }   
}

function removeDados($tabela,$codigo){
    $conexao = conecta_bd();

    $query = $conexao->prepare("DELETE FROM $tabela
                WHERE cod = ?");

    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->execute();
    if ($retorno) {
        return 1;
    }else{
        return 0;
    }   
}

function editarInfo($tabela,$codigo,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM $tabela WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE $tabela SET status = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $status);
        $query->bindParam(2, $data);
        $query->bindParam(3, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }      
    }
}
?>