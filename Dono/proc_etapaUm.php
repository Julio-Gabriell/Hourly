<?php 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_SESSION['nome_barbearia'] = $_POST['nome_barbearia'];
  $_SESSION['cep_barbearia'] = $_POST['cep_barbearia'];
  $_SESSION['num_barbearia'] = $_POST['num_barbearia'];
  $_SESSION['tel_barbearia'] = $_POST['tel_barbearia'];
  $_SESSION['des_barbearia'] = $_POST['des_barbearia'];
  
  // Redireciona para a segunda etapa
  header("Location: cadastro_etapaDois.php");
  exit();
}

?>