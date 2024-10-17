<?php
// Inclui o cabeçalho
include_once "topo.php";

// Verifica se o ID da barbearia foi passado na URL
if (isset($_GET['barbearia_id'])) {
    $barbearia_id = intval($_GET['barbearia_id']); // Converte para inteiro

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "root", "", "hourly_bd");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Verifica se o nome da barbearia está disponível com base no ID
    $sql = "SELECT nome FROM barbearias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $barbearia_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $nome_barbearia = "Nome Padrão"; // Nome padrão caso não seja encontrado

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_barbearia = $row['nome']; // Define o nome da barbearia
        $_SESSION['barbearia_id'] = $barbearia_id; // Armazena o ID na sessão
    } else {
        $nome_barbearia = "Barbearia não encontrada"; // Caso não tenha o ID na sessão
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
} else {
    $nome_barbearia = "Barbearia não especificada"; // Caso não tenha o ID na URL
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 style="color: #13292A;" class="text-center">
                Olá, <?php echo htmlspecialchars($nome_barbearia); ?>
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
