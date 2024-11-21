<?php
function criarClienteAsaas($nomeCompleto, $email, $cpf)
{
    import requests

url = "https://sandbox.asaas.com/api/v3/customers"

payload = {
    "name": $nomeCompleto,
    "cpfCnpj": $cpf
}
headers = {
    "accept": "application/json",
    "content-type": "application/json",
    "access_token": "aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MDQxMTc6OiRhYWNoX2FkZmE2M2ZlLWUwYjktNDc4OS1hMDNkLWIyOWRkZDRiMzZjMg=="
}

response = requests.post(url, json=payload, headers=headers)

print(response.text)
}


function criarAssinaturaAsaas($clienteId, $valor, $descricao)
{
    $apiKey = "aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MDQxMTc6OiRhYWNoXzY5YzEwYmY2LTJmODctNDMyMi1hYWU0LTMzMTU4YTBiOGNkMQ==";
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
    $apiKey = "aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA1MDQxMTc6OiRhYWNoXzY5YzEwYmY2LTJmODctNDMyMi1hYWU0LTMzMTU4YTBiOGNkMQ==";
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