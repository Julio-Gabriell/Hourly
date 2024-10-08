<?php   
include_once 'session.php';
verificarLogin();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hourly</title>
    <link rel="stylesheet" href="../Css/global.css">
    <link rel="icon" type="image/x-icon" href="../Imgs/icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0 justify-content-center">
                <a href="home_barbeiro.php">
                    <img src="../Imgs/logo.png" alt=""></img>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="home_barbeiro.php" style=" color: #13292A;" class="nav-link px-2">Home</a></li>
                <li><a href="agenda.php" style=" color: #13292A;" class="nav-link px-2">Agendamentos</a></li>
                <li><a href="fale.php" style=" color: #13292A;" class="nav-link px-2">Fale</a></li>
                <li><a href="planos.php" style=" color: #13292A;" class="nav-link px-2">Planos</a></li>
            </ul>


            <div class="col-md-3 mb-2 mb-md-0 d-flex justify-content-center">
                <a href="perfil.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        style="color: #13292A;" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                </a>
            </div>
        </header>
    </div>
    <div class="container"></div>