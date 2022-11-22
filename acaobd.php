<?php

include_once "config.php";

$nome = isset($_POST["nome"])?$_POST["nome"]:"";
$email = isset($_POST["email"])?$_POST["email"]:"";
$idade = isset($_POST["idade"])?$_POST["idade"]:"";
$dataN = isset($_POST["nascimento"])?$_POST["nascimento"]:"";
$parente = isset($_POST["parente"])?$_POST["parente"]:"";
$localC = isset($_POST["local"])?$_POST["local"]:"";
$passatempo = isset($_POST["passatempo"])?$_POST["passatempo"]:"";
$cidade = isset($_POST["cidade"])?$_POST["cidade"]:"";
$id = isset($_POST["id"])?$_POST["id"]:0;

$acao = isset($_GET["acao"])?$_GET["acao"]:"";

if ($acao == "excluir"){
    try{
        $id = isset($_GET["idcontato"])?$_GET["idcontato"]:0;

        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
        $query = "DELETE FROM contato WHERE idcontato = :id";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(":id",$id);

        if($stmt->execute()){
            header("location: index.php");
        }else{
            echo "Erro";
        }

    }catch(PDOExeptio $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
        die();
    }
}else{

if($nome != "" && $email != "" && $idade != ""){
    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

        if($id > 0){
            $query = "UPDATE contato SET nome = :nome, email = :email, idade = :idade , dataN = :dataN, parente = :parente, localC = :localC, cidade = :cidade, passatempo = :passatempo WHERE idcontato = :id";
        }else{
            $query = "INSERT INTO contato (nome, email, idade, dataN, parente, localC, cidade, passatempo) VALUES(:nome, :email, :idade, :dataN, :parente, :localC, :cidade, :passatempo)";
        }

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(":nome",$nome);
        $stmt->bindValue(":email",$email);
        $stmt->bindValue(":idade",$idade);
        $stmt->bindValue(":dataN",$dataN);
        $stmt->bindValue(":parente",$parente);
        $stmt->bindValue(":localC",$localC);
        $stmt->bindValue(":cidade",$cidade);
        $stmt->bindValue(":passatempo",$passatempo);
        if($id > 0){
            $stmt->bindValue(":id",$id);
        }

        if ($stmt->execute()){
            header("location: index.php");
        }

    }catch(PDOExeptio $e){
        print("Erro ao conectar com o banco de dados . . . <br>".$e->getMenssage());
        die();
    }
}

}
?>