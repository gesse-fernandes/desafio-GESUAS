<?php

use app\Controllers\CitizenController;

include("includes/header.php");

?>

<main>
    <div class="container">
        <h1 class="display-4 text-center mt-5 text-dark">Lista de cidadãos</h1>


        <?php

        $nis = isset($_POST["pesquisar"]) ? $_POST["pesquisar"] : null;
        if (isset($nis)) {
            $homeController = new \app\Controllers\HomeController;
            $return = $homeController->pesquisar($nis);

            if (empty($return['citizens'][0]->getid())) {
                echo "<div class='alert alert-warning'>Cidadão não encontrado tentativa: " . $nis .  "</div>";
            } else {
                echo "<div class='alert alert-success'>Cidadão encontrado: " . $return['citizens'][0]->getName() . " NIS:" . $return['citizens'][0]->getNis() . "</div>";
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
    <table class="table tam ">
        <thead>
            <tr>
                <th scope="" class="text-white">#</th>
                <th scope="" class="text-white">Nome</th>
                <th scope="" class="text-white">NIS</th>
                <th scope="" class="text-white" width="100">Ações</th>
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
                            <a href="<?php INCLUDE_PATH ?>citizen?id=<?php echo $citizens->getid() ?>" class="btn btn-secondary">
                                Editar
                            </a>

                    </td>
                <?php
                        }
                ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php
        } else {


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
    <table class="table tam ">
        <thead>
            <tr>
                <th scope="" class="text-white">#</th>
                <th scope="" class="text-white">Nome</th>
                <th scope="" class="text-white">NIS</th>
                <th scope="" class="text-white" width="100">Ações</th>
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
                            <a href="<?php INCLUDE_PATH ?>citizen?id=<?php echo $citizens->getid() ?>" class="btn btn-secondary">
                                Editar
                            </a>

                    </td>
                <?php
                        }
                ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php } ?>
</main>

<?php
include("includes/footer.php");
?>