<?php include_once "topo.php"; ?>

<div class="d-flex justify-content-between align-items-center">
  <form class="flex-grow-1 me-3" method="GET">
    <input type="search" name="search" class="form-control me-3" style="color: #13292A;" placeholder="Procurar..." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
  </form>
  <div class="btn-group">
    <button class="btn btn-secondary btn-sm" style="background-color: #78CEBA; border: none; color: #13292A;" type="button">
      Filtro
    </button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" style="background-color: #78CEBA; border: none; color: #13292A;" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu p-1">
      <!-- Se houver algum texto aqui, adicione a cor também -->
    </ul>
  </div>
</div>

<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o campo de busca foi enviado
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Ajusta a consulta SQL para incluir o filtro de busca, se houver
$sql = "SELECT b.nome, b.cep, b.numero, b.descricao, t.telefone 
        FROM barbearias b 
        JOIN telefones_barbearia t ON b.id = t.barbearia_id";

if (!empty($search)) {
  $sql .= " WHERE b.nome LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Exibe o layout da barbearia com os dados do banco
    echo '
<a href="agende.php" class="text-decoration-none">
  <div class="p-md-5 mt-4 mb-4 rounded d-flex justify-content-between align-items-center"
       style="background-color:#78CEBA; color: #13292A;">
    <img class="rounded bg-white" style="object-fit: cover;" src="../Imgs/icon.ico" alt="" width="150" height="150"></img>
    <div class="d-flex flex-column align-items-center text-center" style="flex-grow: 1;">
      <h3 class="fs-2 text-body-emphasis" style="color: #13292A;">' . $row["nome"] . '</h3>
      <p style="color: #13292A;">' . $row["descricao"] . '</p>
      <div class="d-flex justify-content-center pt-3 gap-3" style="color: #13292A;">
        <img src="../Imgs/zap.png" alt="" width="24" height="24"> ' . $row["telefone"] . '
        <img src="../Imgs/home.png" alt="" width="24" height="24"> ' . $row["cep"] . ', ' . $row["numero"] . '
      </div>
    </div>
  </div>
</a>';
  }
} else {
  echo '<p class="d-flex justify-content-center mt-5" style="color: #13292A;">Nenhuma Barbearia encontrada.</p>';
}

$conn->close();
?>

<?php include_once "rodape.php"; ?>
