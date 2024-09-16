<?php include_once "topo.php" ?>

<div class="d-flex justify-content-between align-items-center">
  <input type="search" class="form-control me-3" style="color: #13292A;" placeholder="Search..." aria-label="Search">
  <div class="btn-group">
    <button class="btn btn-secondary btn-sm" style="background-color: #78CEBA; border: none; color: #13292A;"
      type="button">
      Filtro
    </button>
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
      style="background-color: #78CEBA; border: none; color: #13292A;" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu p-1">
      <!-- Se houver algum texto aqui, adicione a cor também -->
    </ul>
  </div>
</div>
<a href="agende.php" class="text-decoration-none">
  <div class="p-md-5 mt-4 mb-4 rounded d-flex justify-content-between"
    style="background-color:#78CEBA; color: #13292A;">
    <img class="rounded bg-white" style="object-fit: cover;" src="../Imgs/icon.ico" alt="" width="150"
      height="150"></img>
    <div class="col d-flex align-items-start">
      <div
        class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3"
        style="color: #13292A;">
      </div>
      <div>
        <h3 class="fs-2 text-body-emphasis text-sm-end" style="color: #13292A;">Barbearia Parchola</h3>
        <p class="text-sm-end" style="color: #13292A;">Paragraph of text beneath the heading to explain the heading.
          We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
        <div class="d-flex justify-content-center pt-3 gap-3" style="color: #13292A;">
          <img src="../Imgs/zap.png" alt="" width="24" height="24"> (14) 98808-7424
          <img src="../Imgs/home.png" alt="" width="24" height="24"> R. Treze de Maio
        </div>
      </div>
    </div>
  </div>
</a>
<?php include_once "rodape.php" ?>