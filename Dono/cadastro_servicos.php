<?php

include_once "topo.php";
// Inclui a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "hourly_bd");

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para buscar todos os funcionários
$sql = "SELECT id, nome FROM funcionarios";
$result = $conn->query($sql);

?>

<h2 class="d-flex justify-content-center">Cadastro de Serviços</h2>
<div class="col-md-4 offset-md-4">
<form method="post" action="proc_cadastro_servicos.php" id="proc_cadastro_servicosForm">
          <div class="form-group">
            <label for="nome_servico" style="color: #13292A;">Nome do Serviço</label>
            <input type="text" name="nome_servico" id="nome_servico" required class="form-control"
              style="color: #13292A; background-color:#479D89; outline: none; box-shadow: none; border: none;"
              placeholder="Nome do Serviço">
          </div>
          <div class="form-group">
            <label for="preco_servico" style="color: #13292A;">Preço do Serviço</label>
            <input type="number" name="preco_servico" id="preco_servico" required class="form-control"
              style="color: #13292A; background-color:#479D89; outline: none; box-shadow: none; border: none;"
              placeholder="Preço do Serviço">
          </div>
          <div class="form-group">
            <label for="tempo_servico" style="color: #13292A;">Tempo médio do Serviço</label>
            <input type="number" step="5" name="tempo_servico" id="tempo_servico" required class="form-control"
              style="color: #13292A; background-color:#479D89; outline: none; box-shadow: none; border: none;"
              placeholder="Tempo do Serviço">
          </div>

          <h5 class="d-flex justify-content-center mt-2">Quais funcionários prestam esse serviço?</h5>
          <div class="form-group">
            <?php
            // Exibir os funcionários como checkboxes
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" name="funcionarios[]" required value="' . $row['id'] . '" id="funcionario_' . $row['id'] . '">';
                    echo '<label class="form-check-label" for="funcionario_' . $row['id'] . '">' . $row['nome'] . '</label>';
                    echo '</div>';
                }
            } else {
                echo '<p class="d-flex justify-content-center">Nenhum funcionário encontrado. <a class="d-flex justify-content-center" style="color: #78CEBA;" href="home_dono.php">Cadastre Aqui </a></p>';
            }
            ?>
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" style="background-color:#479D89; color: #13292A;"
              class="btn mt-2 d-flex justify-content-center w-75">Cadastrar</button>
          </div>
      </form>
      </div>

<?php

include_once "rodape.php";
// Fecha a conexão com o banco de dados
$conn->close();

?>
