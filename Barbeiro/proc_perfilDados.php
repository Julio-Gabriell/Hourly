<?php
session_start();
include_once "../conexao.php";

$user_id = $_SESSION['userID'];
$nomeFale = $_POST['nomeFale'];
$emailFale = $_POST['emailFale'];

if (empty($nomeFale) || empty($emailFale)) {
    echo "Nome e e-mail são obrigatórios!";
    exit;
}

$sql = "UPDATE usuarios SET nomeCompleto = ?, email = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $nomeFale, $emailFale, $user_id);
    if ($stmt->execute()) {
        $_SESSION['nomeCompleto'] = $nomeFale;
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