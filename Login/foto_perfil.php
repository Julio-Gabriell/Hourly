<?php

  include_once "topo.php";

 ?>

 <div class="container mt-5">
     <div class="row">
         <div class="col-md-4 offset-md-4">
             <h1 style="color: #13292A;" class="text-center">
                 Foto de perfil
             </h1>
             <div class="card-body">
                 <div class="row d-flex justify-content-center mb-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                         style="color: #13292A; cursor: pointer;" class="bi bi-person-circle" viewBox="0 0 16 16" id="uploadIcon">
                         <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                         <path
                             d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                     </svg>
                 </div>
 
                 <form method="post" action="proc_perfil.php" id="PerfilForm" enctype="multipart/form-data">
                     <div class="form-group">
                         <input type="file" name="profile_picture" id="profile_picture" accept="image/*" style="display: none;">
                     </div>
                     <div class="d-flex justify-content-center">
                         <button type="submit" style="background-color:#78CEBA; color: #13292A;"
                             class="btn mt-2 d-flex w-75 justify-content-center">Salvar</button>
                     </div>
                 </form>
                 <div class="d-flex justify-content-center">
                 </div>
             </div>
         </div>
     </div>
 </div>
 
 <script>
     document.getElementById('uploadIcon').addEventListener('click', function() {
         document.getElementById('profile_picture').click();
     });
 </script>
 
 <?php
 
 include_once "rodape.php";
 
 ?>