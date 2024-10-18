<?php
// demissao_funcionario.php

include_once "topo.php";

// Conectando ao banco de dados para carregar os funcionários
$conn = new mysqli("localhost", "root", "", "hourly_bd");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Selecionando os funcionários existentes
$sql = "SELECT id, nome FROM funcionarios";
$result = $conn->query($sql);
?>

<div class="container">
    <h1 class="d-flex justify-content-center">Demissão de Funcionários</h1>
    <div class="col-md-4 offset-md-4">
        <form method="POST" action="proc_demissaoFuncionarios.php">
            <div class="form-group">
                <label for="funcionario">Selecione o funcionário para demitir:</label>
                <select name="funcionario_id" id="funcionario" class="form-control">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum funcionário encontrado</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-danger mt-3" style="border: none;">Demitir Funcionário</button>
            </div>
        </form>
    </div>
</div>

<?php
$conn->close();
include_once "rodape.php";
?>
