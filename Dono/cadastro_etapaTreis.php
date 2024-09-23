<?php

include_once "topo.php";

?>
<div class="container">
  <h4 style="color: #13292A;" class="text-center">
    Preencha agora as informações sobre o funcionamento da Barbearia
  </h4>
  <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <div>
        <h3>
          Domingo
        </h3>
      </div>
      <form method="post" action="proc_etapaUm.php" id="cadastro_etapaDois">
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Segunda
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <div>
        <h3>
          Terça
        </h3>
      </div>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Quarta
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
  </div>
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Quinta
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Sexta
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Sabado
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã <input type="time" name="hora_inicio_manha"
            id="hora_inicio_manha" class=""> <span>até</span> <input type="time" name="hora_termino_manha"
            id="hora_manha" class=""> </label>
        <label class="d-flex justify-content-around"> Tarde <input type="time" name="hora_inicio_tarde"
            id="hora_inicio_tarde" class="" style="margin-left: 8px;"> <span>até</span> <input type="time"
            name="hora_termino_tarde" id="hora_tarde" class=""></label>
        <label class="d-flex justify-content-around"> Noite <input type="time" name="hora_inicio_noite"
            id="hora_inicio_noite" class="" style="margin-left: 9px;"> <span>até</span> <input type="time"
            name="hora_termino_noite" id="hora_noite" class=""></label>
      </ul>
    </div>
  </div>
  </form>
  <div class="d-flex flex-column">
  <h3 class="text-danger d-flex justify-content-center mt-5">
    ATENÇÃO
  </h3>
  <p class=" d-flex justify-content-center">
    Certifique-se de que os horarios estão de acordo com nosso modelo.
  </p>
  <p class=" d-flex justify-content-center">
    Se você não tiver invertalos nas trocas de turnos emende. (00:00 às 11:59 e 12:00 às 17:59).
  </p>
    <span class="d-flex flex-column justify-content-center">
      <h5>Turno Manhã (00:00 às 11:59)</h5>
      <h5>Turno Tarde (12:00 às 17:59)</h5>
      <h5>Turno Noite (18:00 às 23:59)</h5>
    </span>
  </div>
  </div>
</div>
<?php

include_once "rodape.php";

?>