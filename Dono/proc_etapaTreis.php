<?php
// Inicie a sessão
session_start();

// Array para armazenar os horários de cada dia da semana
$horarios = [];

// Função para capturar os horários
function capturarHorarios($dia) {
    $horarios_dia = [];

    // Captura os horários enviados no formulário
    if (isset($_POST['hora_inicio_manha'], $_POST['hora_termino_manha'])) {
        $horarios_dia['manha'] = [
            'inicio' => $_POST['hora_inicio_manha'],
            'termino' => $_POST['hora_termino_manha']
        ];
    }

    if (isset($_POST['hora_inicio_tarde'], $_POST['hora_termino_tarde'])) {
        $horarios_dia['tarde'] = [
            'inicio' => $_POST['hora_inicio_tarde'],
            'termino' => $_POST['hora_termino_tarde']
        ];
    }

    if (isset($_POST['hora_inicio_noite'], $_POST['hora_termino_noite'])) {
        $horarios_dia['noite'] = [
            'inicio' => $_POST['hora_inicio_noite'],
            'termino' => $_POST['hora_termino_noite']
        ];
    }

    return $horarios_dia;
}

// Dias da semana
$dias_semana = ['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

foreach ($dias_semana as $dia) {
    $horarios[$dia] = capturarHorarios($dia);
}

// Armazena os horários na sessão
$_SESSION['horarios_funcionamento'] = $horarios;

 header("Location: home_dono.php");