<?php
function criarClienteAsaas($nomeCompleto, $email, $cpf)
{
    $url = "https://www.asaas.com/api/v3/customers";
     // Sua chave API fornecida

    $dados = array(
        'name' => $nomeCompleto,
        'email' => $email,
        'cpfCnpj' => $cpf,
    );

    // Iniciar cURL
    $ch = curl_init($url);

    // Configurações da requisição
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $apiKey,  // Passando a chave API no cabeçalho
        'Content-Type: application/json'
    ));

    // Executar a requisição
    $resposta = curl_exec($ch);

    // Verificar se ocorreu algum erro na requisição
    if (curl_errno($ch)) {
        echo 'Erro cURL: ' . curl_error($ch);  
        curl_close($ch);
        return ['errors' => 'Erro na requisição cURL'];
    }

    // Verificar o código HTTP de resposta
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        echo "Erro HTTP: " . $httpCode . " - Resposta: " . $resposta;
        return ['errors' => 'Falha na requisição'];
    }

    // Retornar a resposta decodificada
    return json_decode($resposta, true);
}


function criarAssinaturaAsaas($clienteId, $valor, $descricao)
{
    
    $url = 'https://www.asaas.com/api/v3/subscriptions';

    $data = [
        "customer" => $clienteId,
        "billingType" => "CREDIT_CARD", // Tipo de cobrança
        "nextDueDate" => date('Y-m-d', strtotime('+1 day')), // Data de vencimento inicial
        "value" => $valor,
        "cycle" => "MONTHLY", // Cobrança mensal
        "description" => $descricao
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n" .
                "access_token: $apiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}

function criarPagamentoUnicoAsaas($clienteId, $valor, $descricao)
{
    
    $url = 'https://www.asaas.com/api/v3/payments';

    $data = [
        "customer" => $clienteId,
        "billingType" => "PIX", // Método de pagamento: PIX
        "dueDate" => date('Y-m-d', strtotime('+1 day')), // Data de vencimento
        "value" => $valor,
        "description" => $descricao
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n" .
                "access_token: $apiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true);
}
?>