<?php
require_once('config.php'); //chamada do arquivo config.php
session_start();  //start de session
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

$sql_read = "SELECT * FROM usuario"; // codigo sql a ser executado
$query_usuarios = $mysqli->query($sql_read) or die($mysqli->error); // variavel de sucesso/falha de operação
$num_usuarios = $query_usuarios->num_rows; //aqui ele recupera a quantidade de resultados e atribui esse numero a uma variavel
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet" />
</head>

<body>
  <div align="center"><br />
    <img src="../../Assets/Logo/telecall-logo.png" alt="" width="150"><br /><br /><br />
    <h1>Lista de Usuários</h1>
    <p>Esses são todos os usuários cadastrados no sistema:</p>
  </div>
  <div class="container-fluid" align="center">
    <!-- aqui é criada uma tabela para exibir os resultados -->
    <table cellpadding="10" align="center" class="table-responsive">
      <thead>
        <th>ID</th>
        <th>CPF</th>
        <th>Nível</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Celular</th>
        <th>Fixo</th>
        <th>Data de Nascimento</th>
        <th>Nome Da Mãe</th>
        <th>Data de Cadastro</th>
        <th>Ações</th>
      </thead>
      <tbody>
        <?php if ($num_usuarios == 0) { ?>
          <!-- aqui o codigo verifica se o numero de resultados é maior q 0, se for true, ele retorna um html específico -->
          <tr>
            <td colspan="11">Nenhum Usuário Foi Cadastrado!</td>
          </tr>
          <?php } else { //caso seja false ele transforma o sucesso da operação em um array e atribui a uma variavel $usuario depois formata os resultados
          while ($usuario = $query_usuarios->fetch_assoc()) {
            $celular = "Nao Informado";
            if (!empty(($usuario['usu_celular']))) {
              $celular = formatar_telefone($usuario['usu_celular']);
            }

            if (!empty(($usuario['usu_fixo']))) {
              $fixo = formatar_fixo($usuario['usu_fixo']);
            }


            $nascimento = "Não Informado";
            if (!empty($usuario['usu_nascimento'])) {
              $nascimento = formatar_data($usuario['usu_nascimento']);
            }
            $data_cadastro = date("d/m/Y H:i", strtotime($usuario['usu_cadastro']));
          ?>
            <!-- aqui ele exibe em formato de tabela os resultados -->
            <tr>
              <td><?php echo $usuario['usu_id'] ?></td>
              <td><?php echo $usuario['usu_cpf'] ?></td>
              <td><?php if ($usuario['usu_tipo'] == 1)  echo "ADM";
                  else echo "CLIENTE"; ?></td>
              <td><?php echo $usuario['usu_nome'] ?></td>
              <td><?php echo $usuario['usu_email'] ?></td>
              <td><?php echo $celular ?></td>
              <td><?php echo $fixo ?></td>
              <td><?php echo $nascimento ?></td>
              <td><?php echo $usuario['usu_mae'] ?></td>
              <td><?php echo $usuario['usu_cadastro'] ?></td>
              <td>
                <!-- aqui é um acesso as funções crud do projeto -->
                <a href="ver_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-success m-1">Ver</a><br />
                <a href="editar_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-primary m-1">Editar</a>
                <a href="mudar_acesso.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-primary m-1">Mudar Acesso</a>
                <a href="deletar_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-danger m-1">Deletar</a>
              </td>
            </tr>
        <?php
          }
        } ?>
      </tbody>
    </table><br />
  </div>
  <!-- aqui é um acesso a outras features -->
  <div align="center">
    <a href="cadastro_de_usuarios.php" class="btn btn-primary btn-sm">Cadastrar usuario</a>
    <a href="modelo_de_dados.php" class="btn btn-warning btn-sm">Modelo De Dados</a><br /><br />
    <a href="logs.php" class="btn btn-success btn-sm">Visualizar Logs de Acesso</a>
    <a href="adm.php" class="btn btn-dark btn-sm">Voltar</a>
    <a href="./session_drop.php" class="btn btn-danger btn-sm">Sair</a>
    <br /><br />
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>