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

if (!isset($_SESSION) && $tipo != 1) {
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
</head>

<body>
  <h1>Lista de Usuários</h1>
  <p>Esses são todos os usuários cadastrados no sistema:</p>
  <table border="1" cellpadding="10">
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
              <a href="ver_usuario.php?id=<?php echo $usuario['usu_id'] ?>">Ver</a><br />
              <a href="editar_usuario.php?id=<?php echo $usuario['usu_id'] ?>">Editar</a>
              <a href="deletar_usuario.php?id=<?php echo $usuario['usu_id'] ?>">Deletar</a>
            </td>
          </tr>
      <?php
        }
      } ?>
    </tbody>
  </table><br />
  <a href="cadastro_de_usuarios.php">Cadastrar usuario</a>
  <a href="./session_drop.php">Sair</a>
</body>

</html>