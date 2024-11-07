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
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="segunda" value="segunda" id="segunda">
          <label class="form-check-label mt-1" for="segunda">Segunda</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="terca" value="terca" id="terca">
          <label class="form-check-label mt-1" for="terca">Terça</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="quarta" value="quarta" id="quarta">
          <label class="form-check-label mt-1" for="quarta">Quarta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="quinta" value="quinta" id="quinta">
          <label class="form-check-label mt-1" for="quinta">Quinta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="sexta" value="sexta" id="sexta">
          <label class="form-check-label mt-1" for="sexta">Sexta</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="sabado" value="sabado" id="sabado">
          <label class="form-check-label mt-1" for="sabado">Sábado</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none; box-shadow: none;" type="checkbox" name="domingo" value="domingo" id="domingo">
          <label class="form-check-label mt-1" for="domingo">Domingo</label>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn mt-2 d-flex justify-content-center w-75" style="background-color:#78CEBA; color: #13292A;">
            Avançar
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
<?php

include_once "rodape.php";

?>