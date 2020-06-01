<?php
session_start();

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

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




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Partiel</title>
</head>
<body>
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