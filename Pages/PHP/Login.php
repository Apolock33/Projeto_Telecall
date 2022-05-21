<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha364-1BmE4kWBq76iYhFldvKuhfTAU6auU6tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="../CSS/login.css" media="screen">
  <title>Telecall - LogIn</title>
</head>

<body>
  <header class="logo-telecal">
    <a href="../HTML/index.html"><img src="../../Assets/Logo/telecall-logo.png" /></a>
  </header>
  <div class="container">
    <form class="form" action="" method="POST"> 
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Digite seu E-mail"/>
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputPassword" class="col-sm-1 col-form-label">Senha</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="inputPassword" placeholder="Digite sua Senha" />
        </div>
      </div>
      <div class="buttonSubmit">
        <button type="submit" class="btn btn-primary">Entrar</button>
      </div>
      <div class="linkLogin">
        <p class="linkLoginp">Ainda não tem uma conta?<a href='./Cadastro.php'> Clique aqui!</a></p>
      </div>
    </form>
  </div>
</body>

</html>