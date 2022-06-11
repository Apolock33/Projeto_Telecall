<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Verificação de 2 Fatores!</h1>
    <h3>Apenas por segurança, nos confirme que é você mesmo!</h3>

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
            echo "<form method='POST' action=''>
                    <div>
                        <label for='mae'>Digite o Nome de sua Mãe:</label><br/><br/>
                        <input type='text' name='mae' id='mae' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' />
                    </div>
                </form>";
            break;
        case 2:
            echo "<form method='POST' action=''>
                    <div>
                        <label for='celular'>Digite o seu Telefone Celular:</label><br/><br/>
                        <input type='text' name='celular' id='celular' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' />
                    </div>
                </form>";
            break;
        case 3:
            echo "<form method='POST' action=''>
                    <div>
                        <label for='nascimento'>Digite sua Data de Nascimento:</label><br/><br/>
                        <input type='date' name='nascimento' id='nascimento' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' />   
                    </div>
                </form>";
            break;
        case 4:
            echo "<form method='POST' action=''>
                    <div>
                        <label for='ultimos'>Digite os 3 Últimos Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='ultimos' id='ultimos' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' />
                    </div>
                </form>";
            break;
        case 5:
            echo "<form method='POST' action=''>
                    <div>
                        <label for='primeiros'>Digite os 3 Primeiros Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='primeiros' id='primeiros' /><br/><br/>
                        <input type='submit' value='Autenticar' name='btn' />
                    </div>
                </form>";
            break;
    }
    ?>
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
            
        }else{
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