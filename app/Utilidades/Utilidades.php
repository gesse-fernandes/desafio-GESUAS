<?php 
namespace app\Utilidades;

class Utilidades{

    public function redirect($url){;
        echo '<script>
        setTimeout(function() {
        window.location.href="' . $url . '"
    }, 3000);
        </script>';
       
    }

    public function alertaAdd($mensagem){
echo "

<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='myModalLabel'>Adcionado com sucesso</h5>
      </div>
      <div class='modal-body alert alert-success' >
        Adcionado $mensagem com sucesso!
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-success' data-dismiss='modal'>Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#myModal').modal('show');
  });
</script>

";

    }
    public function alertaDelete($mensagem){
      echo "

      <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='myModalLabel'>Deletado</h5>
            </div>
            <div class='modal-body alert alert-danger' >
              $mensagem
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar</button>
            </div>
          </div>
        </div>
      </div>
      
      <script>
        $(document).ready(function () {
          $('#myModal').modal('show');
        });
      </script>
      
      ";
    }
    public function alertaUp($mensagem){
      echo "

      <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='myModalLabel'>Atualizado com Sucesso</h5>
            </div>
            <div class='modal-body alert alert-primary' >
              $mensagem
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-primary' data-dismiss='modal'>Fechar</button>
            </div>
          </div>
        </div>
      </div>
      
      <script>
        $(document).ready(function () {
          $('#myModal').modal('show');
        });
      </script>
      
      ";
    }
    public function erro($mensagem){
      echo "

      <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='myModalLabel'>Tente Novamente</h5>
            </div>
            <div class='modal-body alert alert-dark' >
              $mensagem
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-dark' data-dismiss='modal'>Fechar</button>
            </div>
          </div>
        </div>
      </div>
      
      <script>
        $(document).ready(function () {
          $('#myModal').modal('show');
        });
      </script>
      
      ";
    }
}
