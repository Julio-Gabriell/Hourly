<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';


$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_POST['funcionario_id'])) {
    $funcionario_id = $_POST['funcionario_id'];

    $sql = "SELECT email FROM funcionarios WHERE id = $funcionario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        $sql_servicos = "SELECT servico_id FROM servico_funcionario WHERE funcionario_id = $funcionario_id";
        $servicos = $conn->query($sql_servicos);

        while ($servico = $servicos->fetch_assoc()) {
            $servico_id = $servico['servico_id'];

            $countResult = $conn->query("SELECT COUNT(*) AS total FROM servico_funcionario WHERE servico_id = $servico_id");

            $countRow = $countResult->fetch_assoc();
            if ($countRow['total'] == 1) {
                $conn->query("UPDATE servico_funcionario SET status = 'inativo' WHERE servico_id = $servico_id AND funcionario_id = $funcionario_id");
            }
        }

        $sql_delete = "DELETE FROM funcionarios WHERE id = $funcionario_id";

        if ($conn->query($sql_delete) === TRUE) {
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

                $mail->isHTML(true);
                $mail->Subject = "Caro Profissional, informamos você foi desligado da empresa.";
                $mail->Body = "Obrigado por fazer parte do nosso sistema, até a próxima!";
                $mail->AltBody = "Você foi desligado da empresa.";

                $mail->send();
                echo 'E-mail enviado com sucesso.';


                header("Location: home_dono.php");
                exit;

            } catch (Exception $e) {
                echo "O e-mail não pôde ser enviado. Erro do PHPMailer: {$mail->ErrorInfo}";
            }

        } else {
            echo "Erro ao demitir o funcionário: " . $conn->error;
        }

    } else {
        echo "Funcionário não encontrado.";
    }
}

$conn->close();
include_once "rodape.php"; 
?>