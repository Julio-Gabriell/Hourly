<?php
// Inclui a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "fusca");

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome_servico = $_POST['nome_servico'];
    $preco_servico = $_POST['preco_servico'];
    $tempo_servico = $_POST['tempo_servico'];
    $funcionarios = $_POST['funcionarios']; // array de IDs dos funcionários selecionados

    // Valida se pelo menos um funcionário foi selecionado
    if (empty($funcionarios)) {
        echo "Por favor, selecione pelo menos um funcionário.";
        exit;
    }

    // Inicia a transação
    $conn->begin_transaction();

    try {
        // Insere o novo serviço na tabela 'servicos'
        $sql_servico = "INSERT INTO servicos (nome, preco, tempo_medio) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql_servico);
        $stmt->bind_param("sdi", $nome_servico, $preco_servico, $tempo_servico);
        $stmt->execute();
        
        // Obtém o ID do serviço inserido
        $servico_id = $stmt->insert_id;

        // Verifica se o ID foi gerado corretamente
        if (!$servico_id) {
            throw new Exception("Falha ao obter o ID do serviço.");
        }

        // Insere os funcionários relacionados ao serviço
        $sql_relacao = "INSERT INTO servico_funcionario (servico_id, funcionario_id) VALUES (?, ?)";
        $stmt_relacao = $conn->prepare($sql_relacao);

        // Para cada funcionário selecionado, insere uma linha na tabela intermediária
        foreach ($funcionarios as $funcionario_id) {
            $stmt_relacao->bind_param("ii", $servico_id, $funcionario_id);
            
            // Executa a inserção e verifica erros
            if (!$stmt_relacao->execute()) {
                throw new Exception("Erro ao inserir funcionário: " . $stmt_relacao->error);
            }
        }

        // Se tudo deu certo, confirma a transação
        $conn->commit();

        header("Location: home_dono.php");
    } catch (Exception $e) {
        // Em caso de erro, desfaz as mudanças
        $conn->rollback();
        echo "Erro ao cadastrar o serviço: " . $e->getMessage();
    }

    // Fecha as declarações
    $stmt->close();
    $stmt_relacao->close();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
