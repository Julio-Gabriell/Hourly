<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'assas_functions.php';

$nomeCompleto = $_SESSION['nomeCompleto'];
$email = $_SESSION['email'];
$cpf = $_SESSION['cpf'];


// Cria cliente no Asaas
$cliente = criarClienteAsaas($nomeCompleto, $email, $cpf);
if (isset($cliente['errors'])) {
    echo "Erro ao criar cliente: " . json_encode($cliente['errors']);
    exit;
}

// Defini detalhes do plano Ouro
$valorPlano = 10; 
$descricaoPlano = "Assinatura Plano Bronze";
$pagamento = criarPagamentoUnicoAsaas($cliente['id'], $valorPlano, $descricaoPlano);

if (isset($pagamento['errors'])) {
    echo "Erro ao criar pagamento: " . json_encode($pagamento['errors']);
    exit;
}

// Exibir link de pagamento para o usuário
if (isset($pagamento['invoiceUrl'])) {
    echo "<h3>Pagamento do Plano Bronze</h3>";
    echo "<p>Por favor, realize o pagamento clicando no link abaixo:</p>";
    echo "<a href='" . $pagamento['invoiceUrl'] . "' target='_blank'>Pagar Agora</a>";
} else {
    echo "Erro ao obter link de pagamento.";
}
?>