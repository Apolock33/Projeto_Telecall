<?php
// esse arquivo é muito parecido com o Create, porém difere em alguns momentos que serão explicados mais a frente
if (!isset($_SESSION)) { //verificação e inicio de sessão
  session_start();
}

$id = $_SESSION['usuario']; //atribuição de informações da sessao a variaveis
$tipo = $_SESSION['admin'];
$nome = $_SESSION['nome'];
$mae = $_SESSION['mae'];
$celular = $_SESSION['celular'];
$nascimento = $_SESSION['nascimento'];
$cpf = $_SESSION['cpf'];

//bloqueio de paginas para usuarios cliente
if ($_SESSION['admin'] == 1) {
} else {
  session_destroy();
  header('Location: index.php');
}

require_once('config.php'); //chamada do arquivo config.php
$id = intval($_GET['id']); //recebimento do id atraves da url
function limpar_telefone($str)
{ //função de formatação de telefone
  return preg_replace("/[^0-9]/", "", $str);
}

$erro = false; //variavel de erro
if (count($_POST) > 0) { //aqui o php conta a quantidade de posts e verifica se essa quantidade é igual a 0
  $cpf = $_POST['cpf']; //atribuição de informações do Post a variaveis
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];
  $fixo = $_POST['fixo'];
  $nascimento = $_POST['nascimento'];
  $nome_mae = $_POST['mae'];
  $admin = $_POST['admin'];

  //a partir daqui ocorrem novas formatações e validações de telefone celular, telefone fixo e data de nascimento
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

  //aqui ele verifica se há qualquer erro, se for true, o PHP mostra o erro
  if ($erro) {
    echo "<p><b>$erro</b></p>";
  } else { //caso seja false, o PHP prepara uma query sql para ser executada
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

    $sucesso = $mysqli->query($sql_code) or die($mysqli->error); //variavel de sucesso/fracasso da query
    if ($sucesso) { //caso haja suscesso, o PHP exibe um alert de javascript e limpa os formulários
      echo "<script>alert('Cadastro Atualizado')</script>";
      unset($_POST);
    }
  }
}

$sql_usuario = "SELECT * FROM usuario WHERE usu_id = '$id'"; // codigo sql a ser executado
$query_usuario = $mysqli->query($sql_usuario) or die($mysqli->error); //variavel de sucesso/fracasso da query
$usuario = $query_usuario->fetch_assoc(); //aqui o PHP pega o resultado da operação e transforma em um array
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet" />
  <title>Editar Usuário</title>
</head>

<body>

  <form action="" method="POST" align='center'>
    <div class="logo" align='center'><br /><br />
      <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro" width="300">
    </div><br /><br />
    <div align='center'>
      <h2>Preencha as Informações que deseja Alterar</h2>
    </div><br />
    <!-- aqui o PHP recupera do BD os valores que estão lá, para que não seja atualizado nenhum valor em branco -->
    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="cpf">CPF:</label><br />
      <input class="form-control w-25" type="text" name="cpf" id="cpf" value="<?php echo $usuario["usu_cpf"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="nome">Nome:</label><br />
      <input class="form-control w-25" type="text" name="nome" id="nome" value="<?php echo $usuario["usu_nome"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="email">E-mail:</label><br />
      <input class="form-control w-25" type="email" name="email" id="email" value="<?php echo $usuario["usu_email"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="senha">Senha:</label><br />
      <input class="form-control w-25" type="password" name="senha" id="senha" value="<?php echo $usuario["usu_senha"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="telefone">Celular:</label><br />
      <input class="form-control w-25" type="text" name="telefone" id="telefone" placeholder="(11) 98888-8888" value="<?php echo formatar_telefone($usuario["usu_celular"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="fixo">Telefone Fixo:</label><br />
      <input class="form-control w-25" type="text" name="fixo" id="fixo" placeholder="(11) 2121-2121" value="<?php echo formatar_fixo($usuario["usu_fixo"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="nascimento">Data de Nascimento:</label><br />
      <input class="form-control w-25" type="text" name="nascimento" id="nascimento" value="<?php echo formatar_data($usuario["usu_nascimento"]) ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="mae">Nome da Mãe:</label><br />
      <input class="form-control w-25" type="text" name="mae" id="mae" value="<?php echo $usuario["usu_mae"] ?>" />
    </div><br /><br />

    <div align='center'>
      <label class="h5 mb-3 fw-normal" for="admin">Você é:</label><br />
      <input type="radio" name="admin" id="admin" value="1">Funcionário </input>
      <input type="radio" name="admin" id="admin" value="0" checked>Cliente</input>
    </div><br /><br />

    <div class="inputs">
      <input type="submit" value="Atualizar Usuário" class="btn btn-primary" /><br /><br />
      <a href="lista_de_usuarios.php" class="btn btn-primary">Lista de Usuários</a>
      <a href="editar_endereco.php?id=<?php echo $id; ?>" class="btn btn-primary">Atualizar Endereço</a>
    </div><br /><br />

  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>