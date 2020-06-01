<?php
session_start();
$title = "Ajouter votre bien";
require_once '../layout/header.php';

?>

    <div class="container mt-4">
        <h1>Ajouter votre bien dès maintenant !</h1>
        <form action="getForm.php" method="POST">
            <div class="form-group">
                <label for="titre">Nom de votre bien</label>
                <input type="text" class="form-control" id="titre" name="titre" aria-describedby="Aide_titre">
                <small id="Aide_titre" class="form-text text-muted">Entrez le titre de votre bien</small>
            </div>
            <div class="form-group">
                <label for="description">Description de votre bien</label>
                <input type="text" class="form-control" id="description" name="description" aria-describedby="Aide_description">
                <small id="Aide_description" class="form-text text-muted">Entrez la description de votre bien</small>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" aria-describedby="Aide_adresse">
                <small id="Aide_adresse" class="form-text text-muted">Entrez l'adresse de votre bien</small>
            </div>
            <div class="form-group">
                <label for="prix">Prix de votre bien</label>
                <input type="number" class="form-control" id="prix" name="prix" aria-describedby="Aide_prix">
                <small id="Aide_prix" class="form-text text-muted">Entrez le prix</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php require_once '../layout/footer.php'; ?>