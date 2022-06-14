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

$query_user = "SELECT usu_id, usu_cpf, usu_nome, usu_celular, usu_fixo, usu_nascimento, usu_email, usu_mae, usu_tipo FROM usuario WHERE usu_id = '$id' LIMIT 1";
$resultado_usu = $mysqli->query($query_user) or die($mysqli->error);

$query_end = "SELECT end_id, end_cep, end_endereco, end_numero, end_complemento, end_bairro, end_cidade, end_estado, end_referencia  FROM endereco WHERE usu_id = '$id' LIMIT 1";
$resultado_end = $mysqli->query($query_end) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div align="center">
        <h1>Dados do Cliente</h1>
    </div>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <th>Id</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone Celular</th>
            <th>Telefone Fixo</th>
            <th>Data de Nascimento</th>
            <th>Nome da Mãe</th>
        </thead>
        <tbody>
            <?php if (empty($resultado_usu)) { ?>
                <tr>
                    <td collspan="11">Erro ao Encontrar Usuário</td>
                </tr>
                <?php } else {
                while ($usuario = $resultado_usu->fetch_assoc()) {
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
                ?>
                    <tr>
                        <td><?php echo $usuario['usu_id'] ?></td>
                        <td><?php if ($usuario['usu_tipo'] == 1)  echo "ADM";
                            else echo "CLIENTE"; ?></td>
                        <td><?php echo $usuario['usu_nome'] ?></td>
                        <td><?php echo $usuario['usu_cpf'] ?></td>
                        <td><?php echo $usuario['usu_email'] ?></td>
                        <td><?php echo $usuario['usu_celular'] ?></td>
                        <td><?php echo $usuario['usu_fixo'] ?></td>
                        <td><?php echo $usuario['usu_nascimento'] ?></td>
                        <td><?php echo $usuario['usu_mae'] ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table> 
    <div align="center">
        <h1>Dados Residenciais</h1>
    </div>
    <table border="1" cellpadding="10" align="center">
        <thead>
            <th>Id</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Referência</th>
        </thead>
        <tbody>
            <?php if (empty($resultado_end)) { ?>
                <tr>
                    <td collspan="11">Erro ao Encontrar Usuário</td>
                </tr>
                <?php } else {
                while ($endereco = $resultado_end->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $endereco['end_id'] ?></td>
                        <td><?php echo $endereco['end_cep'] ?></td>
                        <td><?php echo $endereco['end_endereco'] ?></td>
                        <td><?php echo $endereco['end_numero'] ?></td>
                        <td><?php echo $endereco['end_complemento'] ?></td>
                        <td><?php echo $endereco['end_bairro'] ?></td>
                        <td><?php echo $endereco['end_cidade'] ?></td>
                        <td><?php echo $endereco['end_estado'] ?></td>
                        <td><?php echo $endereco['end_referencia'] ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table><br/><br/>
    <div align="center">
        <a href="./lista_de_usuarios.php">Lista de Usuários</a>
    </div>
</body>

</html>