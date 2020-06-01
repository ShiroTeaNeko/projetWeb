<?php
session_start();
require_once '../function/db.php';

if (isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars($_GET['id']);

    $article = getPdo()->prepare('SELECT * FROM annonce WHERE id_Annonce = ?');
    $article->execute(array($get_id));

    if ($article->rowCount() == 1){
        $article = $article->fetch();
        $titre = $article['Titre'];
        $desc = $article['Description'];
    } else {
        die('error');
    }
}

require_once '../layout/header.php';

?>

<h1><?= $titre ?></h1>
<p><?= $desc ?></p>

<?php require_once '../layout/footer.php';