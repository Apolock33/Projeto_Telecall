<?php
require_once('config.php');
$id = intval($_GET['id']);
function limpar_telefone($str) {
  return preg_replace("/[^0-9]/", "", $str);
}

$erro = false;
if (count($_POST) > 0) {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];
  $nascimento = $_POST['nascimento'];

  if (empty($nome)) {
    $erro = "Prencha o campo Nome";
  }

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro = "Prencha o campo Email";
  }

  if (empty($senha)) {
    $erro = "Prencha o campo Senha";
  }

  if (!empty($telefone)) {
    $telefone = limpar_telefone($telefone);
    if (strlen($telefone) != 11) {
      $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }
  }

  if (!empty($nascimento)) {
    $pedacos = explode('/', $nascimento);
    if (count($pedacos) == 3) {
      $nascimento = implode('-', array_reverse($pedacos));
    } else {
      $erro = "A data de nascimento deve ser preenchida no padrão Dia/Mês/Ano";
    } 
  }

  if ($erro) {
    echo "<p><b>$erro</b></p>";
  } else {
    $sql_code = "UPDATE usuarios SET 
    nome = '$nome', 
    email = '$email',
    senha = '$senha', 
    telefone = '$telefone', 
    nascimento = '$nascimento' 
    WHERE id = '$id'";

    $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sucesso) {
      echo "<script>alert('Cadastro Atualizado')</script>";
      unset($_POST);
    }
  }
}

$sql_usuario = "SELECT * FROM usuarios WHERE id = '$id'";
$query_usuario = $mysqli->query($sql_usuario) or die($mysqli->error);
$usuario = $query_usuario->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/Cadastro.css">
  <title>Cadastro de Usuário</title>
</head>

<body>
  <form action="" method="POST">
    <div class="logo">
      <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro">
    </div>
    <div class="inputs">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" value="<?php echo $usuario["nome"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="email">E-mail:</label>
      <input type="email" name="email" id="email" value="<?php echo $usuario["email"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" value="<?php echo $usuario["senha"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="telefone">Telefone:</label>
      <input type="text" name="telefone" id="telefone" placeholder="(11) 98888-8888" value="<?php echo formatar_telefone($usuario["telefone"]) ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="nascimento">Data de Nascimento:</label>
      <input type="text" name="nascimento" id="nascimento" value="<?php if(!empty($usuario["nascimento"])) echo formatar_data($usuario["nascimento"]) ?>" />
    </div><br /><br />

    <div class="inputs">
      <input type="submit" value="Atualizar Usuário" />
      <a href="lista_de_usuarios.php">Lista de Usuários</a>
    </div>

  </form>

</body>

</html>