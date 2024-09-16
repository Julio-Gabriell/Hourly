<!-- 

<div class="container mt-5">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h2 class="text-center">Refaça sua senha</h2>
      <p class="text-center">Insira sua nova senha.</p>
        <form id="esqueceu-form" action="proc_redefine_senha.php" role="form" required class="form" method="post">
          <div class="form-group">
            <div class="input-group">
              <input id="email" name="email" placeholder="Email" class="form-control" type="email">
            </div>
           </div>
          <div class="form-group">
            <div class="row mt-2">
              <input name="recover-submit" class="btn d-flex justify-content-center"
                style="background-color:#78CEBA; color: #13292A; border: none;" type="submit">
            </div>
        </form>
      </div>
    </div>
  </div> -->

  <form action="proc_redefine_senha.php" method="post">
    <input type="hidden" name="token" value="<?php // echo $_GET['token']; ?>">
    <input type="password" name="nova_senha" placeholder="Nova Senha" required>
    <button type="submit">Redefinir Senha</button>
</form>