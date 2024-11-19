<?php
// Inclui o cabeçalho
include_once "topo.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 style="color: #13292A;" class="text-center">
                Insira o código da barbearia comunicado pelo dono
            </h2>
            <form action="proc_contrato.php" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input id="codigo_barbeariaForm" name="codigo_barbeariaForm" placeholder="Código da barbearia"
                            class="form-control" type="text" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mt-2 d-flex justify-content-center">
                        <button type="submit" style="background-color:#78CEBA; color: #13292A;" class="btn w-75">
                            Confirmar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Inclui o rodapé
include_once "rodape.php";
?>