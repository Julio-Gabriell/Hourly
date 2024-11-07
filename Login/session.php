<?php
function verificarLogin()
{
    session_start();
    
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== TRUE) {
        header("Location: ../index.php");
        exit();
    }
    
    $cargo = $_SESSION['cargo'];
    
    if ($cargo === 'cliente') {
        header("Location: home_logado.php");
        exit();
    } elseif ($cargo === 'funcionario') {
        header("Location: ../Barbeiro/home_barbeiro.php");
        exit();
    } elseif ($cargo === 'dono') {
        // Verificação do cadastro da barbearia
        $dono_id = $_SESSION['user_id']; // Assumindo que o ID do dono está na sessão
        include 'conexao.php'; // Inclua seu arquivo de conexão com o banco de dados
        
        $query = "SELECT COUNT(*) as barbearia_cadastrada FROM negocio WHERE dono_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $dono_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['barbearia_cadastrada'] > 0) {
            header("Location: ../Dono/home_dono.php");
        } else {
            header("Location: cadastro_etapaUM.php"); // Redireciona para o cadastro da barbearia
        }
        exit();
    }
}
?>
