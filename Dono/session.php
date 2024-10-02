<?php
function verificarLogin() {
    session_start(); 
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
        header("Location: ../index.php");
        exit();
    }
}
?>