<?php
require_once('config.php');

session_start();

$id = $_SESSION['usuario'];
$tipo = $_SESSION['admin'];
$nome = $_SESSION['nome'];
$mae = $_SESSION['mae'];
$celular = $_SESSION['celular'];
$nascimento = $_SESSION['nascimento'];
$cpf = $_SESSION['cpf'];

if (!isset($_SESSION) && $tipo != 1) {
    session_destroy();
    header('Location: index.php');
  }
  
  if ($tipo !== 1) {
    session_destroy();
    header('Location: index.php');
  }

$sql_read = "SELECT * FROM usuario";
$query_usuarios = $mysqli->query($sql_read) or die($mysqli->error);
$num_usuarios = $query_usuarios->num_rows;

$sql_read2 = "SELECT * FROM endereco";
$query_endereco = $mysqli->query($sql_read2) or die($mysqli->error);
$num_endereco = $query_endereco->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecall - Informações do Usuario</title>
</head>

<body>
    
<a href="lista_de_usuarios.php">lista de usuarios</a>
</body>

</html>