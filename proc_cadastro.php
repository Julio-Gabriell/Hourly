<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Conexão com o banco de dados
    $mysqli = new mysqli("localhost", "root", "", "hourly_bd");

    // Coletando os dados do formulário
    $email = $_POST['email'];
    $senha1 = $_POST['senha1'];
    $senha2 = $_POST['senha2'];
    $nome = $_POST['nome'];

    // Verificando se as senhas são iguais
    if ($senha1 !== $senha2) {
        header("Location: index.php?p=12"); // Redireciona se as senhas forem diferentes
        exit();
    }

    // Sanitizando os dados
    $email = htmlentities(htmlspecialchars($email));
    $nome = htmlentities(htmlspecialchars($nome));
    $senha = htmlentities(htmlspecialchars($senha1));
    $senha = md5($senha); // Hash da senha

    // Preparando a consulta SQL
    $stmt = $mysqli->prepare("INSERT INTO usuarios (senha, email, nomeCompleto) VALUES (?, ?, ?)");

    if (!$stmt) {
        throw new Exception("Preparação da declaração falhou: " . $mysqli->error);
    }

    // Associando os parâmetros
    $stmt->bind_param('sss', $senha, $email, $nome);
    $stmt->execute();

    // Verificando se o cadastro foi bem-sucedido
    if ($stmt->affected_rows > 0) {
        // Iniciando a sessão com as mesmas variáveis que o código anterior usa
        $_SESSION['email'] = $email;
        $_SESSION['logado'] = TRUE;
        $_SESSION['cliente'] = $cargo;
        $_SESSION['nomeCompleto'] = $nome;
        $_SESSION['userID'] = $stmt->insert_id; // Pegando o ID gerado na inserção

        // Redireciona para a página logada
        header("Location: Login/home_logado.php");
        exit();
    } else {
        echo "Erro ao cadastrar dados";
    }

    // Fechando a declaração
    $stmt->close();
} catch (mysqli_sql_exception $e) {
    echo "Erro MySQL: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
} finally {
    // Fechando a conexão com o banco de dados
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
?>
