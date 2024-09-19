<?php 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['nome_barbearia'] = $_POST['nome_barbearia'];
  $_SESSION['cep'] = $_POST['cep'];
  $_SESSION['numero'] = $_POST['numero'];
  $_SESSION['telefone'] = $_POST['telefone'];
  $_SESSION['descricao'] = $_POST['descricao'];
  
  // Redireciona para a segunda etapa
  header("Location: cadastro_barbearia2.php");
  exit();
}

?>