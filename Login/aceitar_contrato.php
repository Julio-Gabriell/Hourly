<?php
// Inclui o cabeçalho
include_once "topo.php";

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "hourly_bd");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Inicializa a variável do nome da barbearia
$nome_barbearia = '';

// Verifica se o código da barbearia foi enviado pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_barbearia'])) {
    $codigo_barbearia = $_POST['codigo_barbearia'];

    // Consulta para buscar o nome da barbearia pelo código
    $sql = "SELECT nome FROM barbearias WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $codigo_barbearia);
    $stmt->execute();
    $stmt->bind_result($nome_barbearia);
    $stmt->fetch();
    $stmt->close();
}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-4 offset-md-4">
    <h2 style="color: #13292A;" class="text-center">
            Olá, <?php echo $nome_barbearia; ?>
            </h2>
      <form action="" method="post">
        <div class="form-group">
          <div class="input-group">
            <input id="codigo_barbearia" name="codigo_barbearia" placeholder="Código da barbearia" class="form-control" type="text" required>
          </div>
        </div>
        <div class="form-group">
          <div class="row mt-2 d-flex justify-content-center">
            <button type="submit" style="background-color:#78CEBA; color: #13292A;" class="btn w-75">
              Confirmar
            </button> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Inclui o rodapé
include_once "rodape.php";
?>
