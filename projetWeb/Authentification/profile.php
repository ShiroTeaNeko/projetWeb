<?php
session_start();

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

if(isset($_GET['id']) AND $_GET['id'] > 0){
    $getid = $_GET['id'];
    $requser = $pdo->prepare('SELECT * FROM client WHERE id_client = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();


    $title = "Profil";
    require_once '../layout/header.php';
    require_once '../function/function.php';
    $biens = getSelfLocation();
?>


<div align="center">
    <h2>Profil de <?php echo $userinfo['user']; ?></h2>
    <br /><br />
    Prénom = <?php echo $userinfo['prenom']; ?>
    <br />
    Nom = <?php echo $userinfo['nom']; ?>
    <br />
    Pseudo = <?php echo $userinfo['user']; ?>
    <br />
    Email = <?php echo $userinfo['email']; ?>
    <br />

    <div class="container mt-4">
        <div class="row">
            <?php
            foreach ($biens as $bien) {
                require '../Authentification/all.php';
            }
            ?>
        </div>
    </div>

    <?php
        if (isset($_SESSION['id']) AND $userinfo['id_client'] == $_SESSION['id']){
            ?>
            <a href="editionprofil.php">Editer mon profil</a>
            <a href="deconnexion.php">Se déconnecter</a>
            <?php
        }
    ?>
</div>

<?php require_once '../layout/footer.php'; ?>
<?php
} else {
    header("Location: profile.php?id=".$_SESSION['id']);
}
?>
