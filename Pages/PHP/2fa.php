<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>

    <div align="center" class="justify-content-center align-items-center">
        <br /><br /><br /><br /><br />
        <img class="mb-4" src="../../Assets/Logo/telecall-logo.png" alt="" width="300">
        <h1>Verificação de 2 Fatores!</h1>
        <h5>Apenas por segurança, nos confirme que é você mesmo!</h5><br /><br /><br /><br />
    </div>
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

    $sql_code = "SELECT usu_mae, usu_celular, usu_nascimento, usu_cpf FROM usuario where usu_id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysql_error());

    $resultado = mysqli_fetch_array($sql_query);

    $numero = rand(1, 5);
    switch ($numero) {
        case 1:
            echo "<form method='POST' action='' align='center'>
                    <div align='center'>
                        <label for='mae'>Digite o Nome de sua Mãe:</label><br/><br/>
                        <input type='text' name='mae' id='mae' class='form-control w-25'/><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' class='btn btn-primary'/>
                    </div>
                </form>";
            break;
        case 2:
            echo "<form method='POST' action='' align='center'>
                    <div align='center'>
                        <label for='celular'>Digite o seu Telefone Celular:</label><br/><br/>
                        <input type='text' name='celular' id='celular' class='form-control w-25'/><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' class='btn btn-primary' />
                    </div>
                </form>";
            break;
        case 3:
            echo "<form method='POST' action='' align='center'>
                    <div align='center'>
                        <label for='nascimento'>Digite sua Data de Nascimento:</label><br/><br/>
                        <input type='date' name='nascimento' id='nascimento' class='form-control w-25'/><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' class='btn btn-primary' />   
                    </div>
                </form>";
            break;
        case 4:
            echo "<form method='POST' action='' align='center'>
                    <div align='center'>
                        <label for='ultimos'>Digite os 3 Últimos Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='ultimos' id='ultimos' class='form-control w-25' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' class='btn btn-primary' />
                    </div>
                </form>";
            break;
        case 5:
            echo "<form method='POST' action='' align='center'>
                    <div align='center'>
                        <label for='primeiros'>Digite os 3 Primeiros Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='primeiros' id='primeiros' class='form-control w-25'/><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' class='btn btn-primary' />
                    </div>
                </form>";
            break;
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
<?php
$usu = $_SESSION['usuario'];
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($dados['btn'])) {

    if (isset($dados['mae'])) {

        if ($resultado['usu_mae'] == $dados['mae']) {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Nome_Mae', 'Login Bem Sucedido')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);

            if ($tipo == 1) {
                header('Location: lista_de_usuarios.php');
            } else {
                header('Location: home.php');
            }
        } else {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Data_Nascimento', 'Erro de Login')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            session_destroy();
            header('Location: index.php');
        }
    }

    if (isset($dados['nascimento'])) {

        if ($resultado['usu_nascimento'] == $dados['nascimento']) {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Data_Nascimento', 'Login Bem Sucedido')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            if ($tipo == 1) {
                header('Location: lista_de_usuarios.php');
            } else {
                header('Location: home.php');
            }
        } else {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Data_Nascimento', 'Erro de Login')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            session_destroy();
            header('Location: index.php');
        }
    }



    if (isset($dados['celular'])) {

        if ($resultado['usu_celular'] == $dados['celular']) {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Celular', 'Login Bem Sucedido')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            if ($tipo == 1) {
                header('Location: lista_de_usuarios.php');
            } else {
                header('Location: home.php');
            }
        } else {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), 'Celular', 'Erro de Login')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            session_destroy();
            header('Location: index.php');
        }
    }



    if (isset($dados['ultimos'])) {
        $ultimos = substr($cpf, -3);
        if ($ultimos == $dados['ultimos']) {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), '3_Ultimos', 'Login Bem Sucedido')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            if ($tipo == 1) {
                header('Location: lista_de_usuarios.php');
            } else {
                header('Location: home.php');
            }
        } else {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), '3_Ultimos', 'Erro de Login')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            session_destroy();
            header('Location: index.php');
        }
    }

    if (isset($dados['primeiros'])) {
        $primeiros = substr($cpf, 0, 3);
        if ($primeiros == $dados['primeiros']) {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), '3_Primeiros', 'Login Bem Sucedido')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            if ($tipo == 1) {
                header('Location: lista_de_usuarios.php');
            } else {
                header('Location: home.php');
            }
        } else {
            $query_log = "INSERT INTO log (usu_id, log_data, log_meth, log_status) VALUES ('$usu', NOW(), '3_Primeiros', 'Erro de Login')";
            $sql_query = $mysqli->query($query_log) or die($mysqli->error);
            session_destroy();
            header('Location: index.php');
        }
    }
}

?>