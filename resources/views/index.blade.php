<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inmobiliaria REG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../css/app.css" rel="stylesheet" type="text/css" >
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <section class="main_container">
        @yield('content')
    </section>

    <footer class="bg-secondary text-center text-lg-start text-white" data-bs-theme="dark">
      <!-- Grid container -->
      <div class="container p-4">
        <!--Grid row-->
        <div class="row my-4">
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
  
            <div class="rounded-circle bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">
              <img src="https://mdbootstrap.com/img/Photos/new-templates/animal-shelter/logo.png" height="70" alt=""
                   loading="lazy" />
            </div>
  
            <p class="text-center">Homless animal shelter The budgetary unit of the Capital City of Warsaw</p>
  
            <ul class="list-unstyled d-flex flex-row justify-content-center">
              <li>
                <a class="text-white px-2" href="#!">
                  <i class="fab fa-facebook-square"></i>
                </a>
              </li>
              <li>
                <a class="text-white px-2" href="#!">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li>
                <a class="text-white ps-2" href="#!">
                  <i class="fab fa-youtube"></i>
                </a>
              </li>
            </ul>
  
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-4">Animals</h5>
  
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>When your pet is missing</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Recently found</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>How to adopt?</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Pets for adoption</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Material gifts</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Help with walks</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Volunteer activities</a>
              </li>
            </ul>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-4">Animals</h5>
  
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>General information</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>About the shelter</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Statistic data</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Job</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Tenders</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="text-white"><i class="fas fa-paw pe-3"></i>Contact</a>
              </li>
            </ul>
          </div>
          <!--Grid column-->
  
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
            <h5 class="text-uppercase mb-4">Contact</h5>
  
            <ul class="list-unstyled">
              <li>
                <p><i class="fas fa-map-marker-alt pe-2"></i>Warsaw, 57 Street, Poland</p>
              </li>
              <li>
                <p><i class="fas fa-phone pe-2"></i>+ 01 234 567 89</p>
              </li>
              <li>
                <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@example.com</p>
              </li>
            </ul>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Grid container -->
  
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>