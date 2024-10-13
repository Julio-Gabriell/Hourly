<?php
function verificarLogin()
{
    session_start();
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
        header("Location: ../index.php");
        exit();
    } elseif (isset($_SESSION['cargo']) === 'cliente') {
        header("Location: home_logado.php");
    } elseif (isset($_SESSION['cargo']) === 'funcionario') {
        header("Location: ../Barbeiro/home_barbeiro.php");
    } elseif (isset($_SESSION['cargo']) === 'dono') {
        header("Location: ../home_dono.php");
        exit();
    }
}
?>