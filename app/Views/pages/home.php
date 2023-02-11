<?php

include("includes/header.php");

?>

<main>
    <div class="container">
        <h1 class="display-4 text-center mt-5">Lista de cidadãos</h1>


<?php
 
$nis = isset($_POST["pesquisar"]) ? $_POST["pesquisar"] : null;
    if(isset($nis)){
      $homeController = new \app\Controllers\HomeController;
      $return = $homeController->pesquisar($nis);

      if(empty($return['citizens'][0]->getid())){
        echo '<div class="alert alert-warning">Cidadão não encontrado</div>';
      }else{
        echo '<div class="alert alert-success">Cidadão encontrado</div>';
      }
   
      ?>
      <nav aria-label="Navegação de página">
      <?php
      $page = $return['pagina_atual'];
      if ($page < 1) {
          $page = 1;
      }
      ?>
      <ul class="pagination justify-content-center">
          <li class="page-item <?php if ($page <= 1) {
                                      echo 'disabled';
                                  } ?>">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>">Anterior</a>
          </li>
  
          <?php for ($i = 1; $i <= $return['total_paginas']; $i++) : ?>
              <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
          <?php endfor; ?>
          <li class="page-item <?php if ($page >= $return['total_paginas']) {
                                      echo 'disabled';
                                  } ?>">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>">Próximo</a>
          </li>
  
      </ul>
  </nav>
  
  </div>
  <table class="table table-dark tam ">
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
  
          foreach ($return['citizens'] as $citizens) : ?>
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
                      <?php
                      if ($citizens->getid()) {
                      ?>
                          <a href="#" class="btn btn-info">
                              Editar
                          </a>
                          <button class="btn btn-danger">
                              Deletar
                          </button>
                  </td>
              <?php
                      }
              ?>
              </tr>
          <?php endforeach; ?>
  
      </tbody>
  </table>
  <?php
    }else{

    
?>
<nav aria-label="Navegação de página">
    <?php
    $page = $array['pagina_atual'];
    if ($page < 1) {
        $page = 1;
    }
    ?>
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page <= 1) {
                                    echo 'disabled';
                                } ?>">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Anterior</a>
        </li>

        <?php for ($i = 1; $i <= $array['total_paginas']; $i++) : ?>
            <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?php if ($page >= $array['total_paginas']) {
                                    echo 'disabled';
                                } ?>">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Próximo</a>
        </li>

    </ul>
</nav>

</div>
<table class="table table-dark tam ">
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

        foreach ($array['citizens'] as $citizens) : ?>
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
                    <?php
                    if ($citizens->getid()) {
                    ?>
                        <a href="#" class="btn btn-info">
                            Editar
                        </a>
                        <button class="btn btn-danger">
                            Deletar
                        </button>
                </td>
            <?php
                    }
            ?>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?php }?>
</main>
<?php
include("includes/footer.php");
?>