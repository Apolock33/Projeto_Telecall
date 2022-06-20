<?php
require_once('config.php');
session_start();
$id = $_SESSION['usuario'];
$tipo = $_SESSION['admin'];
$nome = $_SESSION['nome'];
$mae = $_SESSION['mae'];
$celular = $_SESSION['celular'];
$nascimento = $_SESSION['nascimento'];
$cpf = $_SESSION['cpf'];
if ($_SESSION['admin'] == 1) {
} else {
  session_destroy();
  header('Location: index.php');
}




$sql_read = "SELECT * FROM usuario";
$query_usuarios = $mysqli->query($sql_read) or die($mysqli->error);
$num_usuarios = $query_usuarios->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
  <div align="center" ><br/>
    <img src="../../Assets/Logo/telecall-logo.png" alt="" width="150"><br/><br/><br/>
    <h1>Lista de Usuários</h1>
    <p>Esses são todos os usuários cadastrados no sistema:</p>
  </div>
  <div class="container-fluid" align="center">
    <table cellpadding="10" align="center">
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
          <tr>
            <td colspan="11">Nenhum Usuário Foi Cadastrado!</td>
          </tr>
          <?php } else {
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
                <a href="ver_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-success m-1">Ver</a><br />
                <a href="editar_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-primary m-1">Editar</a>
                <a href="deletar_usuario.php?id=<?php echo $usuario['usu_id'] ?>" class="btn btn-danger m-1">Deletar</a>
              </td>
            </tr>
        <?php
          }
        } ?>
      </tbody>
    </table><br />
  </div>
  <div align="center" name>
    <a href="cadastro_de_usuarios.php" class="btn btn-primary">Cadastrar usuario</a>
    <a href="logs.php" class="btn btn-success">Visualizar Logs de Acesso</a>
    <a href="./session_drop.php" class="btn btn-danger">Sair</a>
    <br/><br/>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>