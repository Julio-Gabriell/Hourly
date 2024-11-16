<?php
// proc_demissaoFuncionarios.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';

// Conectando ao banco de dados
$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_POST['funcionario_id'])) {
    $funcionario_id = $_POST['funcionario_id'];

    // Seleciona o e-mail do funcionário antes de deletá-lo
    $sql = "SELECT email FROM funcionarios WHERE id = $funcionario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Verifica e define serviços como "inativo" se apenas este funcionário realizar o serviço
        $sql_servicos = "SELECT servico_id FROM servico_funcionario WHERE funcionario_id = $funcionario_id";
        $servicos = $conn->query($sql_servicos);

        while ($servico = $servicos->fetch_assoc()) {
            $servico_id = $servico['servico_id'];

            // Conta quantos funcionários estão associados ao serviço
            $countResult = $conn->query("SELECT COUNT(*) AS total FROM servico_funcionario WHERE servico_id = $servico_id");

            $countRow = $countResult->fetch_assoc();
            if ($countRow['total'] == 1) {
                // Se apenas um funcionário realiza o serviço, define o status como "inativo"
                $conn->query("UPDATE servico_funcionario SET status = 'inativo' WHERE servico_id = $servico_id AND funcionario_id = $funcionario_id");
            }
        }

        // Deletando o funcionário do banco de dados
        $sql_delete = "DELETE FROM funcionarios WHERE id = $funcionario_id";

        if ($conn->query($sql_delete) === TRUE) {
            // Iniciando o envio do e-mail após a demissão bem-sucedida
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
                $mail->addAddress($email); // E-mail do funcionário demitido

                // Conteúdo do e-mail
                $mail->isHTML(true);
                $mail->Subject = "Caro Profissional, informamos você foi desligado da empresa.";
                $mail->Body = "Obrigado por fazer parte do nosso sistema, até a próxima!";
                $mail->AltBody = "Você foi desligado da empresa.";

                // Enviando o e-mail
                $mail->send();
                echo 'E-mail enviado com sucesso.';

                // Redirecionar após o envio do e-mail
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
include_once "rodape.php"; // Se necessário
?>
