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

function buscarCep($cep, $conn)
{
    // Remove traços e espaços para garantir o formato correto
    $cep = preg_replace('/[^0-9]/', '', $cep);

    // Verifica se o CEP tem 8 dígitos
    if (strlen($cep) != 8) {
        return "CEP inválido!";
    }

    // Verifica se o CEP já está cadastrado no banco
    $sql = "SELECT * FROM enderecos WHERE cep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $cep);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se o CEP já estiver no banco, retorna os dados
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    // Se não encontrar o CEP no banco, faz a requisição à API
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $response = file_get_contents($url);

    // Verifica se houve uma resposta
    if (!$response) {
        return "Não foi possível buscar o CEP!";
    }

    // Converte a resposta JSON em um array associativo
    $dadosCep = json_decode($response, true);

    // Verifica se houve erro na resposta da API
    if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
        return "CEP não encontrado!";
    }

    // Armazena os dados do CEP no banco de dados
    $sql = "INSERT INTO enderecos (cep, rua, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $cep, $dadosCep['logradouro'], $dadosCep['bairro'], $dadosCep['localidade'], $dadosCep['uf']);
    $stmt->execute();

    // Retorna os dados do CEP como array
    return $dadosCep;
}

// Chama a função buscarCep
$dados = buscarCep($cep, $conn);

if (is_array($dados)) {
    // Armazena os dados do CEP em variáveis
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

    // Inserir telefone
    $sqlTelefone = "INSERT INTO telefones_barbearia (barbearia_id, telefone) VALUES (?, ?)";
    $stmtTelefone = $conn->prepare($sqlTelefone);
    $stmtTelefone->bind_param('is', $barbearia_id, $telefone);
    $stmtTelefone->execute();

    // Inserir dias de funcionamento
    $sqlDias = "INSERT INTO dias_funcionamento (barbearia_id, dia_semana) VALUES (?, ?)";
    $stmtDias = $conn->prepare($sqlDias);

    foreach ($dias_funcionamento as $dia) {
        $stmtDias->bind_param('is', $barbearia_id, $dia);
        $stmtDias->execute();
    }

    // Inserir horários de funcionamento
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

    // Redireciona para a página do dono
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
