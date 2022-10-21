<?php
require_once('config.php'); //Todos os require_once de todo o codigo começam dessa forma para serem utilizados de forma global por toda a pagina

$erro = false;
if (count($_POST) > 0) { //nesta linha, faz-se a contagem de posts, se essa contagem for maior que 0 ele atribui cada post a sua respectiva variavel
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $referencia = $_POST['referencia'];
    $id = $_GET['id'];

    //A partir daqui, configuro algumas validações para o formulario. Da linha 105 ate 128 ele indica que, caso o campo não seja preenchido, o PHP vai apresentar um erro no Front
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
    } else if (strlen($referencia) > 255) {
        $erro = "Maximo de caracteres atingido no campo referencia. Por favor, coloque em menos palavras.";
    }
//A partir daqui, ele verifica se há erros ao enviar informações pelo Input
    if ($erro) {//caso seja true, ele apresenta o erro
        echo "<p><b>$erro</b></p>";
    } else {//caso seja false, ele define o comando sql a ser utilizado no envio de dados e define uma variavel que, caso realize a query(true) ele insere dados no Banco, caso seja false ele faz o script parar de rodar e apresenta o erro que ocorreu
        $sql_code_end = "INSERT INTO endereco (end_cep, end_endereco, end_numero, end_complemento, end_referencia, end_bairro, end_cidade, end_estado, usu_id) VALUES ('$cep', '$endereco', '$numero','$complemento', '$referencia', '$bairro', '$cidade', '$estado', '$id')";
        $sucesso = $mysqli->query($sql_code_end) or die($mysqli->error);
        header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet" />
    <title>Telecall - Cadastro de Endereço</title>
</head>

<body>
    <div class="logo" align="center"><br /><br />
        <img src="../../Assets/Logo/telecall-logo.png" alt="logoCadastro" width="300">
    </div>
    <form method="POST" action="" align="center">
        <div><br /><br />
            <h2>Informações Postais</h2>
            <br />
        </div>
        <div align="center">
            <label for="cep" class="h5 mb-3 fw-normal">CEP:</label><br />
            <input type="text" name="cep" id="cep" placeholder="21212-121" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="endereco" class="h5 mb-3 fw-normal">Endereço:</label><br />
            <input type="text" name="endereco" id="endereco" placeholder="Digite o Endereço" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="numero" class="h5 mb-3 fw-normal">Número</label><br />
            <input type="text" name="numero" id="numero" placeholder="Digite o Número" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="complemento" class="h5 mb-3 fw-normal">Complemento:</label><br />
            <input type="text" name="complemento" id="complemento" placeholder="Digite o Complemento" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="bairro" class="h5 mb-3 fw-normal">Bairro:</label><br />
            <input type="text" name="bairro" id="bairro" placeholder="Digite o Bairro" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="cidade" class="h5 mb-3 fw-normal">Cidade:</label><br />
            <input type="text" name="cidade" id="cidade" placeholder="Digite o Cidade" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="estado" class="h5 mb-3 fw-normal">Estado:</label><br />
            <input type="text" name="estado" id="estado" placeholder="Digite o Estado" class="form-control w-25" />
        </div><br />
        <div align="center">
            <label for="referencia" class="h5 mb-3 fw-normal">Referência:</label><br />
            <textarea name="referencia" id="referencia" placeholder="Digite uma Referência" class="form-control w-25"></textarea>
        </div><br />
        <div align="center">
            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Enviar" />
        </div><br /><br />
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>

</html>