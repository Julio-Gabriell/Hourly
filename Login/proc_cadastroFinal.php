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

function buscarCep($cep) {
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

// Exemplo de uso
$cep = "01001000"; // Insira o CEP desejado
$dados = buscarCep($cep);

if (is_array($dados)) {
    // Armazena cada dado em uma variável específica
    $rua = $dados['logradouro'];
    $bairro = $dados['bairro'];
    $cidade = $dados['localidade'];
    $estado = $dados['uf'];}

// Pegando o ID do dono da barbearia da sessão
$dono_id = $_SESSION['userID'];

// Gerando um código de 5 dígitos para a barbearia
$codigo_barbearia = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

// Inserindo os dados da barbearia
$sqlBarbearia = "INSERT INTO barbearias (nome, cep, numero, descricao, dono_id, codigo_barbearia) VALUES (?, ?, ?, ?, ?, ?)";
$stmtBarbearia = $conn->prepare($sqlBarbearia);
$stmtBarbearia->bind_param('ssssss', $nome_barbearia, $cep, $numero, $descricao, $dono_id, $codigo_barbearia);

if ($stmtBarbearia->execute()) {
    $barbearia_id = $stmtBarbearia->insert_id;

    // Armazenando o ID da barbearia na sessão
    $_SESSION['barbearia_id'] = $barbearia_id;

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

    // Redirecionando para a página de sucesso
    header("Location: ../Dono/home_dono.php");
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
