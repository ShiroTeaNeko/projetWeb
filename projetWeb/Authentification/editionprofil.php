<?php
//page qui permet l'edition du profil utilisateur

session_start();

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

//si la session est ouverte on recupere l'id de l'user
if(isset($_SESSION['id'])) {
    $requser = $pdo->prepare("SELECT * FROM client WHERE id_client = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    //changement nom de l'user
    if(isset($_POST['newuser']) AND !empty($_POST['newuser']) AND $_POST['newuser'] != $user['user']) {
        $newuser = htmlspecialchars($_POST['newuser']);
        $insertuser = $pdo->prepare("UPDATE client SET user = ? WHERE id_client = ?");
        $insertuser->execute(array($newuser, $_SESSION['id']));
        header("Location: profile.php?id=" . $_SESSION['id']);
    }

    //changement du mail de l'user
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $pdo->prepare("UPDATE client SET email = ? WHERE id_client = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header("Location: profile.php?id=" . $_SESSION['id']);
    }

    //changement du mdp de l'user (toujours sde maniere sécurisé avec hash)
    if(isset($_POST['newpass1']) AND !empty($_POST['newpass1']) AND isset($_POST['newpass2']) AND !empty($_POST['newpass2'])) {
        $password1 = ($_POST["newpass1"]);
        $password2 = ($_POST["newpass2"]);

        if ($password1 == $password2) {
            $hashdepass = password_hash($password1, PASSWORD_DEFAULT);

            $insertmdp = $pdo->prepare("UPDATE client SET password = ? WHERE id_client = ?");
            $insertmdp->execute(array($hashdepass, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        } else {
            $msg = "Vos deux password ne correspondent pas !";
        }

    }


    if (isset($_POST['newuser']) AND $_POST['newuser'] == $user['user']){
        header('Location: profile.php?id='.$_SESSION['id']);
    }
    $title = $user['user'];
    require_once '../layout/header.php';

        ?>


    <div align="center">
        <h2>Edition de mon profil</h2>
       <form method="POST" action="">
           <label>User :</label>
           <input type="text" name="newuser" placeholder="user" value="<?php echo $user['user']; ?>"> <br><br>
           <label>Email :</label>
           <input type="text" name="newmail" placeholder="mail" value="<?php echo $user['email'] ?>"> <br><br>
           <label>Password :</label>
           <input type="password" name="newpass1" placeholder="pass1"> <br><br>
           <label>Confirm password :</label>
           <input type="password" name="newpass2" placeholder="pass2"> <br><br>
           <input type="submit" value="enregistrer les modifications" >
       </form>
        <?php if(isset($msg)) { echo $msg; } ?>
    </div>

    <?php

    require_once '../layout/footer.php';
}
else {
    header("Location: login.php");
}

?>
