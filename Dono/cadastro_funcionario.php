<?php

include_once "topo.php";

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 style="color: #13292A;" class="text-center">
                Cadastro de funcionarios
                </h1>
                <div class="card-body">
                    <form method="post" action="proc_cadastroFuncionarios.php" id="cadastroFuncionariosForm"
                        enctype="multipart/form-data">
                        <div class="row d-flex justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                                style="color: #13292A; cursor: pointer;" class="bi bi-person-circle" viewBox="0 0 16 16"
                                id="uploadIcon">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </div>
                        <div class="form-group">
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="nome" style="color: #13292A;">Nome</label>
                            <input type="text" name="nome" required class="form-control"
                                style="color: #13292A; background-color:#78CEBA; outline: none; box-shadow: none; border: none;"
                                placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="email" style="color: #13292A;">E-mail</label>
                            <div class="input-group">
                                <input type="email" name="email" required class="form-control"
                                    style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="funcao" style="color: #13292A;">Função</label>
                            <div class="input-group">
                                <input type="text" name="funcao" required class="form-control"
                                    style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                    id="funcao" placeholder="Função">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                                class="btn mt-2 d-flex justify-content-center w-75">Cadastrar</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('uploadIcon').addEventListener('click', function () {
        document.getElementById('profile_picture').click();
    });
</script>

<?php

include_once "rodape.php";

?>