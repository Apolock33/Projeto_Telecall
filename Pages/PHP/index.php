<?php

require_once('./config.php'); // chamada da conexão do banco


$erro = false; //variavel de erro
if (isset($_POST['email']) && isset($_POST['senha'])) { //aqui o PHP verifica se existe inserção de dados nos campos e se for true, ele atribui aos valores dos campos, variáveis
  $email = $mysqli->escape_string($_POST['email']);
  $senha = $_POST['senha'];

  $sql_code = "SELECT * FROM usuario WHERE usu_email = '$email'"; //codigo sql
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error); //variavel que dfine o suscesso ou fracasso da operação

  if ($sql_query->num_rows == 0) { //aqui ele verifica se há resultados para o código sql executado, caso seja igual a 0 ele retorna email inconrreto
    echo "Email Incorreto";
  } else {
    $usuario = $sql_query->fetch_assoc(); //aqui ele recebe as informações da linha da tabela que foi encontrada atraves da variavel $sql_query e atribui elas a uma variavel de valor array chamada $usuario
    if (!password_verify($senha, $usuario['usu_senha'])) { //aqui ele verifica se o valor do campo senha é difrente da senha encontrada no array $usuario, caso seja, ele exibe o erro senha incorreta
      echo "Senha Incorreta";
    } else { // caso seja igual ele faz uma nova verificação
      if (!isset($_SESSION)) { //caso não haja sessão ele inicia uma nova e atribui a superglobal, como um array, os valores encontrados no array $usuario e envia o cliente para a pagina 2fa
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

  //Aqui ele apresenta um erro caso alguma das operações acima dê errado
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
  <!-- Bootstrap -->
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