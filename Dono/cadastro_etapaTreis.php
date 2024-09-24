<?php

include_once "topo.php";

?>
<div class="container">
  <h4 style="color: #13292A;" class="text-center">
    Preencha agora as informações sobre o funcionamento da Barbearia
  </h4>
  <div class="d-flex flex-column justify-content-center align-items-center mt-3">
      <h5>Turno da Manhã (00:00 às 11:59)</h5>
      <h5>Turno da Tarde (12:00 às 17:59)</h5>
      <h5>Turno da Noite (18:00 às 23:59)</h5>
      <p class=" d-flex justify-content-center">
    Se você não tiver invertalos nas trocas de turnos emende. (08:00 às 11:59 e 12:00 às 17:59).
  </p>
    </div>
  <div class="d-flex justify-content-center align-items-center mt-2">
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <div>
        <h3>
          Segunda
        </h3>
      </div>
      <form method="post" action="proc_etapaTreis.php" id="cadastro_etapaTreis">
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_segunda" id="hora_inicio_manha_segunda">
            <span>até</span>
          <input type="time" name="hora_termino_manha_segunda" id="hora_termino_manha_segunda">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_segunda" id="hora_inicio_tarde_segunda" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_segunda" id="hora_termino_tarde_segunda">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_segunda" id="hora_inicio_noite_segunda" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_segunda" id="hora_termino_noite_segunda">
        </label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <h3>
        Terça
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_terca" id="hora_inicio_manha_terca">
            <span>até</span>
          <input type="time" name="hora_termino_manha_terca" id="hora_termino_manha_terca">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_terca" id="hora_inicio_tarde_terca" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_terca" id="hora_termino_tarde_terca">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_terca" id="hora_inicio_noite_terca" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_terca" id="hora_termino_noite_terca">
        </label>
      </ul>
    </div>
    <div class="d-flex flex-row gap-2 mt-2 ms-5">
      <div>
        <h3>
          Quarta
        </h3>
      </div>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_quarta" id="hora_inicio_manha_quarta">
            <span>até</span>
          <input type="time" name="hora_termino_manha_quarta" id="hora_termino_manha_quarta">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_quarta" id="hora_inicio_tarde_quarta" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_quarta" id="hora_termino_tarde_quarta">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_quarta" id="hora_inicio_noite_quarta" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_quarta" id="hora_termino_noite_quarta">
        </label>
      </ul>
    </div>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-1">
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
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_quinta" id="hora_inicio_manha_quinta">
            <span>até</span>
          <input type="time" name="hora_termino_manha_quinta" id="hora_termino_manha_quinta">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_quinta" id="hora_inicio_tarde_quinta" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_quinta" id="hora_termino_tarde_quinta">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_quinta" id="hora_inicio_noite_quinta" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_quinta" id="hora_termino_noite_quinta">
        </label>
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
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_sexta" id="hora_inicio_manha_sexta">
            <span>até</span>
          <input type="time" name="hora_termino_manha_sexta" id="hora_termino_manha_sexta">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_sexta" id="hora_inicio_tarde_sexta" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_sexta" id="hora_termino_tarde_sexta">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_sexta" id="hora_inicio_noite_sexta" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_sexta" id="hora_termino_noite_sexta">
        </label>
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
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_sabado" id="hora_inicio_manha_sabado">
            <span>até</span>
          <input type="time" name="hora_termino_manha_sabado" id="hora_termino_manha_sabado">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_sabado" id="hora_inicio_tarde_sabado" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_sabado" id="hora_termino_tarde_sabado">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_sabado" id="hora_inicio_noite_sabado" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_sabado" id="hora_termino_noite_sabado">
        </label>
      </ul>
    </div>
    </div>
    <div class="d-flex flex-row gap-2 mt-2  justify-content-center">
      <h3>
        Domingo
      </h3>
      <button type="button" class="btn dropdown-toggle dropdown-toggle-split"
        style="background-color: #479D89; border: none; color: #13292A;" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
        Horarios
      </button>
      <ul class="dropdown-menu p-1" style="width: 300px;">
        <label class="d-flex justify-content-around"> Manhã 
          <input type="time" name="hora_inicio_manha_domingo" id="hora_inicio_manha_domingo">
            <span>até</span>
          <input type="time" name="hora_termino_manha_domingo" id="hora_termino_manha_domingo">
        </label>
        <label class="d-flex justify-content-around"> Tarde
          <input type="time" name="hora_inicio_tarde_domingo" id="hora_inicio_tarde_domingo" style="margin-left: 8px;">
            <span>até</span>
          <input type="time" name="hora_termino_tarde_domingo" id="hora_termino_tarde_domingo">
          </label>
        <label class="d-flex justify-content-around"> Noite 
          <input type="time" name="hora_inicio_noite_domingo" id="hora_inicio_noite_domingo" style="margin-left: 9px;">
            <span>até</span>
          <input type="time" name="hora_termino_noite_domingo" id="hora_termino_noite_domingo">
        </label>
      </ul>
    </div>
  </div>
  <div class="d-flex justify-content-center mt-4">
                        <button type="submit" style="background-color:#479D89; color: #13292A;"
                            class="btn mt-2 d-flex justify-content-center">Cadastrar Horarios</button>
                    </div>
  </form>

  <!-- <div class="d-flex flex-column">
  <h3 class="text-danger d-flex justify-content-center mt-5">
    ATENÇÃO
  </h3>
  <p class=" d-flex justify-content-center">
    Certifique-se de que os horarios estão de acordo com nosso modelo.
  </p>
  </div> -->
  </div>
</div>
<?php

include_once "rodape.php";

?>