<?php

include("includes/header.php");

?>
<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mt-5">
                <div class="jumbotron">
                    <h1 class="text-center mt-5">Cadastro de Cidadãos</h1>
                    <br>
                    <br>
                    <center>
                        <form action="" method="post" class="form-formulario" onsubmit="return validate()">
                            <div class="form-group">
                                <span role="alert" id="nameError" aria-hidden="true">
                                    <div class='alert alert-danger'>Nome do Cidadão Obrigatório </div>
                                </span>
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" class="form-input" id="name" name="name">

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
<script>

 

    function validate() {
    

        const name = document.getElementById("name");

        if (!name.value) {
            const nameError = document.getElementById("nameError");
            nameError.classList.add("visible");
            
            nameError.setAttribute("aria-hidden", false);
            nameError.setAttribute("aria-invalid", true);
           return false;
        }
        return true;
    }

</script>
<?php
include("includes/footer.php");
?>