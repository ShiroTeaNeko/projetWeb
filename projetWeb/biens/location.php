<?php
//page qui permet de montrer tout les biens présent sur le site

session_start();
$title = "Nos dernières locations";
require_once '../layout/header.php';
require_once '../function/function.php';

$biens = getLocation();

?>

    <div class="container mt-4">
        <div class="card-deck">
            <?php
            foreach ($biens as $bien) {
                require '../Authentification/all.php';
            }
            ?>
        </div>
    </div>

<?php require_once '../layout/footer.php';
