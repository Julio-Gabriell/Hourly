<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hourly</title>
  <link rel="stylesheet" href="Css/global.css">
  <link rel="icon" type="image/x-icon" href="Imgs/icon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
      <div class="container-fluid">
        
        <a class="navbar-brand d-flex align-items-center" href="home_dono.php">
          <img src="Imgs/logo.png" alt="Logo">
        </a>

        <!-- (dispositivos menores) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php?p=2" style="color: #13292A;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?p=8" style="color: #13292A;">Agende</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?p=4" style="color: #13292A;">Fale</a>
            </li>
          </ul>

          <div class="d-flex">
            <a class="btn me-2" style="background-color: #78CEBA; color: #13292A;" href="index.php?p=5" role="button">
              Login
            </a>
            <a class="btn" style="background-color: #78CEBA; color: #13292A;" href="index.php?p=6" role="button">
              Cadastro
            </a>
          </div>
        </div>
      </div>
    </nav>