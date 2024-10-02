<?php

include_once "topo.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>

<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center ">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Agende seu estilo, agilize seu dia: Hourly,
                        onde cada horário é um passo para sua melhor aparência!</h1>
                <p class="lead pt-3">Hourly revoluciona o agendamento para barbearias,
                        unindo clientes e profissionais em uma experiência inovadora.
                        Com foco na excelência e facilidade de uso,
                        conectamos comunidades locais e estabelecimentos de beleza.</p>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
                <img class="rounded-lg-3" src="../Imgs/postezinho.png" alt="" width="500">
        </div>
</div>
</div>

<?php

include_once "rodape.php";

?>