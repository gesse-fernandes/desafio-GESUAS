<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>assets/css/style.css">
    <title>Aplicação de Cadastro de Cidadãos</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-nav-back">
        <div class="container">
            <a class="navbar-brand text-white" href="<?php echo INCLUDE_PATH; ?>"><img src="https://www.gesuas.com.br/wp-content/themes/gesuas/img/logo-gesuas.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MenuNavbar" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="MenuNavbar">
                <ul class="navbar-nav ml-auto mr-5">
                    <li class="nav-item active">
                        <a class="nav-link text-secondary" style="font-weight: bold;" href="home">Exibir Registros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" style="font-weight: bold;" href='citizen'>Cadastro de Cidadãos</a>
                    </li>



                </ul>
                <form class="form-inline my-2 my-lg-0" method="POST" onsubmit="return search()">

                    <input class="form-control mr-sm-2" name="pesquisar" id="pesquisar" type="search" placeholder="NIS:" aria-label="Pesquisar">

                    <button class="btn btn-success my-2 my-sm-0" " type=" submit">Pesquisar</button>
                    <span role="alert" id="pesquisaError" aria-hidden="true">

                    </span>
                </form>

            </div>
        </div>
    </nav>