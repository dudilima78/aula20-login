<?php
include('../conexao/conexao.php');

try{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdprojeto";
    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 
    $sql = "SELECT * from tblusuarios";
    $qry = $con->query($sql);
    $users = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($users);
    //die();
} catch(PDOException $e){
    echo $e->getMessage();
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Listar Usuarios</title>
</head>
<body>

<div class="container-fluid">
    
<h1>Lista de Usuários</h1>
<hr>
<a href="frmusuario.php" class="btn btn-outline-primary">Novo Cadastro</a>
<hr>
<table class="table">
    <thead>
        <tr>
           <th>Id</th> 
           <th>Nome</th>
           <th>Email</th>
           <th>Senha</th> 
           <th>Id Situação</th>
           <th>Id Nivel de Acesso</th>
           <th>Criado</th>
           <th>Modificado</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr>
            <td><?php echo $user->idusuario ?></td>
            <td><?php echo $user->nome ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->senha ?></td>
            <td><?php echo $user->idsituacao ?></td>
            <td><?php echo $user->idnivelacesso ?></td>
            <td><?php echo $user->criado ?></td>
            <td><?php echo $user->modificado ?></td>
            
            <td><a href="frmusuario.php?idusuario=<?php echo $user->idusuario ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmusuario.php?op=del&idusuario=<?php echo  $user->idusuario ?>" class="btn btn-danger">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<a class="btn btn-success" href="administrativo.php">Voltar</a>

        </div>

</body>
</html>