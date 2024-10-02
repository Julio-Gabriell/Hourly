<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Diretório onde as imagens de perfil serão armazenadas
    $target_dir = __DIR__ . "/../uploads/";
    
    // Caminho completo do arquivo de upload (com o nome original)
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    
    // Verifica o tipo de arquivo (extensão)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Flag para verificar se o upload deve ser processado
    $uploadOk = 1;

    // Verifica se o arquivo é realmente uma imagem

    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    // Verifica se o arquivo já existe
    if (file_exists($target_file)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    // Limita o tamanho do arquivo (2MB)
    if ($_FILES["profile_picture"]["size"] > 2000000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permite apenas determinados formatos de arquivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.";
        $uploadOk = 0;
    }

    // Verifica se ocorreu algum erro
    if ($uploadOk == 0) {
        echo "Desculpe, o arquivo não foi enviado.";
    } else {
        // Tenta mover o arquivo enviado para o diretório de destino
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "O arquivo " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " foi enviado com sucesso.";
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}

?>
