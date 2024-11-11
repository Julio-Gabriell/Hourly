<?php
// Verifica se 'barbearia_id' foi passado via GET e converte para inteiro
if (isset($_GET['barbearia_id'])) {
    $barbearia_id = intval($_GET['barbearia_id']); // Converte para inteiro
}

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "hourly_bd");

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o código da barbearia enviado pelo formulário
    $codigo_barbearia = $_POST['codigo_barbeariaForm'];

    // Prepara a consulta para evitar SQL injection
    $sql = "SELECT * FROM barbearias WHERE codigo_barbearia = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $codigo_barbearia);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o código da barbearia estiver correto
        $barbearia = $result->fetch_assoc();

        // Obtém o ID do usuário logado na sessão
        session_start();
        $usuario_id = $_SESSION['usuario_id'];

        // Atualiza o cargo do usuário para "funcionário"
        $sql_update = "UPDATE usuarios SET cargo = 'funcionario' WHERE id = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("i", $usuario_id);
        $stmt_update->execute();

        // Redireciona para a página home do barbeiro
        header("Location: ../Barbeiro/home_barbeiro.php");
    } else {
        // Caso o código não seja encontrado
        echo "Código de barbearia não encontrado.";
    }

    // Fecha as declarações
    $stmt->close();
    if (isset($stmt_update)) {
        $stmt_update->close();
    }
} else {
    echo "Erro: método de requisição inválido.";
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
