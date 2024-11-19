<?php
// Verifica se 'barbearia_id' foi passado via GET e converte para inteiro
if (isset($_GET['barbearia_id'])) {
    $barbearia_id = intval($_GET['barbearia_id']); // Converte para inteiro
}

$_SESSION['barbearia_id'] = $barbearia_id;

$mysqli = new mysqli("localhost", "root", "", "fusca");

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigo_barbearia = $_POST['codigo_barbeariaForm'];

    $sql = "SELECT * FROM barbearias WHERE codigo_barbearia = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $codigo_barbearia);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $barbearia = $result->fetch_assoc();

        session_start();
        $usuario_id = $_SESSION['usuario_id'];

        $sql_update = "UPDATE usuarios SET cargo = 'funcionario' WHERE id = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("i", $usuario_id);
        $stmt_update->execute();

        header("Location: ../Barbeiro/home_barbeiro.php");
    } else {
        echo "Código de barbearia não encontrado.";
    }

    $stmt->close();
    if (isset($stmt_update)) {
        $stmt_update->close();
    }
} else {
    echo "Erro: método de requisição inválido.";
}

$mysqli->close();
?>