<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';

session_start();

$nome_barbearia = $_SESSION['nome_barbearia'];

// Inclui a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "hourly_bd");

$funcionarios = [];

// Verifica se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];

    // Configuração para a foto de perfil
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['profile_picture']['tmp_name'];
        $imagemNome = $_FILES['profile_picture']['name'];

        // Definir o diretório de upload e mover o arquivo para lá
        $uploadDir = '../uploads/';
        $imagemCaminho = $uploadDir . basename($imagemNome);

        // Verifica se o diretório existe, se não, cria-o
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Movendo o arquivo para o diretório de destino
        if (!move_uploaded_file($imagemTmp, $imagemCaminho)) {
            echo "Erro ao carregar a foto de perfil.";
            exit;
        }
    } else {
        // Define um caminho padrão caso nenhuma imagem tenha sido enviada
        $imagemCaminho = '../uploads/default.png';
    }

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO funcionarios (nome, email, funcao, foto_perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $nome, $email, $funcao, $imagemCaminho);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'paespintoj@gmail.com'; 
            $mail->Password = 'iogmgrtltrdrtwqo'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('paespintoj@gmail.com', 'Hourly');
            $mail->addAddress($email);

            $link = "http://localhost/hourly/Login/aceitar_contrato.php"; // Definir link de redefinição de senha

            $mail->isHTML(true);
            $mail->Subject = 'Barbearia $nome_barbearia te Convida';
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
            echo 'E-mail de recuperação enviado com sucesso.';

        } catch (Exception $e) {
            echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
        }

        // Redirecionar ou exibir uma mensagem de sucesso
        header("Location: home_dono.php");
        exit;

    } else {
        echo "Erro ao cadastrar funcionário: " . $stmt->error;
    }

    // Fechando a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
