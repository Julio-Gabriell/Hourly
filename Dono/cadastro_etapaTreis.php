<?php include_once "topo.php"; 

if (isset($_SESSION['dias_funcionamento'])) {
  $dias_selecionados = $_SESSION['dias_funcionamento'];
} else {
  header("Location: cadastro_etapaDois.php");
  exit();
}

?>
<div class="container">
  <h4 style="color: #13292A;" class="text-center">
    Preencha agora as informações sobre o funcionamento da Barbearia
  </h4>
  <p class="d-flex justify-content-center">
    Se você não tiver intervalos nas trocas de turnos, emende. (Ex: 08:00 às 11:59 e 12:00 às 17:59).
  </p>
  <div class="d-flex flex-column justify-content-center align-items-center mt-3">
    <h5>Turno da Manhã (00:00 às 11:59)</h5>
    <h5>Turno da Tarde (12:00 às 17:59)</h5>
    <h5>Turno da Noite (18:00 às 23:59)</h5>
  </div>

  <form method="post" action="proc_etapaTreis.php" id="cadastro_etapaTreis">
    <?php foreach ($dias_selecionados as $dia): ?>
      <div class="d-flex flex-column align-items-center gap-2 mt-2">
        <h3><?php echo ucfirst($dia); ?>:</h3>
        <div class="dropdown">
          <button type="button" class="btn dropdown-toggle"
            style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
            aria-expanded="false">
            Horários
          </button>
          <ul class="dropdown-menu p-1" style="width: 300px;">
            <label class="d-flex justify-content-around"> Manhã
              <input type="time" name="hora_inicio_manha_<?php echo $dia; ?>" id="hora_inicio_manha_<?php echo $dia; ?>">
              <span>até</span>
              <input type="time" name="hora_termino_manha_<?php echo $dia; ?>" id="hora_termino_manha_<?php echo $dia; ?>">
            </label>
            <label class="d-flex justify-content-around"> Tarde
              <input type="time" name="hora_inicio_tarde_<?php echo $dia; ?>" id="hora_inicio_tarde_<?php echo $dia; ?>"
                style="margin-left: 8px;">
              <span>até</span>
              <input type="time" name="hora_termino_tarde_<?php echo $dia; ?>" id="hora_termino_tarde_<?php echo $dia; ?>">
            </label>
            <label class="d-flex justify-content-around"> Noite
              <input type="time" name="hora_inicio_noite_<?php echo $dia; ?>" id="hora_inicio_noite_<?php echo $dia; ?>"
                style="margin-left: 9px;">
              <span>até</span>
              <input type="time" name="hora_termino_noite_<?php echo $dia; ?>" id="hora_termino_noite_<?php echo $dia; ?>">
            </label>
          </ul>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="d-flex justify-content-center mt-4">
      <button type="submit" style="background-color:#479D89; color: #13292A;"
        class="btn mt-2 d-flex justify-content-center">
        Cadastrar Horários
      </button>
    </div>
  </form>
</div>
<?php include_once "rodape.php"; ?>