<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'PHPMailer_master/src/Exception.php';
 require 'PHPMailer_master/src/PHPMailer.php';
 require 'PHPMailer_master/src/SMTP.php';

//? Conecta com o banco de dados 

$con = new mysqli("localhost", "root", "", "hourly_bd");

if ($con->connect_error) {
  die("Falha na conexão: " . $mysqli->connect_error);
}

$email = $_POST['email'];

//? Verifica se o e-mail existe no banco de dados

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(50));
    $expiracao = date("Y-m-d H:i:s", strtotime('+1 hour'));

    //? Atualize o token e a data de expiração no banco de dados

    $sql = "UPDATE usuarios SET token = ?, expiracao_token = ? WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $token, $expiracao, $email);
    $stmt->execute();

    //? Crie o link de recuperação de senha

    $link = "http://localhost/hourly/index.php?p=13?token=$token";

    //? Configuração e envio do e-mail

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP do seu serviço de e-mail
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username   = 'paespintoj@gmail.com'; // Seu e-mail
        $mail->Password   = 'Judame29@'; // Sua senha
      //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 587;

        $mail->setFrom('paespintoj@gmail.com', 'Hourly');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Recuperação de Senha';
        $mail->Body    = "Clique no link para redefinir sua senha: <a href='$link'>$link</a>";
        $mail->AltBody = "Clique no link para redefinir sua senha: $link";

        $mail->send();
        echo 'E-mail de recuperação enviado com sucesso.';
    } catch (Exception $e) {
        echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "E-mail não encontrado.";
}

$stmt->close();
$con->close();
?>
