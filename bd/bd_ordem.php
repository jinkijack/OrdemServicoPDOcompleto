<?php 

require_once("conecta_bd.php");

function consultaStatusUsuario($status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total
                FROM ordem WHERE status = ?");

    $query->bindParam(1,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);

    return $total;
}

function listaOrdem(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                    ordem o,servico s, cliente c, 
                                    terceirizado t
                                where 
                                    o.cod_cliente = c.cod AND
                                    o.cod_servico = s.cod AND
                                    o.cod_terceirizado = t.cod");

    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaOrdemAberta($orderby){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                    ordem o,servico s, cliente c, 
                                    terceirizado t
                                where
                                    o.status = ? AND 
                                    o.cod_cliente = c.cod AND
                                    o.cod_servico = s.cod AND
                                    o.cod_terceirizado = t.cod");

    $query->bindParam(1,$orderby);
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}


function cadastraOrdem($cod_cliente,$cod_servico,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO ordem(cod_cliente,cod_servico,cod_terceirizado,
            data_servico,status,data) VALUES (?,?,?,?,?,?)");

    $query->bindParam(1,$cod_cliente);
    $query->bindParam(2,$cod_servico);
    $query->bindParam(3,$cod_terceirizado);
    $query->bindParam(4,$data_servico);
    $query->bindParam(5,$status);
    $query->bindParam(6,$data);

    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}


function buscaOrdemadd (){
    $conexao = conecta_bd();

    $query = $conexao->prepare("Select 
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    s.valor AS valor_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                From 
                                    ordem o,servico s, cliente c,
                                        terceirizado t 
                                Where 
                                    o.cod_cliente = c.cod AND 
                                    o.cod_servico = s.cod AND 
                                    o.cod_terceirizado = t.cod
                                ORDER BY o.cod DESC LIMIT 1");
    $query->execute();
    $lista = $query->fetch(PDO::FETCH_ASSOC);
    return $lista;
}

function buscaOrdemeditar($codigo){
    $conexao = conecta_bd();

    $query = $conexao->prepare("Select 
			  o.cod AS cod,
			  c.nome AS nome_cliente,
			  t.nome AS nome_terceirizada,
			  s.nome AS nome_servico,
			  o.data_servico AS data_servico,
			  o.status AS status,
			  t.cod AS cod_terceirizado
			  From ordem o,servico s, cliente c, terceirizado t 
			  Where o.cod_cliente = c.cod AND 
			        o.cod_servico = s.cod AND 
			        o.cod_terceirizado = t.cod AND
			        o.cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    return $retorno;
}

function editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * 
              FROM ordem
              WHERE cod= ?");
    $query->bindParam(1,$codigo);
    $resultado = $query->execute();
    $dados = $query->rowCount();

    if($dados == 1){
      $query = $conexao->prepare("UPDATE  ordem
                SET cod_terceirizado = ?, data_servico = ?, status = ?, data = ?
                WHERE cod = ?");
       $query->bindParam(1,$cod_terceirizado);
       $query->bindParam(2,$data_servico);
       $query->bindParam(3,$status);
       $query->bindParam(4,$data);
       $query->bindParam(5,$codigo);
       $resultado = $query->execute();
       $dados = $query->rowCount();
       return $dados;
    }else{
        return 0;
    }



}


// function editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data){
//     $conexao = conecta_db();
//     $query = "SELECT * 
//               FROM ordem
//               WHERE cod='$codigo'";
  
//     $resultado = mysqli_query($conexao,$query);
//     $dados = mysqli_num_rows($resultado);
  
//     if($dados == 1){
//       $query = "UPDATE  ordem
//                 SET cod_terceirizado = '$cod_terceirizado', data_servico = '$data_servico', status = '$status', data = '$data'
//                 WHERE cod = '$codigo'";
//        $resultado = mysqli_query($conexao,$query);
//        $dados = mysqli_affected_rows($conexao);
//        return $dados;
//     }
//   }

// function editarInfo($tabela,$codigo,$status,$data){
//     $conexao = conecta_bd();

//     $query = $conexao->prepare("SELECT * FROM $tabela WHERE cod = ?");
//     $query->bindParam(1,$codigo);
//     $query->execute();
//     $retorno = $query->fetch(PDO::FETCH_ASSOC);

//     if(count($retorno) > 0){
//         $query = $conexao->prepare("UPDATE $tabela SET status = ?, data = ? WHERE cod = ?");
//         $query->bindParam(1, $status);
//         $query->bindParam(2, $data);
//         $query->bindParam(3, $codigo);
//         $retorno = $query->execute();//retorno boolean padrao TRUE
//         if($retorno){
//             return 1;
//         } else{
//             return 0;
//         }      
//     }
// }

?>