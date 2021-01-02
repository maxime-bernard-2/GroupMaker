<?php

ob_start();
?>
    <div class="mt-5 container d-flex flex-wrap align-items-start justify-content-center">
        <?php
        for ($i = 1; $i <= $_SESSION['pool']->getGroupNumber(); $i++) {
            ?>
            <div class="card m-2">
                <div class="card-header d-flex justify-content-center">
                    Groupe <?php echo $i ?>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    foreach($_SESSION['pool']->getStudentArray() as $student) {
                        if($student->getGroup() == $i) {
                            ?>
                            <li class="list-group-item d-flex justify-content-center">
                                <?php
                                echo $student->getFirstName() . " " . $student->getSecondName()
                                ?>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="m-5 d-flex align-items-center justify-content-center flex-wrap">
        <a href="getDoc">
            <button class="btn btn-primary m-2 d-flex align-items-center">Telecharger en XLSX
                <i class="far fa-file-word ms-3 fa-2x"></i>
            </button>
        </a>
        <a href="share">
            <button class="btn btn-primary m-2 d-flex align-items-center">Partager ma liste
                <i class="far fa-share-square ms-3 fa-2x"></i>
            </button>
        </a>
    </div>

<?php

$content = ob_get_clean(); // get current buffer contents and delete current output buffer
require 'templateView.php'; // using of template.php