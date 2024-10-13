<?php include_once "topo.php"; ?>

<div class="container py-3">
  <main>
    <h1 style="color: #13292A;" class="text-center mb-3">
      Planos
    </h1>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Bronze</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$10</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Pode cadastrar até 3 funcionarios</li>
              <li>Pode cadastrar até 10 serviços</li>
            </ul>
            <a href="bronze.php">
              <button type="button" class="w-100 btn btn-lg btn-outline-primary"
                style="background-color: #78CEBA; color: #13292A; border: none;">Adquirir Plano</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Prata</h4>
          </div>
          <div class="card-body">
          <h1 class="card-title pricing-card-title">$15</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Pode cadastrar até 5 funcionarios</li>
              <li>Pode cadastrar até 15 serviços</li>
            </ul>
            <a href="prata.php">
              <button type="button" class="w-100 btn btn-lg btn-outline-primary"
                style="background-color: #78CEBA; color: #13292A; border: none;">Adquirir Plano</button>
            </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Ouro</h4>
          </div>
          <div class="card-body">
          <h1 class="card-title pricing-card-title">$20</h1>
            <ul class="list-unstyled mt-3 mb-4">
            <li>Pode cadastrar infinitos funcionarios</li>
            <li>Pode cadastrar infinitos serviços</li>
            </ul>
            <a href="ouro.php">
              <button type="button" class="w-100 btn btn-lg btn-outline-primary"
                style="background-color: #78CEBA; color: #13292A; border: none;">Adquirir Plano</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<?php include_once "rodape.php"; ?>