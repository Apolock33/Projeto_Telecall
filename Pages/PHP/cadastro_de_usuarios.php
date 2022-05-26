<!DOCTYPE html>
<html lang="pt-br">

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
      <label for="cpf">CPF:</label>
      <input type="text" name="cpf" id="cpf" value="<?php if (isset($_POST["cpf"])) echo $_POST["cpf"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" value="<?php if (isset($_POST["nome"])) echo $_POST["nome"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="email">E-mail:</label>
      <input type="email" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" value="<?php if (isset($_POST["senha"])) echo $_POST["senha"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="telefone">Celular:</label>
      <input type="text" name="telefone" id="telefone" placeholder="(11) 98888-8888" value="<?php if (isset($_POST["telefone"])) echo $_POST["telefone"] ?>" />
    </div><br /><br />
    <div class="inputs">
      <label for="fixo">Telefone Fixo:</label>
      <input type="text" name="fixo" id="fixo" placeholder="(11) 2121-2121" value="<?php if (isset($_POST["fixo"])) echo $_POST["fixo"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="nascimento">Data de Nascimento:</label>
      <input type="text" name="nascimento" id="nascimento" value="<?php if (isset($_POST["nascimento"])) echo $_POST["nascimento"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <label for="mae">Nome da Mãe:</label>
      <input type="text" name="mae" id="mae" value="<?php if (isset($_POST["mae"])) echo $_POST["mae"] ?>" />
    </div><br /><br />

    <div>
      <label for="admin">Você é:</label>
      <input type="radio" name="admin" id="admin" value="1">Funcionário</input>
      <input type="radio" name="admin" id="admin" checked value="0">Cliente</input>
    </div><br /><br />

    <div class="inputs">
      <input type="submit" value="Salvar Usuário" />
      <a href="lista_de_usuarios.php">Lista de Usuários</a>
    </div>

  </form>

</body>

</html>

<?php
require_once('config.php');

require_once('lib/mail.php');

function limpar_telefone($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}
function limpar_cpf($str)
{
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
  $senha_nao_crypt = $_POST['senha'];
  $admin = $_POST['admin'];

  if (empty($cpf)) {
    $erro = "Preencha o campo CPF";
  }

  if (empty($nome)) {
    $erro = "Prencha o campo Nome";
  }

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro = "Prencha o campo Email";
  }

  if (empty($senha)) {
    $erro = "Prencha o campo Senha";
  }

  if (strlen($senha_nao_crypt) < 8) {
    $erro = "A senha deve ter ao menos 8 caracteres.";
  }


  if (empty($nome_mae)) {
    $erro = "Prencha o campo Nome da Mãe";
  }

  if (!empty($cpf)) {
    $cpf = limpar_cpf($cpf);
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
    $senha = password_hash($senha_nao_crypt, PASSWORD_DEFAULT);
    $sql_code = "INSERT INTO usuarios (cpf, nome, email, senha, telefone, fixo, nascimento, mae, cadastro, admin) VALUES ('$cpf', '$nome', '$email', '$senha', '$telefone', '$fixo', '$nascimento','$nome_mae', NOW(), '$admin')";
    $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sucesso) {
      enviar_email(
        $email,
        "Informações Cadastrais",
        "Cadastro Realizado!",
        "<h1>Obrigado pelo Cadastro!</h1>
          <h3>Espero que em breve posssamos prover a você o melhor serviço de telefonia e rede!</h3>
          <h4>Aqui estão suas informações cadastrais caso precise consulta-las por qualquer motivo!</h4>
          <div>
            <p>
              <b>Login:</b> $email<br/>
              <b>Senha:</b> $senha_nao_crypt
            </p>
          </div>"
      );
      header("Location: index.php");
      unset($_POST);
    }
  }
}
?>