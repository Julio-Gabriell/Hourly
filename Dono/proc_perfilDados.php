<?php
session_start();
include_once "../conexao.php";


$user_id = $_SESSION['userID'];
$nomePerfil = $_POST['nomePerfil'];
$emaiPerfil = $_POST['emaiPerfil'];

if (empty($nomePerfil) || empty($emaiPerfil)) {
    echo "Nome e e-mail são obrigatórios!";
    exit;
}

$sql = "UPDATE usuarios SET nomeCompleto = ?, email = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $nomePerfil, $emaiPerfil, $user_id); // 
    if ($stmt->execute()) {
        // Atualize o nome na sessão, caso tenha sido alterado
        $_SESSION['nomeCompleto'] = $nomePerfil;
        echo "Dados atualizados com sucesso!";
        header("Location: perfil.php");
        exit;
    } else {
        echo "Erro ao atualizar os dados!";
    }
    $stmt->close();
} else {
    echo "Erro na preparação da consulta!";
}

$conn->close();
?>