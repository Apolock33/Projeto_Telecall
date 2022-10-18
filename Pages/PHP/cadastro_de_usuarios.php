<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Telecall - Cadastro de Usuário</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>

<body>
  <div class="logo" align="center">
    <br /><br />
    <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro" width="300">
  </div>
  <section class='formulario'>
    <form action="" method="POST" align="center">
      <br /><br />
      <div align="center">
        <h2>Cadastre-se Gratuitamente</h2>
      </div>
      <br /><br />
      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="cpf">CPF:</label><br />
        <input type="text" class="form-control w-25" name="cpf" id="cpf" value="<?php if (isset($_POST["cpf"])) echo $_POST["cpf"] ?>" />
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="nome">Nome:</label><br />
        <input type="text" class="form-control w-25" name="nome" id="nome" value="<?php if (isset($_POST["nome"])) echo $_POST["nome"] ?>" />
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="email">E-mail:</label><br />
        <input type="email" class="form-control w-25" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>" />
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="senha">Senha:</label><br />
        <input type="password" class="form-control w-25" name="senha" id="senha" value="<?php if (isset($_POST["senha"])) echo $_POST["senha"] ?>" />
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="telefone">Celular:</label><br />
        <input type="text" class="form-control w-25" name="telefone" id="telefone" placeholder="(11) 98888-8888" value="<?php if (isset($_POST["telefone"])) echo $_POST["telefone"] ?>" />
      </div><br /><br />
      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="fixo">Telefone Fixo:</label><br />
        <input type="text" class="form-control w-25" name="fixo" id="fixo" placeholder="(11) 2121-2121" value="<?php if (isset($_POST["fixo"])) echo $_POST["fixo"] ?>" /> 
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="nascimento">Data de Nascimento:</label><br />
        <input type="text" class="form-control w-25" name="nascimento" id="nascimento" value="<?php if (isset($_POST["nascimento"])) echo $_POST["nascimento"] ?>" />
      </div><br /><br />

      <div class="inputs" align="center">
        <label class="h5 mb-3 fw-normal" for="mae">Nome da Mãe:</label><br />
        <input type="text" class="form-control w-25" name="mae" id="mae" value="<?php if (isset($_POST["mae"])) echo $_POST["mae"] ?>" /> <!-- As informações contidas no value dos inputs servem para: caso o usuario digite algum campo incorretamente, o PHP trata de manter as informações já preenchidas nos campos, isso para facilitar a experiência do usuario -->
      </div><br /><br />

      <div class="inputs" align="center">
        <input type="submit" value="2a Etapa" class="btn btn-primary" /><br /><br />
        <a href="./index.php" class="btn btn-warning">Já Tem uma Conta? Clique Aqui!</a><br /><br />
      </div>
    </form>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>

<?php
require_once('config.php'); //Aqui ele chama o arquivo config.php, a conexão com o banco de dados

require_once('lib/mail.php'); //Aqui ele chama o arquivo mail.php, configurado para envio de emails através de PHP 

//Ambas as funções servem para limpar texto dos campos especificados, foram copiadas iguais apenas para facilitar eentendimento
function limpar_telefone($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}

function limpar_cpf($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}

//Aqui foi criada uma variavel booleana para indicar erro ao ser chamada, ela inicia como false e mais a frente, quando chamada, altera-se para true
$erro = false;
if (count($_POST) > 0) { //nesta linha, faz-se a contagem de posts, se essa contagem for maior que 0 ele atribui cada post a sua respectiva variavel
  $cpf = $_POST['cpf'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $telefone = $_POST['telefone'];
  $fixo = $_POST['fixo'];
  $nascimento = $_POST['nascimento'];
  $nome_mae = $_POST['mae'];
  $senha_nao_crypt = $_POST['senha'];


  //A partir daqui, configuro algumas validações para o formulario. Da linha 105 ate 128 ele indica que, caso o campo não seja preenchido, o PHP vai apresentar um erro no Front
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

  //Aqui começam validações mais específicas, que em alguns momentos tratam-se de parametros estipulados no banco de dados

  //Nessa condição, ele declara que se o telefone não estiver vazio, ele vai limpar os caracteres não numericos do campo e, caso o telefone tenha mais ou menos de 11 digitos, ele apresenta o erro descrito abaixo
  if (!empty($telefone)) {
    $telefone = limpar_telefone($telefone);
    if (strlen($telefone) != 11) {
      $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }
  }

  //Nessa condição, ele declara que se o telefone fixo não estiver vazio, ele vai limpar os caracteres não numericos do campo e, caso o telefone tenha mais ou menos de 10 digitos, ele apresenta o erro descrito abaixo
  if (!empty($fixo)) {
    $fixo = limpar_telefone($fixo);
    if (strlen($fixo) != 10) {
      $erro = "O telefone deve ser preenchido no padrão (11) 2121-2121";
    }
  }

  //Nessa condição ele apenas formata a data para que ela seja apresentada no pad~rao brasileiro e caso não esteja nesse padrão, ele apresenta um erro descrito abaixo
  if (!empty($nascimento)) {
    $pedacos = explode('/', $nascimento);
    if (count($pedacos) == 3) {
      $nascimento = implode('-', array_reverse($pedacos));
    } else {
      $erro = "A data de nascimento deve ser preenchida no padrão Dia/Mês/Ano";
    }
  }

  //A partir daqui, ele verifica se há erros ao enviar informações pelo Input
  if ($erro) { //caso seja true, ele apresenta o erro
    echo "<p><b>$erro</b></p>";
  } else { //caso seja false, ele começa a criptografar a senha inserida, define o comando sql a ser utilizado no envio de dados e define uma variavel que, caso realize a query(true) ele insere dados no Banco, caso seja false ele faz o script parar de rodar e apresenta o erro que ocorreu
    $senha = password_hash($senha_nao_crypt, PASSWORD_DEFAULT);
    $sql_get = "SELECT * FROM usuario";
    $sql_query_get = $mysqli -> query($sql_get) or die($mysqli->error);
    
    if(mysqli_num_rows($sql_query_get) == null || mysqli_num_rows($sql_query_get)  == 0){
      $sql_code = "INSERT INTO usuario (usu_cpf, usu_nome, usu_email, usu_senha, usu_celular, usu_fixo, usu_nascimento, usu_mae, usu_cadastro, usu_tipo) VALUES ('$cpf', '$nome', '$email', '$senha', '$telefone', '$fixo', '$nascimento','$nome_mae', NOW(), 1)";
    }else{
      $sql_code = "INSERT INTO usuario (usu_cpf, usu_nome, usu_email, usu_senha, usu_celular, usu_fixo, usu_nascimento, usu_mae, usu_cadastro, usu_tipo) VALUES ('$cpf', '$nome', '$email', '$senha', '$telefone', '$fixo', '$nascimento','$nome_mae', NOW(), 0)";
    }
    $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sucesso) { //aqui ele realiza features extras, como guardar o id do usuario inserido nesse momento, envia um email para o usuario com as informações de Login cadastradas e envia o usuário para a pagina de cadastro das informações postais
      $id = mysqli_insert_id($mysqli);
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
      header("Location: cadastro_endereco.php?id=$id");
    }
  }
}
?>