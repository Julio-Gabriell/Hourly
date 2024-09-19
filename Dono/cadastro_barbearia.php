<?php

include_once "topo.php";

?>


<div class="container mt-5">
  <div class="row">
    <h4 style="color: #13292A;" class="text-center">
      Parabéns! Agora você irá representar uma barbearia em nosso sistema! <br>
      Atualize seus dados, com as informações da sua barbearia.
    </h4>
    <div class="col-md-4 offset-md-4">
      <div class="card-body">
        <form method="post" action="proc_cadastro_barbearia.php" id="loginForm">
          <div class="form-group">
            <label for="nome_barbearia" style="color: #13292A;">Nome da barbearia</label>
            <input type="text" name="nome_barbearia" required class="form-control"
              style="color: #13292A; background-color:#479D89; outline: none; box-shadow: none; border: none;"
              placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="cep" style="color: #13292A;">CEP da Barbearia</label>
            <div class="input-group">
              <input type="number" name="cep_barbearia" required class="form-control"
                style="color: #13292A; background-color:#479D89;  outline: none; box-shadow: none; border: none;"
                placeholder="CEP">
            </div>
          </div>
          <div class="form-group">
            <label for="num_barbearia" style="color: #13292A;">Numero da Barbearia</label>
            <div class="input-group">
              <input type="text" name="num_barbearia" required class="form-control"
                style="color: #13292A; background-color:#479D89;  outline: none; box-shadow: none; border: none;"
                placeholder="Ex: 420">
            </div>
          </div>
          <div class="form-group">
            <label for="tel_barbearia" style="color: #13292A;">Telefone da Barbearia</label>
            <div class="input-group">
              <input type="tel" id="tel_barbearia" name="tel_barbearia" pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}"
                required class="form-control"
                style="color: #13292A; background-color:#479D89;  outline: none; box-shadow: none; border: none;"
                placeholder="(XX) XXXXX-XXXX" maxlength="15">
            </div>
          </div>
          <div class="form-group">
            <label for="des_barbearia" style="color: #13292A;">Descrição da Barbearia</label>
            <div class="input-group">
              <input type="tel" name="des_barbearia" required class="form-control"
                style="color: #13292A; background-color:#479D89;  outline: none; box-shadow: none; border: none;"
                placeholder="Uma breve descrição da Barbearia">
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" style="background-color:#479D89; color: #13292A;"
              class="btn mt-2 d-flex justify-content-center w-75">Avançar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    document.getElementById('tel_barbearia').addEventListener('input', function (e) {
        let input = e.target;
        let value = input.value.replace(/\D/g, '');
        let formattedValue = '';

        if (value.length > 0) {
            formattedValue = '(' + value.substring(0, 2);
        }
        if (value.length >= 3) {
            formattedValue += ') ' + value.substring(2, 7);
        }
        if (value.length >= 8) {
            formattedValue += '-' + value.substring(7, 11);
        }

        input.value = formattedValue;
    });
</script>
<?php

include_once "rodape.php";

?>