<?php 

function conecta_bd(){

    try {
        $conexao = new PDO("mysql:host=localhost;dbname=ordemservico","root","");
    } catch (PDOException $e) {
        echo "Erro ao conectar com o MySql: " . $e->getMessage();
        exit();
    }

    return $conexao;
}

?>