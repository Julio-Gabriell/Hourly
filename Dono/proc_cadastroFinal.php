<?php
session_start();

// Exibindo os dados da primeira etapa
$nome_barbearia = $_SESSION['nome_barbearia'];
$cep = $_SESSION['cep'];
$numero = $_SESSION['numero'];
$telefone = $_SESSION['telefone'];
$descricao = $_SESSION['descricao'];

// Exibindo os dias de funcionamento
$dias_funcionamento = $_SESSION['dias_funcionamento'];

// Exibindo os horários de funcionamento
$horarios_funcionamento = $_SESSION['horarios_funcionamento'];

// Aqui você pode exibir ou salvar os dados no banco de dados

// Exemplo de exibição:
echo "Nome da Barbearia: $nome_barbearia <br>";
echo "CEP: $cep <br>";
echo "Número: $numero <br>";
echo "Telefone: $telefone <br>";
echo "Descrição: $descricao <br>";
echo "Dias de funcionamento: " . implode(', ', $dias_funcionamento) . "<br>";

echo "<h3>Horários de funcionamento:</h3>";
foreach ($horarios_funcionamento as $dia => $horarios_dia) {
    echo "<strong>$dia:</strong><br>";
    foreach ($horarios_dia as $turno => $horario) {
        echo "$turno: de " . $horario['inicio'] . " até " . $horario['termino'] . "<br>";
    }
}
?>
