<?php

include_once "topo.php";

$nomeCompleto = $_SESSION['nomeCompleto'];

$user_id = $_SESSION['userID'];

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 style="color: #13292A;" class="text-center">
            Olá, <?php echo $nomeCompleto; ?>
            </h1>
            <div class="card-body">
                <form method="post" action="proc_perfil.php" id="faleForm">
                    <div class="form-group">
                        <label for="nomeFale" style="color: #13292A;">Mude Seu Nome</label>
                        <input type="text" name="nomeFale" required class="form-control"
                            style="color: #13292A; background-color:#78CEBA; outline: none; box-shadow: none; border: none;"
                            id="nomeFale" placeholder="Primeiro Nome">
                    </div>
                    <div class="form-group">
                        <label for="emailFale" style="color: #13292A;">Mude Seu Email</label>
                        <input type="email" name="emailFale" required class="form-control"
                            style="color: #13292A; background-color:#78CEBA; outline: none; box-shadow: none; border: none;"
                            id="emailFale" placeholder="Seu Email">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                            class="btn mt-2 d-flex w-75 justify-content-center">Salvar</button>
                    </div>
                    <p class="text-center">
                        Esqueceu sua <a href="esqueceu_senha.php" style="color: #78CEBA;">Senha?</a>
                    </p>
                    <p class="text-center">
                        Quer escolher sua foto de <a href="foto_perfil.php" style="color: #78CEBA;">Perfil?</a>
                    </p>
                </form>
                <div class="d-flex justify-content-center">
                    <a href="logout.php">
                        <button type="button" class="btn btn-lg btn-primary"
                            style="background-color:#78CEBA; color: #13292A; border: none;">Sair</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once "rodape.php";

?>
