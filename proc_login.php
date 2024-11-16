<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "fusca");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Sanitização dos dados
    $email = $mysqli->real_escape_string($email);
    $senha = $mysqli->real_escape_string($senha);

    // Hash da senha com MD5
    $senha_md5 = md5($senha);

    // Consulta SQL para buscar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifica se a senha enviada é igual à armazenada no banco
        if ($senha_md5 === $row['senha']) {
            // Armazena dados do usuário na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nomeCompleto'] = $row['nomeCompleto'];
            $_SESSION['userID'] = $row['id'];
            $_SESSION['logado'] = TRUE;
            $_SESSION['cargo'] = $row['cargo'];
            $_SESSION['cpf'] = $row['cpf']; // Armazena o CPF do usuário na sessão

            // Redireciona para a página correspondente ao cargo
            if ($row['cargo'] === 'cliente') {
                header("Location: Login/home_logado.php");
            } elseif ($row['cargo'] === 'funcionario') {
                header("Location: Barbeiro/home_barbeiro.php");
            } elseif ($row['cargo'] === 'dono') {
                header("Location: Dono/home_dono.php");
            }
            exit();
        } else {
            // Se a senha não for válida, redireciona para a página de erro
            header("Location: index.php?p=10");
        }
    } else {
        // Se o email não existir, redireciona para a página de erro
        header("Location: index.php?p=11");
    }
}

$mysqli->close();
?>
