<?php

require_once('./config.php');


$erro = false;
if (isset($_POST['email']) && isset($_POST['senha'])) {
  $email = $mysqli->escape_string($_POST['email']);
  $senha = $_POST['senha'];

  $sql_code = "SELECT * FROM usuario WHERE usu_email = '$email'";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

  if ($sql_query->num_rows == 0) {
    echo "Email Incorreto";
  } else {
    $usuario = $sql_query->fetch_assoc();
    if (!password_verify($senha, $usuario['usu_senha'])) {
      echo "Senha Incorreta";
    } else {
      if (!isset($_SESSION)) {
        if ($usuario['usu_tipo'] == 1) {
          session_start();
          $_SESSION['usuario'] = $usuario['usu_id'];
          $_SESSION['admin'] = "ADM";
          header("Location: 2fa.php");
        }else{
          session_start();
          $_SESSION['usuario'] = $usuario['usu_id'];
          $_SESSION['admin'] = "CLIENTE";
          header("Location: index.html");
        }
      }
    }
  }

  if (!$erro) {
  } else {
    echo $erro;
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

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
  <form action="" method="post">
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