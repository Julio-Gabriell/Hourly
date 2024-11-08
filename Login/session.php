<?php
function verificarLogin()
{
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: ../index.php");
        exit();
    }

    // Verifica se o cargo está definido na sessão
    if (!isset($_SESSION['cargo'])) {
        header("Location: ../index.php");
        exit();
    }

    $cargo = $_SESSION['cargo'];
    $paginaAtual = basename($_SERVER['PHP_SELF']); // Obtém o nome da página atual

    // Verifica se o redirecionamento inicial foi feito
    if (!isset($_SESSION['paginaInicialAcessada'])) {
        if ($cargo === 'cliente') {
            if ($paginaAtual !== 'home_logado.php') {
                $_SESSION['paginaInicialAcessada'] = true;
                header("Location: ../Login/home_logado.php");
                exit();
            }
        } elseif ($cargo === 'funcionario') {
            if ($paginaAtual !== 'home_barbeiro.php') {
                $_SESSION['paginaInicialAcessada'] = true;
                header("Location: ../Barbeiro/home_barbeiro.php");
                exit();
            }
        } elseif ($cargo === 'dono') {
            // Verifica se o dono já está na página correta ou se já foi redirecionado
            if (!in_array($paginaAtual, ['home_dono.php', 'cadastro_etapaUM.php'])) {
                // Verificação do cadastro da barbearia
                $dono_id = $_SESSION['userID'];
                include '../conexao.php';
                
                $query = "SELECT COUNT(*) as barbearia_cadastrada FROM barbearias WHERE dono_id = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("i", $dono_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
                $con->close();

                if ($row['barbearia_cadastrada'] > 0) {
                    $_SESSION['paginaInicialAcessada'] = true;
                    header("Location: ../Dono/home_dono.php");
                } else {
                    $_SESSION['paginaInicialAcessada'] = true;
                    header("Location: cadastro_etapaUM.php");
                }
                exit();
            }
        }
    }
}
?>
