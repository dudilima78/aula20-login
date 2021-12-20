<?php 

$idusuario = isset($_GET["idusuario"]) ? $_GET["idusuario"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  tblusuarios where idusuario= :idusuario";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idusuario",$idusuario);
            $stmt->execute();
            header("Location:listarusuarios.php");
        }


        if($idusuario){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblusuarios where idusuario= :idusuario";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idusuario",$idusuario);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if($_POST){
            if($_POST["idusuario"]){
                $sql = "UPDATE tblusuarios SET nome=:nome, email=:email , senha=:senha , idsituacao=:idsituacao, idnivelacesso=:idnivelacesso , criado=:criado, modificado=:modificado WHERE idusuario =:idusuario";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome", $_POST["nome"]);
                $stmt->bindValue(":email", $_POST["email"]);
                $stmt->bindValue(":senha", $_POST["senha"]);
                $stmt->bindValue(":idsituacao", $_POST["idsituacao"]);
                $stmt->bindValue(":idnivelacesso", $_POST["idnivelacesso"]);
                $stmt->bindValue(":criado", $_POST["criado"]);
                $stmt->bindValue(":modificado", $_POST["modificado"]);
                $stmt->bindValue(":idusuario", $_POST["idusuario"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO tblusuarios(nome,email,senha,idsituacao,idnivelacesso,criado,modificado) VALUES (:nome,:email,:senha,:idsituacao,:idnivelacesso,:criado,:modificado)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome", $_POST["nome"]);
                $stmt->bindValue(":email", $_POST["email"]);
                $stmt->bindValue(":senha", md5($_POST["senha"]) );
                $stmt->bindValue(":idsituacao", $_POST["idsituacao"]);
                $stmt->bindValue(":idnivelacesso", $_POST["idnivelacesso"]);
                $stmt->bindValue(":criado", $_POST["criado"]);
                $stmt->bindValue(":modificado", $_POST["modificado"]);
                $stmt->execute(); 
            }
            header("Location:listarusuarios.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Criar Usuário</title>
</head>
<body>

<div class="container-fluid">
<h1>Cadastro de Usuários</h1>

<form method="POST">

Usuário: <input type="text"   name="nome"   value="<?php echo isset($user) ? $user->nome : null ?>"><br><br>
E-mail:  <input type="text"   name="email"  value="<?php echo isset($user) ? $user->email : null ?>"><br><br>
Senha:   <input type="text"   name="senha"  value="<?php echo isset($user) ? $user->senha : null ?>"><br><br>
Situação: <input type="text"  name="idsituacao"   value="<?php echo isset($user) ? $user->idsituacao : null ?>"><br><br>
Nível de Acesso:  <input type="text"   name="idnivelacesso"  value="<?php echo isset($user) ? $user->idnivelacesso : null ?>"><br><br>
Criado:   <input type="date"   name="criado"  value="<?php echo isset($user) ? $user->criado : null ?>"><br><br>
Modificado:   <input type="date"   name="modificado"  value="<?php echo isset($user) ? $user->modificado : null ?>"><br><br>
<input type="hidden" name="idusuario" value="<?php echo isset($user) ? $user->idusuario : null ?>">
<input type="submit" class="btn btn-primary" value="Cadastrar">

</form>
<hr>
<a class="btn btn-success" href="administrativo.php">Voltar</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>