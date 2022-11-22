<!DOCTYPE html>
<?php
$acao = isset($_GET["acao"])?$_GET["acao"]:"";
$id = isset($_GET["id"])?$_GET["id"]:"";

if ($acao == "editar"){
    try{
        include_once "config.php";
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

        $query = "SELECT * FROM contato WHERE idcontato = :id";

        $stmt = $conexao->prepare($query);

        $stmt->bindValue(':id',$id);

        $stmt->execute();
        $usuario = $stmt->fetch();


    }catch(PDOExeptio $e){
        print("Erro ao conectar com o banco de dados . . . <bre>".$e->getMenssage());
        die();
    }

}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
</head>
<body>

    <!--Salvar cada informação em um banco de dados-->
    
    <h1 class="display-4">Cadastro</h1>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cadastrar.php">Cadastros</a>
        </li>
    </ul>

    <br>
    
    <div class="col-sm-3">
        <form method="post" enctype="multipart/form-data" name="myForm" action="acaobd.php">
            <fieldset>
                <div class="form-floating mb-3">
                    <input type="text" readonly name="id" id="id"  value=<?php if(isset($usuario)) echo $usuario["idcontato"]; else echo 0;?>>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="nome" value=<?php if(isset($usuario)) echo $usuario["nome"]?>>
                    <label for="nome">Nome</label>
                </div>
                    <br>
                <div class="form-floating mb-3">
                    <input type="email" id="floatingEmail" name="email" class="form-control" value=<?php if(isset($usuario)) echo $usuario["email"]?>>
                    <label for="floatingEmail">Email</label>
                </div>
                    <br>
                <div class="form-floating">
                    <input type="number" id="idade" name="idade" class="form-control" value=<?php if(isset($usuario)) echo $usuario["idade"]?>>
                    <label for="idade">Idade:</label>
                </div>
                    <br>
                <div class="form-floating">
                    <input type="date" id="nascimento" name="nascimento" class="form-control" value=<?php if(isset($usuario)) echo $usuario["dataN"]?>>
                    <label for="nascimento">Data de Nascimento:</label>
                </div>
                    <br>
                <div>
                    <label for="parente">Parentesco:</label>
                    <input type="radio" id="parente1" class="form-check-input" name="parente" value="1" <?php if((isset($usuario)) && $usuario["parente"]=='1') echo 'checked'; ?> required> Sim
                    <input type="radio" id="parente2" class="form-check-input" name="parente" value="2" <?php if((isset($usuario)) && $usuario["parente"]=='2') echo 'checked'; ?> required> Não
                </div>
                    <br>
                <div class="form-floating">
                    <select class="form-select" name="local" id="local">
                    <option value=""></option>
                    <option value="1" <?php if((isset($usuario)) and $usuario["localC"]=='1') echo 'selected'; ?>>Escola</option>
                    <option value="2" <?php if((isset($usuario)) and $usuario["localC"]=='2') echo 'selected'; ?>>Trabalho</option>
                    <option value="3" <?php if((isset($usuario)) and $usuario["localC"]=='3') echo 'selected'; ?>>Outro</option>
                    </select>
                    <label for="select">Origem do Contato:</label>
                </div>
                    <br>
                <div class="form-floating">
                    <input type="text" id="cidade" name="cidade" class="form-control" placeholder="cidade" value=<?php if(isset($usuario)) echo $usuario["cidade"]?>>
                    <label for="cidade">Cidade</label>
                </div>
                    <br>
                <div class="form-floating"> 
                    <input type="text" id="passatempo" name="passatempo" class="form-control" placeholder="passatempto" value=<?php if(isset($usuario)) echo $usuario["passatempo"]?>>
                    <label for="passatempo">Passatempo</label>
                </div>
                    <br>
                <input type="submit" value="Salvar" name="acao">
                <input type="reset" value="Limpar">
            </fieldset>
        </form>
    </div>
</body>
</html>