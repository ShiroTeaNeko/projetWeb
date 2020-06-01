<?php
session_start();
$title = "Accueil";
require_once '../layout/header.php';
?>

    <div class="jumbotron">
        <h1 class="display-4">Bienvenue !</h1>
        <p class="lead">Louer un bien des maintenant !</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="../biens/location.php" role="button">Voir la liste des Biens</a>
    </div>

<?php require_once '../layout/footer.php'; ?>