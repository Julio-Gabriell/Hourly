<?php
require 'vendor/autoload.php'; // Carregar autoload do Composer
require 'config.php';

use GuzzleHttp\Client;

// Criar um cliente Guzzle
$client = new Client();

try {
    $response = $client->request('GET', CAL_API_URL . 'events', [
        'headers' => [
            'Authorization' => 'Bearer ' . CAL_API_KEY,
            'Accept' => 'application/json',
        ],
    ]);

    // Manipular a resposta
    $data = json_decode($response->getBody(), true);
    print_r($data); // Exibir dados para depuração
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
