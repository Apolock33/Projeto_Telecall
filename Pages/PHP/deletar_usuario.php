

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deletar Usuário</title>
</head>

<body>
  <h1>Tem Certeza Que Deseja Deletar Este Usuário?</h1>
  <form action="" method="POST">
    <a href="lista_de_usuarios.php">Não</a>
    <button type="submit" name="confirmar" value="1" >Sim</button>
  </form>
</body>

</html>
<?php
if (isset($_POST['confirmar'])) {
  
    require_once('config.php');
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM usuarios WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if ($sql_query) { ?>
      
      <h4>Usuário Deletado Com Sucesso</h4>
      <p><a href='lista_de_usuarios.php'>Clique Aqui</a> para voltar a lista de usuários</p>
      <?php
        die();
    }
} 
?>
