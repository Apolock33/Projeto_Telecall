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

require_once('config.php');
$id = intval($_GET['id']);
function limpar_telefone($str) {
  return preg_replace("/[^0-9]/", "", $str);
}

$erro = false;
if (count($_POST) > 0) {
  $cpf = $_POST['cpf'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];
  $fixo = $_POST['fixo'];
  $nascimento = $_POST['nascimento'];
  $nome_mae = $_POST['mae'];
  $admin = $_POST['admin'];

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

  if (!empty($fixo)) {
    $fixo = limpar_telefone($fixo);
    if (strlen($fixo) != 10) {
      $erro = "O telefone deve ser preenchido no padrão (11) 2121-2121";
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
    $sql_code = "UPDATE usuario SET
    usu_cpf = '$cpf',
    usu_nome = '$nome', 
    usu_email = '$email',
    usu_senha = '$senha', 
    usu_celular = '$telefone',
    usu_fixo = '$fixo',
    usu_nascimento = '$nascimento',
    usu_mae = '$nome_mae',
    usu_tipo = '$admin' 
    WHERE usu_id = '$id'";

    $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sucesso) {
      echo "<script>alert('Cadastro Atualizado')</script>";
      unset($_POST);
    }
  }
}

$sql_usuario = "SELECT * FROM usuario WHERE usu_id = '$id'";
$query_usuario = $mysqli->query($sql_usuario) or die($mysqli->error);
$usuario = $query_usuario->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <title>Editar Usuário</title>
</head>

<body>

  <form action="" method="POST" align='center'>
    <div class="logo" align='center'><br/><br/>
      <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro" width="300">
    </div><br/><br/>
    <div align='center'>
      <h2>Preencha as Informações que deseja Alterar</h2>
    </div><br/>
    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="cpf">CPF:</label><br/>
      <input class="form-control w-25" type="text" name="cpf" id="cpf" value="<?php echo $usuario["usu_cpf"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="nome">Nome:</label><br/>
      <input class="form-control w-25" type="text" name="nome" id="nome" value="<?php echo $usuario["usu_nome"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="email">E-mail:</label><br/>
      <input class="form-control w-25" type="email" name="email" id="email" value="<?php echo $usuario["usu_email"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="senha">Senha:</label><br/>
      <input class="form-control w-25" type="password" name="senha" id="senha" value="<?php echo $usuario["usu_senha"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="telefone">Celular:</label><br/>
      <input class="form-control w-25" type="text" name="telefone" id="telefone" placeholder="(11) 98888-8888" value="<?php echo formatar_telefone($usuario["usu_celular"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="fixo">Telefone Fixo:</label><br/>
      <input class="form-control w-25" type="text" name="fixo" id="fixo" placeholder="(11) 2121-2121" value="<?php echo formatar_fixo($usuario["usu_fixo"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="nascimento">Data de Nascimento:</label><br/>
      <input class="form-control w-25" type="text" name="nascimento" id="nascimento" value="<?php if (!empty($usuario["nascimento"])) echo formatar_data($usuario["usu_nascimento"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="mae">Nome da Mãe:</label><br/>
      <input class="form-control w-25" type="text" name="mae" id="mae" value="<?php if (!empty($usuario["mae"])) echo $usuario["usu_mae"] ?>" />
    </div><br /><br />

    <div align='center'>
      <label class="h5 mb-3 fw-normal" for="admin">Você é:</label><br/>
      <input type="radio" name="admin" id="admin" value="1">Funcionário </input>
      <input type="radio" name="admin" id="admin" value="0">Cliente</input>
    </div><br /><br />

    <div class="inputs">
      <input type="submit" value="Atualizar Usuário" class="btn btn-primary"/><br/><br/>
      <a href="lista_de_usuarios.php" class="btn btn-primary">Lista de Usuários</a>
    </div><br/><br/>

  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>