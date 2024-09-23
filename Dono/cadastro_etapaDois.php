<?php
include_once "topo.php";
?>
<div class="container mt-5">
  <h4 class="text-center" style="color: #13292A;">
    Escolha os dias em que sua Barbearia vai funcionar!
  </h4>
  <form method="post" action="proc_etapaDois.php" id="cadastro_etapaDois">
    <div class="d-flex justify-content-center">
      <div class="d-flex flex-column justify-content-center mt-4">
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="segunda" id="segunda" aria-label="Segunda">
          <label class="form-check-label mt-1" style="color: #13292A;" for="segunda">Segunda</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="terca" id="terca" aria-label="Terça">
          <label class="form-check-label mt-1" style="color: #13292A;" for="terca">Terça</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="quarta" id="quarta" aria-label="Quarta">
          <label class="form-check-label mt-1" style="color: #13292A;" for="quarta">Quarta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="quinta" id="quinta" aria-label="Quinta">
          <label class="form-check-label mt-1" style="color: #13292A;" for="quinta">Quinta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="sexta" id="sexta" aria-label="Sexta">
          <label class="form-check-label mt-1" style="color: #13292A;" for="sexta">Sexta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="sabado" id="sabado" aria-label="Sábado">
          <label class="form-check-label mt-1" style="color: #13292A;" for="sabado">Sábado</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" value="domingo" id="domingo" aria-label="Domingo">
          <label class="form-check-label mt-1" style="color: #13292A;" for="domingo">Domingo</label>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" style="background-color:#78CEBA; color: #13292A;"
            class="btn mt-2 d-flex justify-content-center w-75">Avançar</button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php
include_once "rodape.php";
?>
