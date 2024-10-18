<?php

include_once "topo.php";

$nomeCompleto = $_SESSION['nomeCompleto'];
$email = $_SESSION['email'];

?>
<div class="container">
  <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center ">
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
          <?php
          $user_id = $_SESSION['userID'];
          $conn = new mysqli("localhost", "root", "", "hourly_bd");

          $sql = "SELECT foto_perfil FROM usuarios WHERE id=$user_id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foto_perfil = $row['foto_perfil'];

            if ($foto_perfil == null || $foto_perfil == "") {
              $foto_perfil = "uploads/default.png";
            }

            echo '<img style="object-fit: cover; border-radius: 50%;" src="../' . $foto_perfil . '" alt="Foto de perfil" width="60" height="60">';
          } else {
            echo "Erro ao carregar a foto de perfil.";
          }

          $conn->close();
          ?>
        </div>
        <div>
          <h3 class="fs-2 text-body-emphasis"><?php echo $nomeCompleto; ?></h3>
          <p>Dono | <?php echo $email; ?></p>
        </div>
      </div>
      <?php

      $conn = new mysqli("localhost", "root", "", "hourly_bd");

      $sql = "SELECT nome, email, foto_perfil, funcao FROM funcionarios";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $nome = $row['nome'];
          $email = $row['email'];
          $foto_perfil = $row['foto_perfil'];
          $funcao = $row['funcao'];

          if ($foto_perfil == null || $foto_perfil == "") {
            $foto_perfil = "../uploads/default.png";
          }

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
        echo "";
      }

      $conn->close();
      ?>

    </div>
    <h3 class="d-flex justify-content-center">
      Adicionar funcionarios
    </h3>
    <a href="cadastro_funcionario.php" class="d-flex justify-content-center">
      <img src="../Imgs/Contratação.png" alt="" width="60" height="60">
    </a>
    <h3 class="d-flex justify-content-center">
      Demitir funcionarios
    </h3>
    <a href="demissao_funcionario.php" class="d-flex justify-content-center">
      <img src="../Imgs/Demissão.png" alt="" width="60" height="60">
    </a>
  </div>
</div>
<?php

include_once "rodape.php";

?>