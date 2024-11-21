<?php
session_start();
require_once '../conexao.php';

$usuario_id = $_SESSION['userID'];
$barbearia_id = $_POST['barbearia_id'];

// Verifica se já está favoritado
$sql = "SELECT * FROM favoritos WHERE usuario_id = ? AND barbearia_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $barbearia_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Se já está favoritado, remove
    $sql = "DELETE FROM favoritos WHERE usuario_id = ? AND barbearia_id = ?";
} else {
    // Caso contrário, adiciona
    $sql = "INSERT INTO favoritos (usuario_id, barbearia_id) VALUES (?, ?)";
}

$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $barbearia_id);
$stmt->execute();

header("Location: catalogo.php");
exit();
?>
