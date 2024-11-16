<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'fusca';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

try {
    // Captura os dados do formulário
    $email = $_POST['email'] ?? null;
    $senha1 = $_POST['senha1'] ?? null;
    $senha2 = $_POST['senha2'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $cpf = $_POST['cpf'] ?? null;

    // Validações
    if (empty($cpf) || !validarCPF($cpf)) {
        throw new Exception("CPF inválido.");
    }
    if (empty($senha1) || empty($senha2)) {
        throw new Exception("Os campos de senha são obrigatórios.");
    }
    if ($senha1 !== $senha2) {
        throw new Exception("As senhas não coincidem.");
    }
    if (empty($email) || empty($nome)) {
        throw new Exception("Preencha todos os campos obrigatórios.");
    }

    // Remover caracteres especiais do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Sanitizar dados para segurança
    $senhaHash = md5($senha1); // Usando MD5 para a senha
    $cpf = htmlentities($cpf);

    // Preparação da consulta SQL
    $stmt = $mysqli->prepare("INSERT INTO usuarios (cpf, senha, email, nomeCompleto) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Preparação da declaração falhou: " . $mysqli->error);
    }

    // Vincular parâmetros e executar a consulta
    $stmt->bind_param('ssss', $cpf, $senhaHash, $email, $nome);
    $stmt->execute();

    // Verificar se a operação foi bem-sucedida
    if ($stmt->affected_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;
        $_SESSION['nomeCompleto'] = $nome;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['userID'] = $stmt->insert_id;

        header("Location: Login/home_logado.php");
        exit();
    } else {
        echo "Erro ao cadastrar dados.";
    }

    $stmt->close();
} catch (mysqli_sql_exception $e) {
    echo "Erro MySQL: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
} finally {
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
?>
