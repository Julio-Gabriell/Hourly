<?php

//? Conecta com o banco de dados

$mysqli = new mysqli("localhost", "root", "", "hourly_bd");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$token = $_POST['token'];
$nova_senha = password_hash($_POST['nova_senha'], PASSWORD_DEFAULT);

//? Verifique o token e a validade

$sql = "SELECT email FROM usuarios WHERE token = ? AND expiracao_token > NOW()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  
    //? Atualize a senha no banco de dados

    $sql = "UPDATE usuarios SET senha = ?, token = NULL, expiracao_token = NULL WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nova_senha, $token);
    $stmt->execute();
    echo "Senha atualizada com sucesso.";
} else {
    echo "Token inválido ou expirado.";
}

$stmt->close();
$conn->close();
?>
