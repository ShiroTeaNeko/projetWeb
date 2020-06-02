<?php
//Cette page permet de voir les infos utilisateur et les biens déposées

session_start();

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

//recupération de l'id pour recuperer les infos de la base
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


<div align="center iconcolor">
    <div align="center" class="iconcolor" id="annonce2">
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
    </div>

    <div class="container mt-4">
        <div class="card-deck">
            <?php
            //ici ont affiche tout les biens de l'user
            foreach ($biens as $bien) {
                require '../biens/mesBiens.php';
            }
            ?>
        </div>
    </div>

    <?php
    //permet uniquement a l'utilisateur connecté de changer ses infos
        if (isset($_SESSION['id']) AND $userinfo['id_client'] == $_SESSION['id']){
            ?>
            <div align="center" id="background">
            <a href="editionprofil.php">Editer mon profil</a>
            <a href="deconnexion.php">Se déconnecter</a>
            </div>
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
