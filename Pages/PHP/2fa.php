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
    function gerador_numerico($numero){
        return $numero;
    }    
    switch (gerador_numerico(rand(1,5))) {
        case 1:
            echo
            "<div>
                <label for='celular'>Digite Os 3 primeros Digitos do Seu CPF:</label><br/><br/>
                <input type='text' name='celular' id='celular' /><br/><br/>
                <input type='submit' value='Submeter' />
            </div>";
            break;
        case 2:
            echo
            "<div>
                <label for='celular'>Digite os 3 Uultimos Digitos do Seu CPF:</label><br/><br/>
                <input type='text' name='celular' id='celular' /><br/><br/>
                <input type='submit' value='Submeter' />
            </div>";
            break;
        case 3:
            echo
            "<div>
                <label for='celular'>Digite seu Celular:</label><br/><br/>
                <input type='text' name='celular' id='celular' /><br/><br/>  
                <input type='submit' value='Submeter' />
            </div>";
            break;
        case 4:
            echo
            "<form>
                <div>
                    <label for='celular'>Digite o Nome de sua Mãe:</label><br/><br/>
                    <input type='text' name='celular' id='celular' /><br/><br/>
                    <input type='submit' value='Submeter' />
                </div>
            </form>";
            break;
        case 5:
            echo
            "<div>
                <label for='celular'>Digite sua Data de Dascimento:</label><br/><br/>   
                <input type='text' name='celular' id='celular' /><br/><br/>
                <input type='submit' value='Submeter' />
            </div>";
            break;
        }
    ?>
</body>

</html>