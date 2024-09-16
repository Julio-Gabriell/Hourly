<?php
session_start();

if (!isset($_SESSION["logado"]) || $_SESSION['logado'] !== true) {
    header("Location: ../Login/catalogo.php");
    exit();
}
?>