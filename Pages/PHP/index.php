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
        session_start();
        $_SESSION['usuario'] = $usuario['usu_id'];
        $_SESSION['admin'] = $usuario['usu_tipo'];
        $_SESSION['nome'] = $usuario['usu_nome'];
        $_SESSION['cpf'] = $usuario['usu_cpf'];
        $_SESSION['mae'] = $usuario['usu_mae'];
        $_SESSION['celular'] = $usuario['usu_celular'];
        $_SESSION['nascimento'] = $usuario['usu_nascimento'];
        header("Location: 2fa.php");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
  <br /><br /><br /><br /><br /><br />
  <section class="align-items-center justify-content-center">
    <div class='container-fluid justify-content-center align-items-center' align="center">
      <form action='' method="POST" align="center">
        <img class="mb-4" src="../../Assets/Logo/telecall-logo.png" alt="" width="300">
        <h1 class="h3 mb-3 fw-normal">Entre com seu Usuário</h1>

        <div align="center">
          <label for="email" class="h5 mb-3 fw-normal">Email:</label>
          <input type="email" class="form-control w-25" name="email" id="email" placeholder="nome@exemplo.com">
        </div><br />
        <div align="center">
          <label for="senha" class="h5 mb-3 fw-normal">Senha:</label>
          <input type="password" class="form-control w-25" name="senha" id="senha" placeholder="Senha" align="center">
        </div><br />
        <button class="w-25 btn btn-lg btn-primary" type="submit">Entrar</button>
      </form>
      <br />
      <a align="center" href="./cadastro_de_usuarios.php" class="btn btn-warning">Ainda Não Tem uma Conta? Clique Aqui!</a>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>