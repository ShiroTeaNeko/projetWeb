<?php
//page qui permet l'edition d'un bien déposé

session_start();
require_once '../layout/header.php';
require_once '../function/db.php';
require_once '../function/function.php';

$pdo = getPdo();

//ont prend l'id de l'annonce en question et ont recupere ses informations
if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $get_id = htmlspecialchars($_GET['id']);

    $reqannonce = $pdo->prepare("SELECT * FROM annonce WHERE id_Annonce = ?");
    $reqannonce->execute(array($get_id));
    $annonce = $reqannonce->fetch();

    //Changer le titre
    if (isset($_POST['newtitle']) AND !empty($_POST['newtitle']) AND $_POST['newtitle'] != $annonce['Titre']) {
        $newtitle = htmlspecialchars($_POST['newtitle']);
        $inserttitle = $pdo->prepare("UPDATE annonce SET Titre = ? WHERE id_Annonce = ?");
        $inserttitle->execute(array($newtitle, $get_id));
        header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
    }

    //changer la description
    if (isset($_POST['newdesc']) AND !empty($_POST['newdesc']) AND $_POST['newdesc'] != $annonce['Description']) {
        $newdesc = htmlspecialchars($_POST['newdesc']);
        $insertdesc = $pdo->prepare("UPDATE annonce SET Description = ? WHERE id_Annonce = ?");
        $insertdesc->execute(array($newdesc, $get_id));
        header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
    }

    //changer l'adresse
    if (isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $annonce['Adresse']) {
        $newad = htmlspecialchars($_POST['newadresse']);
        $insertad = $pdo->prepare("UPDATE annonce SET Adresse = ? WHERE id_Annonce = ?");
        $insertad->execute(array($newad, $get_id));
        header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
    }

    //changer le prix
    if (isset($_POST['newprix']) AND !empty($_POST['newprix']) AND $_POST['newprix'] != $annonce['Prix']) {
        $newprix = htmlspecialchars($_POST['newprix']);
        $insertprix = $pdo->prepare("UPDATE annonce SET Prix = ? WHERE id_Annonce = ?");
        $insertprix->execute(array($newprix, $get_id));
        header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
    }

    //permet d'integrer une image au bien
    if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
        $tailleMax = 2097152;
        $extensionValides = array('jpg', 'jpeg', 'png');
        if ($_FILES['avatar']['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if (in_array($extensionUpload, $extensionValides)) {
                $chemin = "../images/" . $get_id . "." . $extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if ($resultat) {
                    $updateAvatar = getPdo()->prepare('UPDATE annonce SET image = :avatar WHERE id_Annonce = :id');
                    $updateAvatar->execute(array(
                        'avatar' => $get_id . "." . $extensionUpload,
                        'id' => $get_id
                    ));
                    header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
                } else {
                    $msg = "Erreur durant l'importation de l'image";
                }
            } else {
                $msg = "Votre image doit etre au format jpg, jpeg ou png";
            }
        } else {
            $msg = "Votre image ne doit pas exceder les 2Mo !";
        }
    }
    //si le boutton suppression est appuyé, l'annonce est supprimé
    //uniquement le detenteur du bien peut faire ceci
    if(array_key_exists('supprann',$_POST)){
        supprAnn();
    }
}
?>

    <div align="center">
        <h2>Edition de mon Annonce</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Titre :</label>
            <input type="text" name="newtitle" placeholder="Title" value="<?php echo $annonce['Titre']; ?>"> <br><br>
            <label>Description :</label>
            <input type="text" name="newdesc" placeholder="Description" value="<?php echo $annonce['Description'] ?>"> <br><br>
            <label>Adresse :</label>
            <input type="text" name="newadresse" placeholder="Adresse" value="<?php echo $annonce['Adresse'] ?>"> <br><br>
            <label>Prix :</label>
            <input type="text" name="newprix" placeholder="Prix" value="<?php echo $annonce['Prix'] ?>"> <br><br>
            <label>image :</label>
            <input type="file" name="avatar"> <br><br>
            <input type="submit" value="enregistrer les modifications" class="btn btn-primary" >
        </form>

        <form method="POST">
            <br><br>
            <input type="submit" name="supprann" value="supprimer mon annonce" class="btn btn-danger">
        </form>
        <?php if(isset($msg)) { echo $msg; } ?>
    </div>

<?php
require_once '../layout/footer.php';
?>