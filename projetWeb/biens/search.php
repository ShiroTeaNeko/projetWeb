<?php
session_start();

require_once '../layout/header.php';
require_once '../function/function.php';

$biens = search();
?>

    <div class="container mt-4">
        <div class="row px-2">
            <?php
            foreach ($biens as $bien) {
                require '../Authentification/all.php';
            }
            ?>
        </div>
    </div>

<?php require_once '../layout/footer.php';