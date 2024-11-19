<?php
require __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;

$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_servico = $_POST['nome_servico'];
    $preco_servico = $_POST['preco_servico'];
    $tempo_servico = $_POST['tempo_servico'];
    $funcionarios = $_POST['funcionarios'];

    if (empty($funcionarios)) {
        echo "Por favor, selecione pelo menos um funcionário.";
        exit;
    }

    $conn->begin_transaction();

    try {
        $sql_servico = "INSERT INTO servicos (nome, preco, tempo_medio) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql_servico);
        $stmt->bind_param("sdi", $nome_servico, $preco_servico, $tempo_servico);
        $stmt->execute();
        $servico_id = $stmt->insert_id;

        if (!$servico_id) {
            throw new Exception("Falha ao obter o ID do serviço.");
        }

        $sql_relacao = "INSERT INTO servico_funcionario (servico_id, funcionario_id) VALUES (?, ?)";
        $stmt_relacao = $conn->prepare($sql_relacao);
        foreach ($funcionarios as $funcionario_id) {
            $stmt_relacao->bind_param("ii", $servico_id, $funcionario_id);
            if (!$stmt_relacao->execute()) {
                throw new Exception("Erro ao inserir funcionário: " . $stmt_relacao->error);
            }
        }

        // Integração com a API Cal.com
        $client = new Client([
            'base_uri' => 'https://api.cal.com/',
            'headers' => [
                'Authorization' => 'Bearer cal_live_7b9498d98ca6158662d16d493be45e85', 
                'Content-Type' => 'application/json'
            ]
        ]);

        // Depuração: Verificando a resposta de tipos de eventos disponíveis
        $response = $client->get('v2/event_types');
        if ($response->getStatusCode() !== 200) {
            throw new Exception("Erro ao obter tipos de evento: " . $response->getBody());
        }

        // Exibe os tipos de evento para depuração
        $event_types = json_decode($response->getBody(), true);
        $evento_id = $event_types[0]['id']; // Supondo que o primeiro evento seja o correto

        // Envia a requisição para criar o agendamento
        $response = $client->post('v2/bookings', [
            'json' => [
                'event_type_id' => $evento_id, // Usando o ID do evento obtido da API
                'start_time' => '2024-11-15T14:00:00Z', // Horário de início
                'end_time' => '2024-11-15T14:30:00Z',   // Horário de término
                'email' => 'email_do_cliente@example.com', // Ajuste conforme necessário
                'name' => $nome_servico
            ]
        ]);

        // Depuração: Verificar o status da resposta e o corpo
        if ($response->getStatusCode() !== 201) {
            throw new Exception("Erro na API ao criar o agendamento: " . $response->getBody());
        }

        // Extrai a resposta da API e pega o ID do evento gerado
        $api_response = json_decode($response->getBody(), true);
        $evento_id = $api_response['id']; // ID do evento gerado pela API

        // Commit da transação no banco de dados
        $conn->commit();
        header("Location: home_dono.php?success=1");
    } catch (Exception $e) {
        // Em caso de erro, faz rollback na transação
        $conn->rollback();
        echo "Erro ao cadastrar o serviço: " . $e->getMessage();
    } finally {
        $stmt->close();
        $stmt_relacao->close();
        $conn->close();
    }
}
?>
