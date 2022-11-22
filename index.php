<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    
</head>
<body>

    <h1 class="display-4">Lista de Contatos</h1>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cadastrar.php">Cadastros</a>
        </li>
    </ul>
    <br>
    
    <br>
    <div class="table-responsive">
    <form action="" method="get" id='pesquisa'>
            <input type="search" name='busca' id='busca'>
            <button class='btn btn-primary' type="submit" name='pesquisa'>Buscar</button>
    </form>
        <br>
        <table class="table table-striped table-hover">
            <?php
                    include_once "config.php";
                    try{
                        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);

                        $busca = isset($_GET['busca'])?$_GET['busca']:"";
                        $query = "SELECT * FROM contato";
                        
                        if ($busca != ""){
                            $busca = '%'.$busca.'%';
                            $query .= ' WHERE nome like :busca' ;
                        }

                        $stmt = $conexao->prepare($query);

                        if ($busca != ""){
                        $stmt->bindValue(':busca',$busca);
                        }

                        $stmt->execute();
                        $usuarios = $stmt->fetchAll();
                        
                        echo "<tr><th>Id</th><th>Nome</th><th>Email</th><th>Idade</th><th>Editar</th><th>Excluir</th></tr>";
                        foreach($usuarios as $usuario){
                            $editar = "<a href=cadastrar.php?acao=editar&id=".$usuario["idcontato"].">Alt</a>";
                            $excluir = "<a href='acaobd.php?acao=excluir&idcontato=".$usuario['idcontato']."'>Exc</a>";;
                            echo "<tr><td>".$usuario["idcontato"]."</td>"."<td>".$usuario["nome"]."</td>"."<td>".$usuario["email"]."</td>"."<td>".$usuario["idade"]."</td><td>$editar</td>"."<td>$excluir</td>"."</tr>";
                        }

                    }catch(PDOExeptio $e){
                        print("Erro ao conectar com o banco de dados . . . <bre>".$e->getMenssage());
                        die();
                    }
            ?>
        </table>
    </div>
    
</body>
</html>