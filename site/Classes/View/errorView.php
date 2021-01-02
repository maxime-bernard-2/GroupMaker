<?php

ob_start();
?>

    <div class="container d-flex justify-content-center align-items-center mt-5 p-3">
        <img class="me-5" src="/public/images/lost.gif" alt="">
        <div>
            <h1 class="fw-bold fs-1">Erreur 404</h1>
            <p class="fs-5">La page que vous recherchez n'existe pas/plus.</p>
            <p class="fs-5">Revenez a l'accueil en cliquant
                <a href="/">
                    <button class="btn btn-primary m-1 px-2 py-1">ICI
                    </button>
                </a>
            </p>
        </div>
    </div>

<?php

$content = ob_get_clean(); // get current buffer contents and delete current output buffer
require 'templateView.php'; // using of template.php