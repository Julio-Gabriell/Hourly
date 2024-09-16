<?php

include_once("topo.php");

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 style="color: #13292A;" class="text-center">
                Perfil
            </h1>
            <div class="card-body">
                <div class="row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        style="color: #13292A;" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                </div>
                <form method="post" action="logout.php" id="faleForm">
                    <div class="form-group">
                        <label for="nomeFale" style="color: #13292A;">Mude Seu Nome</label>
                        <input type="text" name="nomeFale" class="form-control"
                            style="color: #13292A; background-color:#78CEBA;" id="nomeFale" placeholder="Primeiro Nome">
                    </div>
                    <div class="form-group">
                        <label for="emailFale" style="color: #13292A;">Mude Seu Email</label>
                        <input type="email" name="emailFale" class="form-control"
                            style="color: #13292A; background-color:#78CEBA;" id="emailFale" placeholder="Seu Email">
                    </div>
                    <p class="text-center mt-2">
                        Esqueceu sua <a href="index.php?p=6" style="color: #78CEBA;">Senha?</a>
                    </p>
                    <div class="d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                            class="btn mt-2 d-flex justify-content-center w-75" href="logout.php">Sair</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include_once("rodape.php");

?>