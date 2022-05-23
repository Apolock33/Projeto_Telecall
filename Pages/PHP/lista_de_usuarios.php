<?php
require_once('config.php');

$sql_read = "SELECT * FROM usuarios";
$query_usuarios = $mysqli->query($sql_read) or die($mysqli->error);
$num_usuarios = $query_usuarios->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

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
          <td colspan="8">Nenhum Usuário Foi Cadastrado!</td>
        </tr>
        <?php } else {
        while ($usuario = $query_usuarios->fetch_assoc()) {
          $telefone = "Nao Informado";
          if (!empty(($usuario['telefone']))) {
            $telefone = formatar_telefone($usuario['telefone']);
          }

          if (!empty(($usuario['fixo']))) {
            $fixo = formatar_fixo($usuario['fixo']);
          }


          $nascimento = "Não Informado";
          if (!empty($usuario['nascimento'])) {
            $nascimento = formatar_data($usuario['nascimento']);
          }
          $data_cadastro = date("d/m/Y H:i", strtotime($usuario['cadastro']));
        ?>
          <tr>
            <td><?php echo $usuario['id'] ?></td>
            <td><?php echo $usuario['cpf'] ?></td>
            <td><?php echo $usuario['nome'] ?></td>
            <td><?php echo $usuario['email'] ?></td>
            <td><?php echo $telefone ?></td>
            <td><?php echo $fixo ?></td>
            <td><?php echo $nascimento ?></td>
            <td><?php echo $usuario['mae'] ?></td>
            <td><?php echo $usuario['cadastro'] ?></td>
            <td>
              <a href="editar_usuario.php?id=<?php echo $usuario['id'] ?>">Editar</a>
              <a href="deletar_usuario.php?id=<?php echo $usuario['id'] ?>">Deletar</a>
            </td>
          </tr>
      <?php
        }
      } ?>
    </tbody>
  </table><br />
  <a href="cadastro_de_usuarios.php">Cadastrar usuario</a>
</body>

</html>