<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha364-1BmE4kWBq76iYhFldvKuhfTAU6auU6tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--CSS-->
  <link rel="stylesheet" href="../CSS/Cadastro.css">
  <title>Telecall - Cadastro</title>
</head>

<body>
  <div class="logo">
    <a href="../HTML/index.html"><img src="../../Assets/Logo/telecall-logo.png" alt="logoTelecall" /></a>
  </div>
  <div class="container">
    <form class="form" action="./Login.php" method="POST">
      <div class="row mb-3" align="center">
        <h3>Informações Cadastrais</h3>
      </div>
      <div class="row mb-3">
        <label for="Nome" class="col-sm-1 col-form-label">Nome</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Digite seu Nome" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Telefone" class="col-sm-1 col-form-label">Telefone</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Telefone" name="Telefone" placeholder="Digite seu Telefone Fixo" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Celular" class="col-sm-1 col-form-label">Celular</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Celular" name="Celular" placeholder="Digite seu Numero de Celular" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Email" class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" id="Email" name="Email" placeholder="Digite seu E-mail" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Senha" class="col-sm-1 col-form-label">Senha</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Senha" name="Senha" placeholder="Escolha sua Senha" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="SenhaConfirm" class="col-sm-1 col-form-label">Confirme a Senha</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="SenhaConfirm" name="SenhaConfirm" placeholder="Confirme sua Senha" />
        </div>
      </div>

      <div class="row mb-3" align="center">
        <h3>Informações Postais</h3>
      </div>
      <div class="row mb-3">
        <label for="cep" class="col-sm-1 col-form-label">CEP</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Endereco" class="col-sm-1 col-form-label">Endereço</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Endereco" name="Endereco" placeholder="Digite seu Endereço" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Numero" class="col-sm-1 col-form-label">Número</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Numero" name="Numero" placeholder="Digite o Número" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Complemento" class="col-sm-1 col-form-label">Compl.</label>
        <div class="col-sm-6">
          <input type="password" class="form-control" id="Complemento" name="Complemento" placeholder="Digite o Complemento" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="referencia" class="col-sm-1 col-form-label">Referência</label>
        <div class="col-sm-6">
          <textarea class="form-control" id="referencia" name="referencia" placeholder="Digite as referencias do local"></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <label for="Bairro" class="col-sm-1 col-form-label">Bairro</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Digite o Bairro" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Cidade" class="col-sm-1 col-form-label">Cidade</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Cidade" name="Cidade" placeholder="Digite a Cidade" />
        </div>
      </div>
      <div class="row mb-3">
        <label for="Estado" class="col-sm-1 col-form-label">Estado</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Digite o Estado" />
        </div>
      </div>


      <div class="buttonSubmit">
        <button type="submit" class="btn btn-primary botao">Entrar</button>
      </div>
      <div class="linkCadastro">
        <p>Já tem uma conta?<a href='./Login.php'> Clique aqui!</a></p>
      </div>
  </div>
</body>

</html>