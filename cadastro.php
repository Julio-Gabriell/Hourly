<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 style="color: #13292A;" class="text-center">
                Cadastro
            </h1>
            <div class="card-body">
                <form method="post" action="proc_cadastro.php" id="loginForm">
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
                        <label for="cpf" style="color: #13292A;">CPF</label>
                        <div class="input-group">
                            <input type="text" name="cpf" id="cpf" required class="form-control" maxlength="14" 
                                style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                placeholder="000.000.000-00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha" style="color: #13292A;">Senha</label>
                        <div class="input-group">
                            <input type="password" name="senha1" required class="form-control"
                                style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                id="senha" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="btn" id="togglePassword"
                                    style="background-color:#78CEBA; color: #13292A; border: none; margin-left: 5px;"
                                    onclick="togglePasswordVisibility1()">
                                    <img src="Imgs/Eye.png" height="17" width="17" alt="" id="toggleImage1">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senha2" style="color: #13292A;">Confirmar Senha</label>
                        <div class="input-group">
                            <input type="password" name="senha2" required class="form-control"
                                style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                id="senha2" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="btn" id="togglePassword2"
                                    style="background-color:#78CEBA; color: #13292A; border: none; margin-left: 5px;"
                                    onclick="togglePasswordVisibility2()">
                                    <img src="Imgs/Eye.png" height="17" width="17" alt="" id="toggleImage2">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                            class="btn mt-2 d-flex justify-content-center w-75">Cadastrar</button>
                    </div>
                    <p class="text-center mt-1">
                        Já tem uma conta? <a href="index.php?p=5" style="color: #78CEBA;">Faça seu login!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility1() {
        var passwordField = document.getElementById('senha');
        var toggleImage = document.getElementById('toggleImage1');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleImage.src = "Imgs/Hide.png";
        } else {
            passwordField.type = "password";
            toggleImage.src = "Imgs/Eye.png";
        }
    }

    function togglePasswordVisibility2() {
        var passwordField = document.getElementById('senha2');
        var toggleImage = document.getElementById('toggleImage2');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleImage.src = "Imgs/Hide.png";
        } else {
            passwordField.type = "password";
            toggleImage.src = "Imgs/Eye.png";
        }
    }
</script>