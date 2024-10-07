<?php 

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o diretório de upload existe e crie-o se necessário
    $target_dir = __DIR__ . "/../uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Cria o diretório, se ele não existir
    }

    // Diretório de destino completo
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

    // Verificar se o upload foi bem-sucedido e o arquivo foi carregado corretamente
    if (!empty($_FILES["profile_picture"]["tmp_name"]) && move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        
        // Caminho relativo para armazenar no banco de dados
        $profile_picture_path = "uploads/" . basename($_FILES["profile_picture"]["name"]);

        // ID do usuário (você precisaria ter o ID do usuário em sessão ou de outra forma)
        $user_id = $_SESSION['userID']; // Supondo que você tenha o ID do usuário na sessão

        // Conexão com o banco de dados
        $conn = new mysqli("localhost", "root", "", "hourly_bd");

        // Verificar a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Atualizar o caminho da foto no banco de dados
        $sql = "UPDATE usuarios SET foto_perfil='$profile_picture_path' WHERE id=$user_id";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar após o sucesso
            header("Location: home_logado.php");
            exit; // Pare a execução do script
        } else {
            echo "Erro ao atualizar a foto de perfil: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}
?>