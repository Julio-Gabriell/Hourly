<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fusca");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $email = $mysqli->real_escape_string($email);
    $senha = $mysqli->real_escape_string($senha);

    $senha_md5 = md5($senha);

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($senha_md5 === $row['senha']) {
            $_SESSION['email'] = $email;
            $_SESSION['nomeCompleto'] = $row['nomeCompleto'];
            $_SESSION['userID'] = $row['id'];
            $_SESSION['logado'] = TRUE;
            $_SESSION['cargo'] = $row['cargo'];
            $_SESSION['cpf'] = $row['cpf'];

            if ($row['cargo'] === 'cliente') {
                header("Location: Login/home_logado.php");
            } elseif ($row['cargo'] === 'funcionario') {
                header("Location: Barbeiro/home_barbeiro.php");
            } elseif ($row['cargo'] === 'dono') {
                header("Location: Dono/home_dono.php");
            }
            exit();
        } else {
            // página de erro senha
            header("Location: index.php?p=10");
        }
    } else {
        // página de erro email
        header("Location: index.php?p=11");
    }
}

$mysqli->close();
?>