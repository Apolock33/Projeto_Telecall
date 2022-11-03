<?php
  if (!isset($_SESSION)) {
    session_start();
  } //aqui ele verifica se existe sessao ativa, caso não exista ele gera uma nova
  
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deletar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet" />
</head>
<body>
  <br /><br /><br /><br />
  <br /><br /><br /><br />
  <br /><br />
  <div align="center">
    <h1>Tem Certeza Que Deseja Deletar Este Usuário?</h1>
  </div>
  <form action="" method="POST" align="center">
    <a class="btn btn-primary" href="lista_de_usuarios.php">Não</a>
    <button type="submit" name="confirmar" value="1" class="btn btn-danger">Sim</button>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>

<?php
//aqui ele verifica se existem dados sendo enviados pelo botão de confirmação
if (isset($_POST['confirmar'])) { //caso seja true ele:
  require_once('config.php'); //chama or arquivo config.php
  $id = intval($_GET['id']); //recebe e atribui a uma variavel o id
  $sql_code_usu = "DELETE FROM usuario WHERE usu_id = '$id'"; //prepara codigos sql para serem executados
  $sql_code_end = "DELETE FROM endereco WHERE usu_id = '$id'";
  $sql_code_log = "DELETE FROM log WHERE usu_id = '$id'";
  $sql_query_log = $mysqli->query($sql_code_log) or die($mysqli->error); // cria variaveis de sucesso/falha de operações
  $sql_query_end = $mysqli->query($sql_code_end) or die($mysqli->error);
  $sql_query_usu = $mysqli->query($sql_code_usu) or die($mysqli->error);
  if ($sql_query_usu && $sql_query_end && $sql_code_log) {
   
    echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Cadastro Deletado Com Sucesso!',
              timer: 2000
            })

            setTimeout(()=>{
                window.location.assign('lista_de_usuarios.php')
              }, 3500);
          </script>";
    die(); //realiza parada forçada no script assim q a resposta é apresentada
  }
}
?>