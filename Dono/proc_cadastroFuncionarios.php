<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';

session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "fusca");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Busca o nome e o ID da barbearia
$nome_barbearia = "Nome Padrão"; // Defina um nome padrão caso não seja encontrado
$barbearia_id = null; // Inicializa a variável para o ID da barbearia

$sql = "SELECT id, nome FROM barbearias LIMIT 1"; // Busca o nome e o ID da primeira barbearia
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_barbearia = $row['nome']; // Define o nome da barbearia
    $barbearia_id = $row['id']; // Recupera o ID da barbearia
    $_SESSION['nome'] = $nome_barbearia;
    $_SESSION['barbearia_id'] = $barbearia_id; // Armazena o ID da barbearia na sessão
}

// Verifica se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];

    // Configuração para a foto de perfil
    $imagemCaminho = '../uploads/default.png'; // Caminho padrão caso não seja enviado

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['profile_picture']['tmp_name'];
        $imagemNome = $_FILES['profile_picture']['name'];

        // Definir o diretório de upload e mover o arquivo para lá
        $uploadDir = '../uploads/';
        
        // Verifica se o diretório existe, se não, cria-o
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Movendo o arquivo para o diretório de destino
        $imagemCaminho = $uploadDir . basename($imagemNome);
        if (!move_uploaded_file($imagemTmp, $imagemCaminho)) {
            echo "Erro ao carregar a foto de perfil.";
            exit;
        }
    }

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO funcionarios (nome, email, funcao, foto_perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $nome, $email, $funcao, $imagemCaminho);

    if ($stmt->execute()) {
        // Iniciando o envio do e-mail
        $mail = new PHPMailer(true);

        try {
            // Configuração do SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'paespintoj@gmail.com';
            $mail->Password = 'iogmgrtltrdrtwqo'; // Use variáveis de ambiente em produção para maior segurança
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Definindo remetente e destinatário
            $mail->setFrom('paespintoj@gmail.com', 'Hourly');
            $mail->addAddress($email);

            // Inclui o ID da barbearia no link
            $link = "http://localhost/hourly/Login/aceitar_contrato.php?barbearia_id=" . $barbearia_id; // Definir link de aceitação de contrato

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = "Barbearia $nome_barbearia te Convida";
            $mail->Body = "
                <p>Clique no botão abaixo e insira o código da barbearia:</p>
                <a href='$link' style='
                  display: inline-block;
                  padding: 10px 20px;
                  font-size: 16px;
                  color: #13292A;
                  background-color: #78CEBA;
                  text-align: center;
                  text-decoration: none;
                  border-radius: 5px;
                  margin-top: 10px;
                '>Aceitar Contrato</a>
                <br><br>
                <p>Hourly© 2024 Company, Inc</p>
            ";
            $mail->AltBody = "Clique no link para aceitar ser contrato: $link";

            $mail->send();
            echo 'E-mail enviado com sucesso.';

            // Redirecionar ou exibir uma mensagem de sucesso
            header("Location: home_dono.php");
            exit;

        } catch (Exception $e) {
            echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
        }

    } else {
        echo "Erro ao cadastrar funcionário: " . $stmt->error;
    }

    // Fechando o statement
    $stmt->close();
} else {
    echo "Método de requisição inválido.";
}

// Fechando a conexão
$conn->close();
?>
