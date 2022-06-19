<?php
require_once('config.php');
if (!isset($_SESSION)) {
  session_start();
  $tipo = $_SESSION['admin'];
  $id = $_SESSION['usuario'];
  $tipo = $_SESSION['admin'];
  $nome = $_SESSION['nome'];
  $mae = $_SESSION['mae'];
  $celular = $_SESSION['celular'];
  $nascimento = $_SESSION['nascimento'];
  $cpf = $_SESSION['cpf'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="homecss.css" />
  <title>Telecall - Home</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img class="navbar-brand" src="../../Assets/Logo/telecall-logo.png" alt="Logo" width='300'></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../Pagina_Perfil/index.html">Perfil</a>
            </li>

            <?php if (isset($_SESSION)) {
              echo "<li class='nav-item'>
                            <a class='nav-link' href='session_drop.php'>Sair</a>
                        </li>";
            } else {
              echo "<li class='nav-item'>
                            <a class='nav-link' href='./index.php'>Login</a>
                        </li>";
            } ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <section class="container-fluid capa">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="https://media-cdn.tripadvisor.com/media/photo-s/15/a4/9b/77/legacy-hotel-at-img-academy.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Somos a Sua Escolha Inteligente</h1>
        <p class="lead">A Telecall é uma operadora regulada pela ANATEL (Licenças SCM e STFC), detentora de uma rede de fibra própria, de alta capacidade, oferecendo aos seus clientes uma nova experiência de telefonia e Internet empresarial, com o mais alto padrão de qualidade, velocidade e disponibilidade. Soluções que contam com uma série de serviços de valores adicionados, gerando aos clientes maior produtividade, dinamismo e efetividade nas operações.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Conheça Nosos Serviços</button>
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid sobre">
    <div class="px-4 py-5 my-5 text-center">
      <img class="d-block mx-auto mb-4" src="../../Assets/Logo/logo icone.png" alt="" width="100">
      <h1 class="display-5 fw-bold">Serviços</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Garanta os melhores serviços e custos otimizados para sua empresa, com toda mobilidade e segurança que só a Telecall oferece para você no mercado.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Confira Abaixo</button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">Já tem um desejo específico? Fale conosco!</button>
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid servicos">
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('../../Assets/Imgs/img5.png'); background-repeat: no-repeat; background-size:cover;">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold ">Internet</h2>
            <ul class="d-flex list-unstyled mt-auto">

              <li class="d-flex align-items-center me-3">
                <svg class="bi me-2" width="1em" height="1em">
                  <use xlink:href="#geo-fill"></use>
                </svg>
                <small>Telecall - Internet</small>
              </li>
              <li class="d-flex align-items-center">

                <small>3d</small>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('../../Assets/Imgs/img4.png'); background-repeat: no-repeat; background-size:cover;">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Telefonia
            </h2>
            <ul class="d-flex list-unstyled mt-auto">

              <li class="d-flex align-items-center me-3">
                <svg class="bi me-2" width="1em" height="1em">
                  <use xlink:href="#geo-fill"></use>
                </svg>
                <small>Telecall - Telefonia</small>
              </li>
              <li class="d-flex align-items-center">
                <svg class="bi me-2" width="1em" height="1em">
                  <use xlink:href="#calendar3"></use>
                </svg>
                <small>4d</small>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('../../Assets/Imgs/img3.png'); background-repeat: no-repeat; background-size:cover;">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Banda Larga</h2>
            <ul class="d-flex list-unstyled mt-auto">
              <li class="d-flex align-items-center me-3">
                <svg class="bi me-2" width="1em" height="1em">
                  <use xlink:href="#geo-fill"></use>
                </svg>
                <small>Telecall - Banda Larga</small>
              </li>
              <li class="d-flex align-items-center">
                <svg class="bi me-2" width="1em" height="1em">
                  <use xlink:href="#calendar3"></use>
                </svg>
                <small>5d</small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div align="center">
      <h1>Somos Uma Empresa Global!</h1>
    </div>
    <div class="container-fluid imgmapa justify-content-center align-items-center">
      <img class="d-block mx-auto mb-4" src="https://www.telecall.com/media/images/home2021/MapaRJ.png" alt="" width="900">
    </div>
  </section>

  <main>
    <div class="container-fluid">
      <div class="">
        <h1>Experiemnte Nosso Serviço de Armazenamento Empresarial em Nuvem</h1>
      </div>
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Plano Iniciante</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">R$40<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>2 usuario incluido</li>
                <li>2 GB de armazenamento</li>
                <li>Suporte por Email</li>
                <li>Acesso ao Suporte ao Cliente</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-outline-primary">Registre-se!</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Plano Profissional</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">R$150<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>10 usuarios incluidos</li>
                <li>10 GB de armazenamento</li>
                <li>Suporte por Email</li>
                <li>Acesso ao Suporte ao Cliente</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-primary">Começe a Utilizar!</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3 text-white bg-primary border-primary">
              <h4 class="my-0 fw-normal">Plano Empresarial</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">R$300<small class="text-muted fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>50 usuario incluido</li>
                <li>50 GB de armazenamento</li>
                <li>Suporte por Email</li>
                <li>Acesso ao Suporte ao Cliente</li>
              </ul>
              <button type="button" class="w-100 btn btn-lg btn-primary">Dê o Próximo Passo!</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <main>
      <div class="container-fluid">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item">
              <img src="./imagem/imagem1.png" alt="">
              <div class="container">

              </div>
            </div>
            <div class="carousel-item">
              <img src="./imagem/imagem1.png" alt="">
              <div class="container">

              </div>
            </div>
            <div class="carousel-item active">
              <img src="./imagem/imagem1.png" alt="">

              <div class="container">

              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">

            </span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">

            </span>
          </button>
        </div>
      </div>

      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top bg-white >
    <p class=" col-md-4 mb-0 text-muted">© 2021 Company, Inc</p>

        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>

        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>