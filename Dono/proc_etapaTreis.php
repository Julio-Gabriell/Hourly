<?php
// Inicie a sessão
session_start();

// Função para capturar os horários de cada dia, com o nome do dia específico nos inputs
function capturarHorarios($dia) {
    $horarios_dia = [];

    // Captura os horários da manhã, tarde e noite de acordo com o nome do dia
    if (isset($_POST["hora_inicio_manha_$dia"], $_POST["hora_termino_manha_$dia"])) {
        $horarios_dia['manha'] = [
            'inicio' => $_POST["hora_inicio_manha_$dia"],
            'termino' => $_POST["hora_termino_manha_$dia"]
        ];
    }

    if (isset($_POST["hora_inicio_tarde_$dia"], $_POST["hora_termino_tarde_$dia"])) {
        $horarios_dia['tarde'] = [
            'inicio' => $_POST["hora_inicio_tarde_$dia"],
            'termino' => $_POST["hora_termino_tarde_$dia"]
        ];
    }

    if (isset($_POST["hora_inicio_noite_$dia"], $_POST["hora_termino_noite_$dia"])) {
        $horarios_dia['noite'] = [
            'inicio' => $_POST["hora_inicio_noite_$dia"],
            'termino' => $_POST["hora_termino_noite_$dia"]
        ];
    }

    return $horarios_dia;
}

// Dias da semana
$dias_semana = ['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

// Array para armazenar os horários de todos os dias
$horarios = [];

// Captura os horários de cada dia da semana
foreach ($dias_semana as $dia) {
    $horarios[$dia] = capturarHorarios($dia);
}

// Armazena os horários na sessão
$_SESSION['horarios_funcionamento'] = $horarios;

// Redireciona para a próxima etapa
header("Location: proc_cadastroFinal.php");
exit();
?>
