<?php
include_once "topo.php";

$conn = new mysqli("localhost", "root", "", "fusca");

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

$user_id = $_SESSION['userID'];

$sql_dono = "SELECT nomeCompleto, email, foto_perfil FROM usuarios WHERE id = ?";
$stmt_dono = $conn->prepare($sql_dono);
$stmt_dono->bind_param("i", $user_id);
$stmt_dono->execute();
$result_dono = $stmt_dono->get_result();

if ($result_dono->num_rows > 0) {
  $dono = $result_dono->fetch_assoc();
  $nomeCompleto = $dono['nomeCompleto'];
  $email = $dono['email'];
  $foto_perfil = $dono['foto_perfil'] ? $dono['foto_perfil'] : "uploads/default.png";
} else {
  echo "Erro ao carregar os dados do dono.";
}

$stmt_dono->close();
?>
<div class="container">
  <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center">
    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
      <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Agende seu estilo, agilize seu dia: Hourly,
        onde cada horário é um passo para sua melhor aparência!</h1>
      <p class="lead pt-3">Hourly revoluciona o agendamento para barbearias,
        unindo clientes e profissionais em uma experiência inovadora.
        Com foco na excelência e facilidade de uso,
        conectamos comunidades locais e estabelecimentos de beleza.</p>
    </div>
    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
      <img class="rounded-lg-3" src="../Imgs/postezinho.png" alt="" width="500">
    </div>
  </div>
  <h1 style="color: #13292A;" class="text-center">
    Nosso Time
  </h1>
  <div class="container px-4 py-5">
    <div class="row g-3 row-cols-1 row-cols-md-3">
      <div class="col d-flex align-items-start">
        <div
          class="icon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
          <img style="object-fit: cover; border-radius: 50%;" src="../<?php echo $foto_perfil; ?>" alt="Foto de perfil"
            width="60" height="60">
        </div>
        <div>
          <?php

          $conn = new mysqli("localhost", "root", "", "fusca");

          if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
          }

          $barbeariaId = $_SESSION['barbearia_id'];

          $sql = "SELECT u.nomeCompleto, u.email 
        FROM usuarios u
        INNER JOIN barbearias b ON u.id = b.dono_id
        WHERE b.id = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $barbeariaId);
          $stmt->execute();
          $stmt->bind_result($nomeCompleto, $email);
          $stmt->fetch();
          $stmt->close();
          $conn->close();
          ?>

          <h3 class="fs-2 text-body-emphasis"><?php echo htmlspecialchars($nomeCompleto); ?></h3>
          <p>Dono | <?php echo htmlspecialchars($email); ?></p>
        </div>
      </div>
      <?php

      $conn = new mysqli("localhost", "root", "", "fusca");

      if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
      }

      $sql_func = "SELECT nome, email, foto_perfil, funcao FROM funcionarios";
      $result_func = $conn->query($sql_func);

      if ($result_func->num_rows > 0) {
        while ($func = $result_func->fetch_assoc()) {
          $nome = $func['nome'];
          $email = $func['email'];
          $foto_perfil = $func['foto_perfil'] ? $func['foto_perfil'] : "../uploads/default.png";
          $funcao = $func['funcao'];

          echo '
              <div class="col d-flex align-items-start">
                  <div class="icon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                      <img style="object-fit: cover; border-radius: 50%;" src="' . $foto_perfil . '" alt="Foto de perfil" width="60" height="60">
                  </div>
                  <div>
                      <h3 class="fs-2 text-body-emphasis">' . $nome . '</h3>
                      <p>Função: ' . $funcao . " | " . $email . '</p>
                  </div>
              </div>';
        }
      } else {
        echo "Nenhum funcionário encontrado.";
      }

      $conn->close();
      ?>
    </div>
  </div>
</div>
<?php
include_once "rodape.php";
?>