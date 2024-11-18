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
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="home_dono.php">
            <img src="../Imgs/logo.png" alt="Logo">
        </a>

        <!-- Botão do menu sanduíche (para dispositivos menores) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo do menu -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Itens do menu -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <a href="home_logado.php" class="nav-link text-dark px-2">Home</a>
        <a href="catalogo.php" class="nav-link text-dark px-2">Agendamentos</a>
        <a href="fale.php" class="nav-link text-dark px-2">Fale</a>
        <a href="planos.php" class="nav-link text-dark px-2">Planos</a>
            </ul>

            <!-- Foto de perfil -->
            <a href="perfil.php" class="d-flex align-items-center">
                <?php
                $user_id = $_SESSION['userID'];
                $conn = new mysqli("localhost", "root", "", "fusca");

                $sql = "SELECT foto_perfil FROM usuarios WHERE id=$user_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $foto_perfil = $row['foto_perfil'];

                    if ($foto_perfil == null || $foto_perfil == "") {
                        $foto_perfil = "uploads/default.png"; 
                    }

                    echo '<img style="object-fit: cover; border-radius: 50%;" src="../' . $foto_perfil . '" alt="Foto de perfil" width="100" height="100">';
                } else {
                    echo "Erro ao carregar a foto de perfil.";
                }

                $conn->close();
                ?>
            </a>
        </div>
    </div>
</nav>