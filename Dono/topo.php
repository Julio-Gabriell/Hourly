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
                <a href="home_dono.php">
                    <img src="../Imgs/logo.png" alt=""></img>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="home_dono.php" style=" color: #13292A;" class="nav-link px-2">Home</a></li>
                <li><a href="agenda.php" style=" color: #13292A;" class="nav-link px-2">Agendamentos</a></li>
                <li><a href="fale.php" style=" color: #13292A;" class="nav-link px-2">Fale</a></li>
                <li><a href="planos.php" style=" color: #13292A;" class="nav-link px-2">Planos</a></li>
                <li><a href="cadastro_servicos.php" style=" color: #13292A;" class="nav-link px-2">Cadastrar Serviços</a></li>
            </ul>


            <a href="perfil.php">
                <?php
                $user_id = $_SESSION['userID'];
                $conn = new mysqli("localhost", "root", "", "hourly_bd");

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
        </header>
    </div>
    <div class="container"></div>