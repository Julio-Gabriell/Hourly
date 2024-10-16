<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "hourly_bd");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Iniciando a sessão
session_start();

// Pegando os dados da sessão
$nome_barbearia = $_SESSION['nome_barbearia'];
$cep = $_SESSION['cep_barbearia'];
$numero = $_SESSION['num_barbearia'];
$telefone = $_SESSION['tel_barbearia'];
$descricao = $_SESSION['des_barbearia'];

$dias_funcionamento = $_SESSION['dias_funcionamento']; // Array de dias
$horarios_funcionamento = $_SESSION['horarios_funcionamento']; // Array de horários

// Inserindo os dados da barbearia
$sqlBarbearia = "INSERT INTO barbearias (nome, cep, numero, descricao) VALUES (?, ?, ?, ?)";
$stmtBarbearia = $conn->prepare($sqlBarbearia);
$stmtBarbearia->bind_param('ssss', $nome_barbearia, $cep, $numero, $descricao);

if ($stmtBarbearia->execute()) {
    $barbearia_id = $stmtBarbearia->insert_id; // Pegando o ID da barbearia inserida

    // Inserindo o telefone da barbearia
    $sqlTelefone = "INSERT INTO telefones_barbearia (barbearia_id, telefone) VALUES (?, ?)";
    $stmtTelefone = $conn->prepare($sqlTelefone);
    $stmtTelefone->bind_param('is', $barbearia_id, $telefone);
    $stmtTelefone->execute();

    // Inserindo os dias de funcionamento
    $sqlDias = "INSERT INTO dias_funcionamento (barbearia_id, dia_semana) VALUES (?, ?)";
    $stmtDias = $conn->prepare($sqlDias);
    
    foreach ($dias_funcionamento as $dia) {
        $stmtDias->bind_param('is', $barbearia_id, $dia);
        $stmtDias->execute();
    }

    // Inserindo os horários de funcionamento
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

    echo "Barbearia e dados relacionados inseridos com sucesso!";
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

// Fechar a conexão
$stmtBarbearia->close();
$stmtTelefone->close();
$stmtDias->close();
$stmtHorarios->close();
$conn->close();
?>
