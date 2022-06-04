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

    $mae = $_POST['mae'];
    $celular = $_POST['celular'];
    $nascimento = $_POST['nascimento'];
    $ultimos = $_POST['ultimos'];
    $primeiros = $_POST['primeiros'];
    
    $sql_code = "SELECT * FROM usuario where usu_id = '$id'";

    function gerador_numerico($numero)
    {
        return $numero;
    }

    switch (gerador_numerico(rand(1, 5))) {
        case 1:
            echo "<form>
                    <div>
                        <label for='usu_mae'>Digite o Nome de sua Mãe:</label><br/><br/>
                        <input type='text' name='usu_mae' id='usu_mae' /><br/><br/>
                        <input type='submit' value='Autenticar' />
                    </div>
                </form>";
            break;
        case 2:
            echo "<form>
                    <div>
                        <label for='celular'>Digite o seu Telefone Celular:</label><br/><br/>
                        <input type='text' name='celular' id='celular' /><br/><br/>
                        <input type='submit' value='Autenticar' />
                    </div>
                </form>";
            break;
        case 3:
            echo "<form>
                    <div>
                        <label for='nascimento'>Digite sua Data de Nascimento:</label><br/><br/>
                        <input type='text' name='nascimento' id='nascimento' /><br/><br/>
                        <input type='submit' value='Autenticar' />
                    </div>
                </form>";
            break;
        case 4:
            echo "<form>
                    <div>
                        <label for='ultimos'>Digite os 3 Últimos Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='ultimos' id='ultimos' /><br/><br/>
                        <input type='submit' value='Autenticar' />
                    </div>
                </form>";
            break;
        case 5:
            echo "<form>
                    <div>
                        <label for='primeiros'>Digite os 3 Primeiros Digitos do Seu CPF:</label><br/><br/>
                        <input type='text' name='primeiros' id='primeiros' /><br/><br/>
                        <input type='submit' value='Autenticar' />
                    </div>
                </form>";
            break;
    }
    ?>
</body>

</html>