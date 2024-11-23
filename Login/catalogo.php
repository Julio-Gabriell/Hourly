<?php
include_once "topo.php";

// Inicializa a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para buscar informações do CEP via API ViaCEP
function buscarCep($cep)
{
    if (empty($cep)) {
        return "CEP não fornecido!";
    }
    $cep = preg_replace('/[^0-9]/', '', $cep); // Remove caracteres inválidos
    if (strlen($cep) != 8) {
        return "CEP inválido!";
    }
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $response = @file_get_contents($url);
    if (!$response) {
        return null;
    }
    $dadosCep = json_decode($response, true);
    return $dadosCep;
}

// Obter filtro de busca e inicializar variáveis
$search = isset($_GET['search']) ? $_GET['search'] : '';
$cidadeFiltro = isset($_GET['cidade']) ? $_GET['cidade'] : ''; // Filtro de cidade
$usuario_id = $_SESSION['userID']; // ID do usuário logado

// Consulta para obter os CEPs e buscar as cidades
$sqlCeps = "SELECT DISTINCT b.cep FROM barbearias b";
$resultCeps = $conn->query($sqlCeps);

$cidades = [];
if ($resultCeps && $resultCeps->num_rows > 0) {
    while ($row = $resultCeps->fetch_assoc()) {
        $dadosCep = buscarCep($row['cep']);
        if ($dadosCep && isset($dadosCep['localidade'])) {
            $cidade = trim($dadosCep['localidade']);
            if (!in_array($cidade, $cidades)) {
                $cidades[] = $cidade;
                error_log("Cidade adicionada: " . $cidade);
            }
        }
    }
}

// Ordena as cidades em ordem alfabética
sort($cidades);

// Modifique a consulta SQL para incluir todos os campos no GROUP BY
$sql = "
    SELECT 
        b.id, 
        b.nome, 
        b.cep, 
        b.numero, 
        b.descricao, 
        MAX(t.telefone) as telefone, 
        (SELECT COUNT(*) FROM favoritos f WHERE f.usuario_id = ? AND f.barbearia_id = b.id) AS favoritado
    FROM barbearias b
    JOIN telefones_barbearia t ON b.id = t.barbearia_id
";

// Verificar se há filtro de cidade ou busca
if (!empty($search)) {
    $sql .= " WHERE b.nome LIKE ?";
}

$sql .= " GROUP BY b.id, b.nome, b.cep, b.numero, b.descricao ORDER BY favoritado DESC, b.nome ASC";

// Prepara o statement
$stmt = $conn->prepare($sql);

