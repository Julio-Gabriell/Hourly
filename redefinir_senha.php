

<div class="container mt-5">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h2 class="text-center">Redefina a sua senha</h2>
      <p class="text-center">Insira sua nova senha.</p>
        <form action="proc_redefine_senha.php" role="form" required class="form" method="post">
          <div class="form-group">
            <div class="input-group">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
              <input id="nova_senha" name="nova_senha" placeholder="Sua nova senha" class="form-control" type="password">
            </div>
           </div>
          <div class="form-group">
            <div class="row mt-2 d-flex justify-content-center">
            <button type="submit" style="background-color:#78CEBA; color: #13292A;"
            class="btn mt-2 d-flex justify-content-center w-75">Redefinir</button> 
            </div>
        </form>
      </div>
    </div>
  </div>
