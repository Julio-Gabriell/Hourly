<?php
session_start();

$nome_barbearia = $_SESSION['nome_barbearia'];
$cep = $_SESSION['cep_barbearia'];
$numero = $_SESSION['num_barbearia'];
$telefone = $_SESSION['tel_barbearia'];
$descricao = $_SESSION['des_barbearia'];

$dias_funcionamento = $_SESSION['dias_funcionamento'];

$horarios_funcionamento = $_SESSION['horarios_funcionamento'];

//! substituir por colocar no banco dps

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
