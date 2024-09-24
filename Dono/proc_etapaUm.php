<?php 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_SESSION['nome_barbearia'] = $_POST['nome_barbearia'];
  $_SESSION['cep_barbearia'] = $_POST['cep'];
  $_SESSION['num_barbearia'] = $_POST['numero'];
  $_SESSION['tel_barbearia'] = $_POST['telefone'];
  $_SESSION['des_barbearia'] = $_POST['descricao'];
  
  // Redireciona para a segunda etapa
  header("Location: cadastro_etapaDois.php");
  exit();
}

?>