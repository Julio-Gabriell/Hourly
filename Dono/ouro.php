<?php
require 'assas_functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeCompleto = $_SESSION['nomeCompleto'];
    $email = $_SESSION['email'];
    $cpf = $_SESSION['cpf'];

    // Cria cliente no Asaas
    $cliente = criarClienteAsaas($nomeCompleto, $email, $cpf);
    if (isset($cliente['errors'])) {
        echo json_encode(["error" => "Erro ao criar cliente: " . $cliente['errors'][0]['description']]);
        exit;
    }

    // Defini detalhes do plano Ouro
    $valorPlano = 20; // Valor da cobrança única
    $descricaoPlano = "Pagamento Único Plano Ouro";

    // Criar pagamento único
    $pagamento = criarPagamentoUnicoAsaas($cliente['id'], $valorPlano, $descricaoPlano);

    if (isset($pagamento['errors'])) {
        echo json_encode(["error" => "Erro ao criar pagamento: " . $pagamento['errors'][0]['description']]);
        exit;
    }

    // Retornar sucesso com o ID do pagamento e URL de pagamento
    echo json_encode(["success" => true, "paymentId" => $pagamento['id'], "invoiceUrl" => $pagamento['invoiceUrl']]);
}
?>