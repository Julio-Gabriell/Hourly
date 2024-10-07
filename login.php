<?php 
session_start();
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 style="color: #13292A;" class="text-center">
                Login
            </h1>
            <div class="card-body">
                <form method="post" action="proc_login.php" id="loginForm">
                    <div class="form-group">
                        <label for="email" style="color: #13292A;">Email</label>
                        <input type="email" name="email" class="form-control"
                            style="color: #13292A; background-color:#78CEBA; outline: none; box-shadow: none; border: none;"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <p class="text-end mb-0">
                            Esqueceu sua <a href="index.php?p=9" style="color: #78CEBA;">Senha?</a>
                        </p>
                        <label for="senha" style="color: #13292A;">Senha</label>
                        <div class="input-group">
                            <input type="password" name="senha" class="form-control"
                                style="color: #13292A; background-color:#78CEBA;  outline: none; box-shadow: none; border: none;"
                                id="senha" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="btn" id="togglePassword"
                                    style="background-color:#78CEBA; color: #13292A; border: none; margin-left: 5px;"
                                    onclick="togglePasswordVisibility()">
                                    <img src="Imgs/Eye.png" height="17" width="17" alt="" id="toggleImage">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mt-2"
                            style="background-color:#78CEBA; color: #13292A; border: none;" type="checkbox" value=""
                            checked>
                        <label class="form-check-label mt-1" style="color: #13292A;" for="flexCheckChecked"> Lembre de
                            mim
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                            class="btn mt-2 d-flex justify-content-center w-75">Logar</button>
                    </div>
                    <p class="text-center mt-1">
                        Ainda não tem uma conta? <a href="index.php?p=6" style="color: #78CEBA;">Cadastre-se aqui!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById('senha');
        var toggleImage = document.getElementById('toggleImage');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleImage.src = "Imgs/Hide.png";
        } else {
            passwordField.type = "password";
            toggleImage.src = "Imgs/Eye.png";
        }
    }
</script>