<!-- De modo mais geral esse arquivo é uma variação reduzida de lista_de_usuarios.php -->
<?php
require_once('config.php'); //Chamada do arquivo config.php

session_start(); //inicio de sessão
$id_session = $_SESSION['usuario']; //atribuição de informações da sessao a variaveis 
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

$id = intval($_GET['id']);
$query_user = "SELECT usu_id, usu_cpf, usu_nome, usu_celular, usu_fixo, usu_nascimento, usu_email, usu_mae, usu_tipo FROM usuario WHERE usu_id = '$id' LIMIT 1"; // codigo sql a ser executado, a diferença é que nesse arquivo a intenção é recuperar apenas as informações baseadas no id do usuario que foi selecionado
$resultado_usu = $mysqli->query($query_user) or die($mysqli->error); // variavel de sucesso/falha de operação

$query_end = "SELECT end_id, end_cep, end_endereco, end_numero, end_complemento, end_bairro, end_cidade, end_estado, end_referencia  FROM endereco WHERE usu_id = '$id' LIMIT 1"; // codigo sql a ser executado, a diferença é que nesse arquivo a intenção é recuperar apenas as informações baseadas no id do usuario que foi selecionado
$resultado_end = $mysqli->query($query_end) or die($mysqli->error); // variavel de sucesso/falha de operação
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecall - Read Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <div align="center"><br /><br />
        <img src="../../Assets/Logo/telecall-logo.png" alt="" width="300">
    </div><br />
    <div align="center"><br />
        <h1>Dados do Cliente</h1>
    </div><br />
    <table cellpadding="10" align="center">
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
                <!-- se retornar um resultado vazio ele exibe um html no lugar de um erro -->
                <tr>
                    <td collspan="11">Erro ao Encontrar Usuário</td>
                </tr>
                <?php } else { //caso seja false ele transforma o sucesso da operação em um array e atribui a uma variavel $usuario depois formata os resultados
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
    <!-- A partir daqui ele faz o mesmo que fez com a tabela usuarios, porém com a tabela endereços -->
    <div align="center"><br /><br />
        <h1>Dados Residenciais</h1>
    </div><br />
    <table cellpadding="10" align="center">
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
    </table><br /><br />
    <div align="center">
        <a href="./lista_de_usuarios.php" class="btn btn-primary">Lista de Usuários</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>