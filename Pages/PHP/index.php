<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Telecall - Login</title>
</head>

<body>
  <div>
    <img src="../../Assets/Logo/telecall-logo.png" alt="logoTelecall" />
  </div>
  <form>
    <div>
      <label for="">E-mail:</label>
      <input type="email" name="email" id="email" />
    </div>
    <div>
      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" />
    </div>
    <div>
      <input type="submit" value="Login" />
    </div>
  </form>
</body>

</html>

<?php

require_once('./config.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
  $email = $mysqli->escape_string($_POST['email']);
  $senha = $_POST['senha'];

  $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

  if ($sql_query->num_rows == 0) {
    echo "Email Incorreto";
  } else {
    $usuario = $sql_query->fetch_assoc();
    if (!password_verify($senha, $user['senha'])) {
      echo "Senha Incorreta";
    } else {
      if (!isset($_SESSION)) {
        session_start();
        $_SESSION['usuario'] = $user['id'];
        $_SESSION['admin'] = $user['admin'];
        header("Location: lista_de_usuarios.php");
      }
    }
  }

  if (!$erro) {
  } else {
    echo $erro;
  }
}

?>