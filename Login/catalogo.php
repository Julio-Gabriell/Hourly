<?php
include_once "topo.php"; ?>

<div class="d-flex justify-content-between align-items-center">
  <form class="flex-grow-1 me-3 mt-3" method="GET">
    <input type="search" name="search" class="form-control me-3" style="color: #13292A;" placeholder="Procurar..."
      aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
  </form>
  <div class="btn-group mt-3">
    <button class="btn btn-secondary btn-sm" style="background-color: #78CEBA; border: none; color: #13292A;"
      type="button">
      Filtro
    </button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
      style="background-color: #78CEBA; border: none; color: #13292A;" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu p-1">
      <!-- Cidades aqui -->
    </ul>
  </div>
</div>

<?php

$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o campo de busca foi enviado
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Função para buscar o CEP
function buscarCep($cep)
{
    // Remove traços e espaços para garantir o formato correto
    $cep = preg_replace('/[^0-9]/', '', $cep);

    // Verifica se o CEP tem 8 dígitos
    if (strlen($cep) != 8) {
        return "CEP inválido!";
    }

    // Faz a requisição à API ViaCEP
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $response = @file_get_contents($url);

    // Verifica se houve uma resposta
    if (!$response) {
        return "Não foi possível buscar o CEP!";
    }

    // Converte a resposta JSON em um array associativo
    $dadosCep = json_decode($response, true);

    // Verifica se houve erro na resposta da API
    if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
        return "CEP não encontrado!";
    }

    // Retorna os dados do CEP como array
    return $dadosCep;
}

// Verifica se a variável $cep está definida
$rua = "Não informada";
if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];
    $dados = buscarCep($cep);

    if (is_array($dados)) {
        $rua = $dados['logradouro'];
        $bairro = $dados['bairro'];
        $cidade = $dados['localidade'];
        $estado = $dados['uf'];
    }
}

// Ajusta a consulta SQL para incluir o filtro de busca
$sql = "
    SELECT 
        b.id, 
        b.nome, 
        b.cep, 
        b.numero, 
        b.descricao, 
        t.telefone, 
        (SELECT COUNT(*) FROM favoritos f WHERE f.usuario_id = ? AND f.barbearia_id = b.id) AS favoritado
    FROM barbearias b
    JOIN telefones_barbearia t ON b.id = t.barbearia_id
";

// Adiciona o filtro de busca
if (!empty($search)) {
    $sql .= " WHERE b.nome LIKE ?";
}
$sql .= " ORDER BY favoritado DESC, b.nome ASC";

// Prepara a declaração
$stmt = $conn->prepare($sql);

// Define o parâmetro de usuário
$usuario_id = $_SESSION['userID']; // Substitua pelo valor real da sessão ou variável

// Define os parâmetros de busca, se houver
if (!empty($search)) {
    $search_param = "%" . $search . "%";
    $stmt->bind_param("is", $usuario_id, $search_param);
} else {
    $stmt->bind_param("i", $usuario_id);
}

// Executa a consulta
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      $barbearia_id = $row['id'];
      $favoritado = $row['favoritado']; // Retorna 1 se favoritado, 0 caso contrário

      // Busca o endereço pelo CEP
      $dados = buscarCep($row['cep']);

      if (is_array($dados)) {
          $rua = $dados['logradouro'];
          $bairro = $dados['bairro'];
          $cidade = $dados['localidade'];
          $estado = $dados['uf'];
      } else {
          $rua = "Endereço não disponível";
          $bairro = "";
          $cidade = "";
          $estado = "";
      }
      // Define o ícone da estrela (amarela para favorito, cinza para não favorito)
      $estrela = $favoritado ? 'fa-star text-warning' : 'fa-star text-secondary';

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
      <img src="../Imgs/home.png" alt="" width="24" height="24"> ' . $rua . ', ' . $row["numero"] . '
    </div>
  </div>
  <form method="POST" action="favoritar.php" class="d-flex align-items-center">
              <input type="hidden" name="barbearia_id" value="' . $barbearia_id . '">
              <button type="submit" class="btn btn-link p-0">
                  <i class="fa ' . $estrela . '" style="font-size: 1.5rem;"></i>
              </button>
          </form>
</div>
</a>';
  }
} else {
  echo '<p class="d-flex justify-content-center mt-5" style="color: #13292A;">Nenhuma Barbearia encontrada.</p>';
}

$conn->close();
?>
<?php include_once "rodape.php"; ?>
