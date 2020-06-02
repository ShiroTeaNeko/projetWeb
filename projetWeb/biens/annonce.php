<?php
//page qui affiche une seul annonce grace a sont id

session_start();
require_once '../function/db.php';

//ont prend l'id de l'annonce
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars($_GET['id']);

    $article = getPdo()->prepare('SELECT * FROM annonce WHERE id_Annonce = ?');
    $article->execute(array($get_id));

    //ont recupere les infos de la DB dans des variables
    if ($article->rowCount() == 1){
        $article = $article->fetch();
        $titre = $article['Titre'];
        $desc = $article['Description'];
        $adresse = $article['Adresse'];
        $prix = $article['Prix'];
        $img = $article['image'];
    } else {
        die('error');
    }
}
$title = $titre;
require_once '../layout/header.php';

?>
<div id="annonce" >
<h1 class="iconcolor center " ><?= $titre ?></h1>
    <img src="../images/ <?php echo $img ?>" height="200px" alt="imageDuBien">
<p class="center"><?= $desc ?></p>
    <p class="center"><?= $adresse ?></p>
<p class="center"><?= $prix ?></p>
</div>

<?php require_once '../layout/footer.php';