// Executa a consulta de acordo com o filtro
if (!empty($cidadeFiltro)) {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $filtered_results = array();
    
    while ($row = $result->fetch_assoc()) {
        $dadosCep = buscarCep($row['cep']);
        if ($dadosCep && isset($dadosCep['localidade']) && 
            strtolower(trim($dadosCep['localidade'])) === strtolower(trim($cidadeFiltro))) {
            $filtered_results[] = $row;
        }
    }
    
    $result = new ArrayObject($filtered_results);
} elseif (!empty($search)) {
    $search_param = "%" . $search . "%";
    $stmt->bind_param("is", $usuario_id, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
}

// Adicione este debug no início do arquivo para verificar as cidades disponíveis
echo "<!-- Cidades disponíveis: ";
print_r($cidades);
echo " -->";

// E este debug para ver qual cidade está sendo filtrada
echo "<!-- Cidade do filtro: " . $cidadeFiltro . " -->";
?>

<!-- Seção de Busca e Filtros -->
<div class="d-flex justify-content-between align-items-center">
    <form class="flex-grow-1 me-3 mt-3" method="GET">
        <input type="search" name="search" class="form-control me-3" style="color: #13292A;" placeholder="Procurar..."
            aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
    </form>
    <div class="btn-group mt-3">
        <button class="btn btn-secondary btn-sm" style="background-color: #78CEBA; border: none; color: #13292A;"
            type="button">Filtro</button>
        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
            style="background-color: #78CEBA; border: none; color: #13292A;" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu p-1">
            <li><a class="dropdown-item" href="?">Limpar Filtro</a></li>
            <?php if (!empty($cidades)) : ?>
                <?php foreach ($cidades as $cidade) : ?>
                    <li>
                        <a class="dropdown-item" href="?cidade=<?php echo urlencode(trim($cidade)); ?>">
                            <?php echo htmlspecialchars(trim($cidade)); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li class="dropdown-item">Nenhuma cidade disponível</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!-- Lista de Barbearias -->
<?php
if ($result instanceof ArrayObject) {
    // Se for um ArrayObject (resultado do filtro por cidade)
    if (count($result) > 0) {
        foreach ($result as $row) {
            $barbearia_id = $row['id'];
            $favoritado = $row['favoritado'];

            // Busca o endereço pelo CEP
            $dados = isset($row['cep']) ? buscarCep($row['cep']) : null;
            if (is_array($dados)) {
                $cidade = $dados['localidade'] ?? "Não disponível";
            } else {
                $cidade = "Endereço não disponível";
            }

            $estrela = $favoritado ? 'fa-star text-warning' : 'fa-star text-secondary';

            echo '
            <a href="agende.php" class="text-decoration-none">
            <div class="p-md-5 mt-4 mb-4 rounded d-flex justify-content-between align-items-center"
                 style="background-color:#78CEBA; color: #13292A;">
              <img class="rounded bg-white" style="object-fit: cover;" src="../Imgs/icon.ico" alt="" width="150" height="150"></img>
              <div class="d-flex flex-column align-items-center text-center" style="flex-grow: 1;">
                <h3 class="fs-2 text-body-emphasis" style="color: #13292A;">' . htmlspecialchars($row["nome"]) . '</h3>
                <p style="color: #13292A;">' . htmlspecialchars($row["descricao"]) . '</p>
                <div class="d-flex justify-content-center pt-3 gap-3" style="color: #13292A;">
                  <img src="../Imgs/zap.png" alt="" width="24" height="24"> ' . htmlspecialchars($row["telefone"]) . '
                  <img src="../Imgs/home.png" alt="" width="24" height="24"> ' . htmlspecialchars($dados['logradouro'] ?? "Não disponível") . ', ' . htmlspecialchars($row["numero"]) . '
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
} else {
    // Se for um resultado mysqli
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $barbearia_id = $row['id'];
            $favoritado = $row['favoritado'];

            // Busca o endereço pelo CEP
            $dados = isset($row['cep']) ? buscarCep($row['cep']) : null;
            if (is_array($dados)) {
                $cidade = $dados['localidade'] ?? "Não disponível";
            } else {
                $cidade = "Endereço não disponível";
            }

            $estrela = $favoritado ? 'fa-star text-warning' : 'fa-star text-secondary';

            echo '
            <a href="agende.php" class="text-decoration-none">
            <div class="p-md-5 mt-4 mb-4 rounded d-flex justify-content-between align-items-center"
                 style="background-color:#78CEBA; color: #13292A;">
              <img class="rounded bg-white" style="object-fit: cover;" src="../Imgs/icon.ico" alt="" width="150" height="150"></img>
              <div class="d-flex flex-column align-items-center text-center" style="flex-grow: 1;">
                <h3 class="fs-2 text-body-emphasis" style="color: #13292A;">' . htmlspecialchars($row["nome"]) . '</h3>
                <p style="color: #13292A;">' . htmlspecialchars($row["descricao"]) . '</p>
                <div class="d-flex justify-content-center pt-3 gap-3" style="color: #13292A;">
                  <img src="../Imgs/zap.png" alt="" width="24" height="24"> ' . htmlspecialchars($row["telefone"]) . '
                  <img src="../Imgs/home.png" alt="" width="24" height="24"> ' . htmlspecialchars($dados['logradouro'] ?? "Não disponível") . ', ' . htmlspecialchars($row["numero"]) . '
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
}
?>

<?php
$conn->close();
include_once "rodape.php";
?>
