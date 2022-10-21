<?php
require_once('config.php');

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

$idEspUsu = intval($_GET['id']);

if(isset($_POST['uc'])){
    $sql_query = "UPDATE usuario SET usu_tipo = 0 WHERE usu_id = '$idEspUsu'";
    $query_execute = $mysqli->query($sql_query) or die($mysqli->error);
    header('Location: lista_de_usuarios.php');
}else if(isset($_POST['adm'])){
    $sql_query = "UPDATE usuario SET usu_tipo = 1 WHERE usu_id = '$idEspUsu'";
    $query_execute = $mysqli->query($sql_query) or die($mysqli->error);
    header('Location: lista_de_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telecall - Mudança de Acesso de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet" />
</head>
<body>
    <form action="" method="POST">
        <div class="d-flex flex-column align-items-center justify-content-center" style="margin-top: 20rem">
            <h1>Qual o Nível de Acesso Que Deseja Prover a Este Usuário?</h1>
            <p>Dependendo do nível de acesso, algumas funções ficarão indisponíveis!</p>
            <div>
                <a href="lista_de_usuarios.php" class="btn btn-primary">Voltar</a>
                <button type="input" name="adm" class="btn btn-success">Administrador</button>
                <button type="input" name="uc" class="btn btn-success">Usuário Comum</button>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>
</html>