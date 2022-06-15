<?php
require_once('config.php');

if (!isset($_SESSION)) {
    session_start();
}

$id = $_SESSION['usuario'];
$tipo = $_SESSION['admin'];
$nome = $_SESSION['nome'];
$mae = $_SESSION['mae'];
$celular = $_SESSION['celular'];
$nascimento = $_SESSION['nascimento'];
$cpf = $_SESSION['cpf'];

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
</head>

<body>
    <div align="center">
        <h1>Logs Do Sistema</h1>
    </div>
    <table border="1" cellpadding="10" align="center">
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
        <a href="lista_de_usuarios.php">Lista de Usuários</a>
    </div>

</body>

</html>