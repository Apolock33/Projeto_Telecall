<?php

?>
<!DOCTYPE html>
<html lang="en">

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
            <input type="text" name="cep" id="cep" value="21212-121" />
        </div>
        <div>
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="Digite o Endereço" />
        </div>
        <div>
            <label for="numero">Numero:</label>
            <input type="text" name="numero" id="numero" value="Digite o Numero" />
        </div>
        <div>
            <label for="sem_numero">Não Possui Número:</label>
            <input type="checkbox" name="sem_numero" id="sem_numero" />
        </div>
        <div>
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" value="Digite o Complemento" />
        </div>
        <div>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" value="Digite o Bairro" />
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" value="Digite o Cidade" />
        </div>
        <div>
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" value="Digite o Estado" />
        </div>
        <div>
            <label for="referencia">Referência:</label>
            <textarea name="referencia" id="referencia" value="21212-121" value="Digite uma Referência"></textarea>
        </div>
    </form>
</body>

</html>