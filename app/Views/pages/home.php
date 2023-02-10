<?php

include("includes/header.php");

?>

<main>
<div class="container">
    <h1 class="display-4 text-center mt-5">Lista de Cidadãos</h1>
</div>
</main>

<table class="table table-dark ">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>NIS</th>
        <th width="200">Ações</th>
    </tr>
    </thead>
    <tbody>
        <?php
         foreach($array as $citizens): ?>
          <tr>
         <td>
            <?php echo $citizens->getid() ?>
         </td>
         <td>
            <?php echo $citizens->getName() ?>
         </td>
         <td>
            <?php echo $citizens->getNis() ?>
         </td>
         <td>
          <a href="#"  class="btn btn-info">
            Editar
          </a>
          <button class="btn btn-danger">
            Deletar
          </button>
        </td>
         </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>

<?php
include("includes/footer.php");
?>
