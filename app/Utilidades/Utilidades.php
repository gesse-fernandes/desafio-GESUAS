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

    public function alerta($mensagem){
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
}
