<?php
// Inicie a sessão
session_start();

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dias_funcionamento = [];

    if (isset($_POST['segunda'])) {
        $dias_funcionamento[] = 'segunda';
    }
    if (isset($_POST['terca'])) { 
        $dias_funcionamento[] = 'terca';
    }
    if (isset($_POST['quarta'])) {
        $dias_funcionamento[] = 'quarta';
    }
    if (isset($_POST['quinta'])) {
        $dias_funcionamento[] = 'quinta';
    }
    if (isset($_POST['sexta'])) {
        $dias_funcionamento[] = 'sexta';
    }
    if (isset($_POST['sabado'])) {
        $dias_funcionamento[] = 'sabado';
    }
    if (isset($_POST['domingo'])) {
        $dias_funcionamento[] = 'domingo';
    }

    $_SESSION['dias_funcionamento'] = $dias_funcionamento;

    header("Location: cadastro_etapaTreis.php");
}
?>
