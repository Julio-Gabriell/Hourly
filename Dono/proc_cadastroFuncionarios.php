<?php
// Inclui a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "hourly_bd");

// Verifica se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $funcao = $_POST['funcao'];

    // Configuração para a foto de perfil
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['profile_picture']['tmp_name'];
        $imagemNome = $_FILES['profile_picture']['name'];
        $imagemTipo = $_FILES['profile_picture']['type'];

        // Definir o diretório de upload e mover o arquivo para lá
        $uploadDir = 'uploads/profile_pictures/';
        $imagemCaminho = $uploadDir . basename($imagemNome);

        // Verifica se o diretório existe, se não, cria-o
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Movendo o arquivo para o diretório de destino
        if (move_uploaded_file($imagemTmp, $imagemCaminho)) {
            // O upload foi bem-sucedido
        } else {
            // Falha no upload
            echo "Erro ao carregar a foto de perfil.";
            exit;
        }
    } else {
        // Define um caminho padrão caso nenhuma imagem tenha sido enviada
        $imagemCaminho = 'uploads/default.png';
    }

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO funcionarios (nome, email, funcao, foto_perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $nome, $email, $funcao, $imagemCaminho);

    if ($stmt->execute()) {
        // Cadastro bem-sucedido

        // Configurando o e-mail para o funcionário cadastrado
        $to = $email;
        $subject = "Cadastro de Funcionário - Sucesso!";
        $message = "
            Olá, $nome!
            
            Seu cadastro como funcionário foi realizado com sucesso. Sua função cadastrada é: $funcao.
            
            Caso tenha alguma dúvida, entre em contato com o RH.

            Atenciosamente,
            Equipe Hourly.
        ";
        $headers = "From: rh@empresa.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Enviando o e-mail
        if (mail($to, $subject, $message, $headers)) {
            echo "Funcionário cadastrado com sucesso. E-mail enviado para $email.";
        } else {
            echo "Funcionário cadastrado, mas houve um problema ao enviar o e-mail.";
        }

        // Redirecionar ou exibir uma mensagem de sucesso
        header("Location: home_dono.php");
        exit;
    } else {
        echo "Erro ao cadastrar funcionário: " . $conn->error;
    }

    // Fechando a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
