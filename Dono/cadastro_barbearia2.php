<?php

include_once "topo.php";

?>
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
    <ul class="dropdown-menu p-1" style="width: 300px;">
      <label for=""> Manhã <input type="time" name="" id=""> <span>até</span> <input type="time" name="" id=""> </label>      
      
    </ul>
  </div>
</div> 
<?php

include_once "rodape.php";

?>