<?php
$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start();

$nome_barbearia = $_SESSION['nome_barbearia'];
$cep = $_SESSION['cep_barbearia'];
$numero = $_SESSION['num_barbearia'];
$telefone = $_SESSION['tel_barbearia'];
$descricao = $_SESSION['des_barbearia'];

$dias_funcionamento = $_SESSION['dias_funcionamento'];
$horarios_funcionamento = $_SESSION['horarios_funcionamento'];

function buscarCep($cep)
{
    // Remove traços e espaços para garantir o formato correto
    $cep = preg_replace('/[^0-9]/', '', $cep);

    // Verifica se o CEP tem 8 dígitos
    if (strlen($cep) != 8) {
        return "CEP inválido!";
    }

    // Monta a URL de requisição para a API do ViaCEP
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    // Faz a requisição para a API
    $response = file_get_contents($url);

    // Verifica se houve uma resposta
    if (!$response) {
        return "Não foi possível buscar o CEP!";
    }

    // Converte a resposta JSON em um array associativo
    $dadosCep = json_decode($response, true);

    // Verifica se houve algum erro na busca do CEP
    if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
        return "CEP não encontrado!";
    }

    return $dadosCep; // Retorna os dados do CEP como array
}

if (is_array($dados)) {
    // Armazena cada dado em uma variável específica
    $rua = $dados['logradouro'];
    $bairro = $dados['bairro'];
    $cidade = $dados['localidade'];
    $estado = $dados['uf'];
}

$dono_id = $_SESSION['userID'];

// Gera um código de 5 dígitos para a barbearia
$codigo_barbearia = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

$sqlBarbearia = "INSERT INTO barbearias (nome, cep, numero, descricao, dono_id, codigo_barbearia) VALUES (?, ?, ?, ?, ?, ?)";
$stmtBarbearia = $conn->prepare($sqlBarbearia);
$stmtBarbearia->bind_param('ssssss', $nome_barbearia, $cep, $numero, $descricao, $dono_id, $codigo_barbearia);

if ($stmtBarbearia->execute()) {
    $barbearia_id = $stmtBarbearia->insert_id;

    $_SESSION['barbearia_id'] = $barbearia_id;

    $sqlTelefone = "INSERT INTO telefones_barbearia (barbearia_id, telefone) VALUES (?, ?)";
    $stmtTelefone = $conn->prepare($sqlTelefone);
    $stmtTelefone->bind_param('is', $barbearia_id, $telefone);
    $stmtTelefone->execute();

    $sqlDias = "INSERT INTO dias_funcionamento (barbearia_id, dia_semana) VALUES (?, ?)";
    $stmtDias = $conn->prepare($sqlDias);

    foreach ($dias_funcionamento as $dia) {
        $stmtDias->bind_param('is', $barbearia_id, $dia);
        $stmtDias->execute();
    }

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

    header("Location: ../Dono/home_dono.php");
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

$stmtBarbearia->close();
$stmtTelefone->close();
$stmtDias->close();
$stmtHorarios->close();
$conn->close();
?>