<?php
//page qui permet de dire a l'utilisateur si son annonce est bien enregistrée dans la base de données

session_start();
(empty($_POST) ||
    empty($_POST['titre']) ||
    empty($_POST['description']) ||
    empty($_POST['adresse']) ||
    empty($_POST['prix'])) && exit("veuillez verifier vos entrées");

require_once '../function/function.php';
$title = "Formulaire";
require_once '../layout/header.php';

?>
    <div class="container mt-4">
        <?php if (form($_POST['titre'], $_POST['description'], $_POST['adresse'], $_POST['prix'], $_SESSION['id'])) { ?>
            <div class="alert alert-success" role="alert">
                <h2>
                    Votre demande a bien été prise en compte, votre bien est desormais enregistré !
                </h2>
                <a href="../Authentification/profile.php?id=<?= $_SESSION['id'] ?>" class="btn btn-primary">Aller voir sur Mon Profil !</a>
            </div>
        <?php } ?>
    </div>

<?php require_once '../layout/footer.php'; ?>