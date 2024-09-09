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
                        <input type="email" name="email" class="form-control" style="color: #13292A; background-color:#78CEBA;" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <p class="text-end mb-0">
                            Esqueceu sua <a href="index.php?p=9" style="color: #78CEBA;">Senha?</a>
                        </p>
                        <label for="senha" style="color: #13292A;">Senha</label>
                        <div class="input-group">
                            <input type="password" name="senha" class="form-control" style="color: #13292A; background-color:#78CEBA;" id="senha" placeholder="Password">
                            <div class="input-group-append">
                                <button type="button" class="btn" id="togglePassword" style="background-color:#78CEBA; color: #13292A; border: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input mt-2" style="background-color:#78CEBA; color: #13292A; border: none;" type="checkbox" value="" checked>
                        <label class="form-check-label mt-1" style="color: #13292A;" for="flexCheckChecked"> Lembre de mim
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;" class="btn mt-2 d-flex justify-content-center w-75">Logar</button>
                    </div>
                    <p class="text-center mt-1">
                        Ainda não tem uma conta? <a href="index.php?p=6" style="color: #78CEBA;" >Cadastre-se aqui!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const senhaInput = document.getElementById('senha');
        const icon = document.getElementById('togglePassword').querySelector('svg');
        const type = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
        senhaInput.setAttribute('type', type);
        if (type === 'password');
    });

    history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});
</script>
