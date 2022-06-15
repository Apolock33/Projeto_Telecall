<?php
if (!isset($_SESSION)) {
  session_start();
}

$id = $_SESSION['usuario'];
$tipo = $_SESSION['admin'];
$nome = $_SESSION['nome'];
$mae = $_SESSION['mae'];
$celular = $_SESSION['celular'];
$nascimento = $_SESSION['nascimento'];
$cpf = $_SESSION['cpf'];

if (isset($_POST['confirmar'])) {
    require_once('config.php');
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM usuario WHERE usu_id = '$id'";
    $sql_code_end = "DELETE FROM endereco WHERE usu_id = '$id'";
    $sql_code_log = "DELETE FROM log WHERE usu_id = '$id'";
    $sql_query_log = $mysqli->query($sql_code_log) or die($mysqli->error);
    $sql_query_end = $mysqli->query($sql_code_end) or die($mysqli->error);
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sql_query && $sql_query2) { ?>
      
      <h1>Usuário Deletado Com Sucesso</h1>
      <p><a href='lista_de_usuarios.php'>Clique Aqui</a> para voltar a lista de usuários</p>
      <?php
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

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

