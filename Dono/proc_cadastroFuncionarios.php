<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';

session_start();


$conn = new mysqli("localhost", "root", "", "fusca");


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$nome_barbearia = "Nome Padrão"; 
$barbearia_id = null; 

$sql = "SELECT id, nome FROM barbearias LIMIT 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_barbearia = $row['nome']; 
    $barbearia_id = $row['id'];
    $_SESSION['nome'] = $nome_barbearia;
    $_SESSION['barbearia_id'] = $barbearia_id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];


    $imagemCaminho = '../uploads/default.png';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['profile_picture']['tmp_name'];
        $imagemNome = $_FILES['profile_picture']['name'];

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

            // Inclui o ID da barbearia no link
            $link = "http://localhost/hourly/Login/aceitar_contrato.php?barbearia_id=" . $barbearia_id; // link de aceitação de contrato
            
            $mail->CharSet = 'UTF-8';
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

            header("Location: home_dono.php");
            exit;

        } catch (Exception $e) {
            echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
        }

    } else {
        echo "Erro ao cadastrar funcionário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>