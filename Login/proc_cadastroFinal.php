<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer_master/src/Exception.php';
require '../PHPMailer_master/src/PHPMailer.php';
require '../PHPMailer_master/src/SMTP.php';


$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start();

// Verifica se as variáveis de sessão estão definidas
if (!isset($_SESSION['nome_barbearia'], $_SESSION['cep_barbearia'], $_SESSION['num_barbearia'], $_SESSION['tel_barbearia'], $_SESSION['des_barbearia'], $_SESSION['dias_funcionamento'], $_SESSION['horarios_funcionamento'], $_SESSION['userID'])) {
    die("Erro: Informações insuficientes para cadastro da barbearia.");
}

$nome_barbearia = $_SESSION['nome_barbearia'];
$cep = $_SESSION['cep_barbearia'];
$numero = $_SESSION['num_barbearia'];
$telefone = $_SESSION['tel_barbearia'];
$descricao = $_SESSION['des_barbearia'];
$dias_funcionamento = $_SESSION['dias_funcionamento'];
$horarios_funcionamento = $_SESSION['horarios_funcionamento'];
$dono_id = $_SESSION['userID'];

// Função para buscar o CEP
function buscarCep($cep, $conn)
{
    $cep = preg_replace('/[^0-9]/', '', $cep);

    if (strlen($cep) != 8) {
        return null; // Retorna null se o CEP for inválido
    }

    $sql = "SELECT * FROM enderecos WHERE cep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cep);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $response = @file_get_contents($url);

    if (!$response) {
        return null; // Retorna null em caso de falha na API
    }

    $dadosCep = json_decode($response, true);

    if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
        return null; // Retorna null se o CEP não for encontrado
    }

    $sql = "INSERT INTO enderecos (cep, rua, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $cep, $dadosCep['logradouro'], $dadosCep['bairro'], $dadosCep['localidade'], $dadosCep['uf']);
    $stmt->execute();

    return $dadosCep;
}

// Busca o CEP
$dados = buscarCep($cep, $conn);

if (!$dados) {
    die("Erro: Não foi possível buscar o CEP.");
}

$rua = $dados['logradouro'];
$bairro = $dados['bairro'];
$cidade = $dados['localidade'];
$estado = $dados['uf'];

// Gera o código da barbearia
$codigo_barbearia = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

// Insere os dados da barbearia
$sqlBarbearia = "INSERT INTO barbearias (nome, cep, numero, descricao, dono_id, codigo_barbearia) VALUES (?, ?, ?, ?, ?, ?)";
$stmtBarbearia = $conn->prepare($sqlBarbearia);
$stmtBarbearia->bind_param('ssssss', $nome_barbearia, $cep, $numero, $descricao, $dono_id, $codigo_barbearia);

if ($stmtBarbearia->execute()) {
    $barbearia_id = $stmtBarbearia->insert_id;
    $_SESSION['barbearia_id'] = $barbearia_id;

    // Insere o telefone
    $sqlTelefone = "INSERT INTO telefones_barbearia (barbearia_id, telefone) VALUES (?, ?)";
    $stmtTelefone = $conn->prepare($sqlTelefone);
    $stmtTelefone->bind_param('is', $barbearia_id, $telefone);
    $stmtTelefone->execute();

    // Insere os dias de funcionamento
    $sqlDias = "INSERT INTO dias_funcionamento (barbearia_id, dia_semana) VALUES (?, ?)";
    $stmtDias = $conn->prepare($sqlDias);

    foreach ($dias_funcionamento as $dia) {
        $stmtDias->bind_param('is', $barbearia_id, $dia);
        $stmtDias->execute();
    }

    // Insere os horários de funcionamento
    $sqlHorarios = "INSERT INTO horarios_funcionamento (barbearia_id, dia_semana, turno, inicio, termino) VALUES (?, ?, ?, ?, ?)";
    $stmtHorarios = $conn->prepare($sqlHorarios);

    foreach ($horarios_funcionamento as $dia => $horarios_dia) {
        foreach ($horarios_dia as $turno => $horario) {
            $inicio = $horario['inicio'];
            $termino = $horario['termino'];
            $stmtHorarios->bind_param('issss', $barbearia_id, $dia, $turno, $inicio, $termino);
            $stmtHorarios->execute();
        }
    }

    // Envia o e-mail
    $email = $_SESSION['email'];

    if ($email) {

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

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Subject = "Parabéns por abrir sua barbearia em nosso sistema!";
            $mail->Body = "
                <p>Ao contratar funcionários, informe este código: <b>$codigo_barbearia</b></p>
                <h1>Bem-vindo ao Hourly</h1>
                <p>Hourly© 2024 Company, Inc</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
        }
    }

    header("Location: ../Dono/home_dono.php");
    exit;
} else {
    echo "Erro ao cadastrar a barbearia: " . $conn->error;
}

// Fecha as conexões
$stmtBarbearia->close();
$conn->close();
?>