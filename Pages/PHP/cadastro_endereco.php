<?php
require_once('config.php');

require_once('lib/mail.php');

function limpar_telefone($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}


$erro = false;
if (count($_POST) > 0) {
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $referencia = $_POST['referencia'];
    $id = $_GET['id'];

    if (empty($cep)) {
        $erro = "Prencha o campo CEP";
    }

    if (empty($endereco)) {
        $erro = "Prencha o campo Endereço";
    }

    if (empty($bairro)) {
        $erro = "Prencha o campo Bairro";
    }

    if (empty($cidade)) {
        $erro = "Prencha o campo Cidade";
    }

    if (empty($estado)) {
        $erro = "Prencha o campo Estado";
    }

    if (empty($referencia)) {
        $erro = "Prencha o campo Referencia";
    }else if(strlen($referencia) > 255){
        $erro = "Maximo de caracteres atingido no campo referencia. Por favor, coloque em menos palavras.";
    }

    if ($erro) {
        echo "<p><b>$erro</b></p>";
    } else {
        $sql_code_end = "INSERT INTO endereco (end_cep, end_endereco, end_numero, end_complemento, end_referencia, end_bairro, end_cidade, end_estado, usu_id) VALUES ('$cep', '$endereco', '$numero','$complemento', '$referencia', '$bairro', '$cidade', '$estado', '$id')";
        
        $sucesso = $mysqli->query($sql_code_end) or die($mysqli->error);
        header("Location: index.php");
        unset($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Cadastro.css">
    <title>Telecall - Cadastro de Endereço</title>
</head>

<body>
    <div class="logo">
        <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro">
    </div>
    <form method="POST" action="">
        <div>
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" placeholder="21212-121" />
        </div>
        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" placeholder="Digite o Endereço" />
        </div>
        <div>
            <label for="numero">Número</label>
            <input type="text" name="numero" id="numero" placeholder="Digite o Número"/>
        </div>
        <div>
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" placeholder="Digite o Complemento" />
        </div>
        <div>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" placeholder="Digite o Bairro" />
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" placeholder="Digite o Cidade" />
        </div>
        <div>
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" placeholder="Digite o Estado" />
        </div>
        <div>
            <label for="referencia">Referência:</label>
            <textarea name="referencia" id="referencia" placeholder="Digite uma Referência"></textarea>
        </div>
        <div>
            <input type="submit" name="submit" id="submit" value="Enviar"/>
        </div>
    </form>
</body>

</html>