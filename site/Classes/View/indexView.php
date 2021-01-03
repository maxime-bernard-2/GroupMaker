<?php

ob_start();
?>

    <div class="container mt-5 p-3" style="max-width: 40rem">
        <h1>Group Maker !</h1>
        <h2 class="fw-lighter fs-4 mb-5">le meilleur moyen de faire des groupes au pif</h2>
        <form action="fileUpload" method="post" enctype="multipart/form-data">
            <div class="row flex-row align-items-center justify-content-center">
                <input type="hidden" name="action" value="result">
                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <p class="alert alert-danger"><?php echo $_SESSION['message'] ?></p>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>
                <input class="form-control col mx-1 mb-3" type="file" id="formFile" name="file" accept=".xlsx" required>
                <div class="row p-0">
                    <input class="form-control col mx-1" type="number" inputmode="numeric" name="maxNumber" max="15" placeholder="Nombre d'élève par groupes" required>
                    <input class="btn btn-primary col-2 w-auto mx-1" type="submit" value="Lancer le calcul !">
                </div>

            </div>
        </form>
    </div>

<?php

$content = ob_get_clean(); // get current buffer contents and delete current output buffer
require 'templateView.php'; // using of template.php