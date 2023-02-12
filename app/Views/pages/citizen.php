<?php

include("includes/header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if(isset($id)){
    $citizenController = new \app\Controllers\CitizenController();
    if($citizenController->existeId($id)){
        $citizen = $citizenController->pesquisar($id);
        
    }
?>
<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mt-5">
                <div class="jumbotron" style="background-color: white;">
                    <h1 class="text-center mt-5">Editar Cidadãos</h1>
                    <br>
                    <br>
                    <center>
                        <form action="" method="post" class="form-formulario" onsubmit="return validate()">
                            <div class="form-group">
                            <input type="text" name="id" value="<?php echo $citizen->getId() ?>" style="display: none;">
                                    
                                <span role="alert" id="nameError" aria-hidden="true">
                                    <div class='alert alert-danger'>Nome do Cidadão Obrigatório </div>
                                </span>
                               
                                <input type="text" class="form-control" class="form-input" id="name" name="name" value="<?php echo $citizen->getName() ?>">

                            </div>
                            
                            <input type="text"  class="form-control" value="NIS:<?php echo $citizen->getNis() ?>" disabled> 
                            <br>
                            <div class="d-flex justify-content-end">
                            <button type="submit" id="submit" name="acao" class="btn btn-primary">Atualizar</button>
                            <div style="padding: 10px;"></div>
                            <button type="submit" id="submit" onclick="confirm('Tem certeza que deseja excluir este dado?')" name="deletar" class="btn btn-danger">Deletar</button>
                            </div>
                            <input type="hidden" name="UpCid" >

                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
}else{
    ?>
<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mt-5">
                <div class="jumbotron"  style="background-color: white;">
                    <h3 class="text-center mt-5">Cadastro de Cidadãos</h1>
                    <br>
                    <br>
                    <center>
                        <form action="" method="post" class="form-formulario" onsubmit="return validate()">
                            <div class="form-group">
                                <span role="alert" id="nameError" aria-hidden="true">
                                    <div class='alert alert-danger'>Nome do Cidadão Obrigatório </div>
                                </span>
                                
                                <input type="text" class="form-control" placeholder="Informe o nome do cidadão" class="form-input" id="name" name="name">

                            </div>
                          
                            <button type="submit" id="submit" name="acao" class="btn btn-primary form-button">Cadastrar</button>
                            <input type="hidden" name="cadCid">

                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
</main>
    <?php
}
include("includes/footer.php");
?>