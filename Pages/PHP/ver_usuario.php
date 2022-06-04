<?php
require_once('config.php');

$sql_read = "SELECT * FROM usuario";
$query_usuarios = $mysqli->query($sql_read) or die($mysqli->error);
$num_usuarios = $query_usuarios->num_rows;

$sql_read2 = "SELECT * FROM endereco";
$query_endereco = $mysqli->query($sql_read2) or die($mysqli->error);
$num_endereco = $query_endereco->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecall - Informações do Usuario</title>
</head>

<body></body>
<h1>Informações do Usuário</h1>
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
                </tr>

        <?php
            }
        } ?>
    </tbody>
</table><br />

<table border="1" cellpadding="10">
    <thead>
        <th>ID</th>
        <th>CEP</th>
        <th>Endereço</th>
        <th>Número</th>
        <th>Complemento</th>
        <th>Celular</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
    </thead>
    <tbody>
        <?php if ($num_endereco == 0) { ?>
            <tr>
                <td colspan="11">Nenhum Usuário Foi Cadastrado!</td>
            </tr>
            <?php } else {
            while ($endereco = $query_endereco->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $endereco['end_id'] ?></td>
                    <td><?php echo $endereco['end_cep'] ?></td>
                    <td><?php echo $endereco['end_endereco']; ?></td>
                    <td><?php echo $endereco['end_numero']; ?></td>
                    <td><?php echo $endereco['end_bairro']; ?></td>
                    <td><?php echo $endereco['end_cidade']; ?></td>
                    <td><?php echo $endereco['end_estado']; ?></td>
                </tr>

        <?php
            }
        } ?>
    </tbody>
</table><br />
<a href="lista_de_usuarios.php">lista de usuarios</a>
</body>

</html>