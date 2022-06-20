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

$sql_logs = "SELECT * FROM log";
$query_log = $mysqli->query($sql_logs) or die($mysqli->error);
$num_logs = $query_log->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs do Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <div align="center"><br/><br/>
        <h1>Logs Do Sistema</h1><br/>
    </div>
    <table cellpadding="10" align="center">
        <thead>
            <th>Id de Log</th>
            <th>Id de Usuário</th>
            <th>Data de Log</th>
            <th>Método de Log</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php if ($num_logs == 0) {  ?>
                <tr>
                    <td colspan="5">Nenhhum Usuário Foi Cadastrado</td>
                </tr>
                <?php } else {
                while ($log = $query_log->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $log['log_id'] ?></td>
                        <td><?php echo $log['usu_id'] ?></td>
                        <td><?php echo $log['log_data'] ?></td>
                        <td><?php echo $log['log_meth'] ?></td>
                        <td><?php echo $log['log_status'] ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table><br /><br />
    <div align="center">
        <a href="lista_de_usuarios.php" class="btn btn-primary">Lista de Usuários</a>
        <a href="baixarlog.php" class="btn btn-success">Baixar Logs de Acesso</a>
    </div><br/><br/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>