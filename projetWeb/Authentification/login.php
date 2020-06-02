<?php
session_start();

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

//Permet le login d'un utilisateur si les condition sont remplies

if(isset($_POST['formconnexion'])) {
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = htmlspecialchars($_POST['passwordconnect']);
        if (!empty($emailconnect) AND !empty($passwordconnect)) {
            $requser = $pdo->prepare("SELECT * FROM client WHERE email = :email");
            $requser->execute(array('email' => $_POST['emailconnect']));
            $result = $requser->fetch();
            if ($result && password_verify($_POST['passwordconnect'], $result['password'])){
                $_SESSION['id'] = $result['id_client'];
                $_SESSION['user'] = $result['user'];
                $_SESSION['email'] = $result['email'];
                header("Location: profile.php?id=".$_SESSION['id']);
            } else {
                $erreur = 'Mauvais mail ou mot de passe';
            }
        } else {
            $erreur = 'tous les champs doivent etre complétés';
        }

}
?>

<?php
$title = "Login";
require_once '../layout/header.php';
?>





<form method="POST" action="login.php">
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="emailconnect">email</label>
            <input type="email" class="form-control" id="emailconnect" name="emailconnect" placeholder="">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="passwordconnect">password</label>
            <input type="password" class="form-control" id="passwordconnect" name="passwordconnect" placeholder="">
        </div>
    </div>
    <div class="form-group mx-5">
        <button type="submit" name="formconnexion" value="submit">Connexion</button>
    </div>
</form>
</body>

<?php
if(isset($erreur))
{
    echo $erreur;
}
?>

<?php require_once '../layout/footer.php'; ?>