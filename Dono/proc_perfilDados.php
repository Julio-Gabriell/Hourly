<?php
session_start();
include_once "../conexao.php"; // Inclua o arquivo de conexão com o banco de dados

// Verifique se o usuário está logado e se o formulário foi enviado
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); // Redirecione para o login se o usuário não estiver logado
    exit;
}

$user_id = $_SESSION['userID'];
$nomeFale = $_POST['nomeFale'];
$emailFale = $_POST['emailFale'];

// Validação básica (opcional)
if (empty($nomeFale) || empty($emailFale)) {
    echo "Nome e e-mail são obrigatórios!";
    exit;
}

// Prepare e execute a consulta para atualizar os dados do usuário
$sql = "UPDATE usuarios SET nomeCompleto = ?, email = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $nomeFale, $emailFale, $user_id); // "ssi" representa o tipo de dados: string, string, integer
    if ($stmt->execute()) {
        // Atualize o nome na sessão, caso tenha sido alterado
        $_SESSION['nomeCompleto'] = $nomeFale;
        echo "Dados atualizados com sucesso!";
        header("Location: perfil.php"); // Redirecione para a página de perfil (ou a página que desejar)
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
