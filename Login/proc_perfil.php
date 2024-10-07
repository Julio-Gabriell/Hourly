<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Diretório de destino
    $target_dir = __DIR__ . "/../uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

    // Verificar se o upload foi bem-sucedido
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        echo "O arquivo foi enviado com sucesso.";

        // Caminho relativo para armazenar no banco de dados
        $profile_picture_path = "uploads/" . basename($_FILES["profile_picture"]["name"]);

        // ID do usuário (você precisaria ter o ID do usuário em sessão ou de outra forma)
        $user_id = $_SESSION['userID']; // Supondo que você tenha o ID do usuário na sessão

        // Conexão com o banco de dados
        $conn = new mysqli("localhost", "root", "", "hourly_bd");

        // Atualizar o caminho da foto no banco de dados
        $sql = "UPDATE usuarios SET foto_perfil='$profile_picture_path' WHERE id=$user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Foto de perfil atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a foto de perfil: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}
?>
