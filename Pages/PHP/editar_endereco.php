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


$sql_endereco = "SELECT * FROM endereco WHERE usu_id = '$id'"; // codigo sql a ser executado
$query_endereco = $mysqli->query($sql_endereco) or die($mysqli->error); //variavel de sucesso/fracasso da query
$endereço = $query_endereco->fetch_assoc(); //aqui o PHP pega o resultado da operação e transforma em um array
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
      <label class="h5 mb-3 fw-normal" for="cep">CEP:</label><br />
      <input class="form-control w-25" type="text" name="cep" id="cep" value="<?php echo $endereço["end_cep"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="endereco">Endereço:</label><br />
      <input class="form-control w-25" type="text" name="endereco" id="endereco" value="<?php echo $endereço["end_endereco"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="numero">Numero:</label><br />
      <input class="form-control w-25" type="number" name="numero" id="numero" value="<?php echo $endereço["end_numero"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="complemento">Complemento:</label><br /><br />
      <input class="form-control w-25" type="text" name="complemento" id="complemento" value="<?php echo $endereço["end_complemento"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="bairro">Bairro:</label><br />
      <input class="form-control w-25" type="text" name="bairro" id="bairro" value="<?php echo $endereço["end_bairro"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="cidade">Cidade:</label><br />
      <input class="form-control w-25" type="text" name="cidade" id="cidade" value="<?php echo $endereço["end_cidade"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="estado">Estado:</label><br />
      <input class="form-control w-25" type="text" name="estado" id="estado" value="<?php echo $endereço["end_estado"] ?>" />
    </div><br /><br />

    <div class="inputs" align='center'>
      <label class="h5 mb-3 fw-normal" for="referencia">Referência:</label><br />
      <input class="form-control w-25" type="textarea" name="referencia" id="referencia" value="<?php echo $endereço["end_referencia"] ?>" />
    </div><br /><br />

    <div class="inputs">
      <input type="submit" value="Atualizar Endereço" class="btn btn-primary" /><br /><br />
      <a href="lista_de_usuarios.php" class="btn btn-primary">Lista de Usuários</a>
      <a href="editar_usuario.php" class="btn btn-primary">Editar Usuario</a>
    </div><br /><br />

  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>

<?php 
  $erro = false; //variavel de erro
  if (count($_POST) > 0) { //aqui o php conta a quantidade de posts e verifica se essa quantidade é igual a 0
    $cep = $_POST['cep']; //atribuição de informações do Post a variaveis
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $referencia = $_POST['referencia'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
  
    //aqui ele verifica se há qualquer erro, se for true, o PHP mostra o erro
    if ($erro) {
      echo "<p><b>$erro</b></p>";
    } else { //caso seja false, o PHP prepara uma query sql para ser executada
      $sql_code = "UPDATE endereco SET
      end_cep = '$cep',
      end_endereco = '$endereco', 
      end_numero = '$numero',
      end_complemento = '$complemento', 
      end_referencia = '$referencia',
      end_bairro = '$bairro',
      end_cidade = '$cidade',
      end_estado = '$estado'
      WHERE usu_id = '$id'";
  
      $sucesso = $mysqli->query($sql_code) or die($mysqli->error); //variavel de sucesso/fracasso da query
      if ($sucesso) { //caso haja suscesso, o PHP exibe um alert de javascript e limpa os formulários
        $sucesso_alert = "<script>
                            Swal.fire({
                              icon: 'Success',
                              title: 'Cadastro Atualizado'
                            })
                          </script>";
        echo $sucesso_alert;
        unset($_POST);
      }
    }
  }
?>