<?php

//Permet a un visiteur de s'enregistrer en temps qu'utilisateur

$pdo = new PDO(
    "mysql:host=localhost:3307;dbname=projetWeb",
    "AdminWeb",
    "f1b29BixVHmRCi5p");

//regarde si le formulaire est remplie au moment du submit
if(isset($_POST['submit']))
{
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $user = htmlspecialchars($_POST["user"]);
    $password1 = ($_POST["password1"]);
    $password2 = ($_POST["password2"]);

    //securisation du mdp utilisateur avec un hash
    $hashdepass = password_hash($password1, PASSWORD_DEFAULT);


    //série de if pour voir si le formulaire est remplie correctement
    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['user']) AND !empty($_POST['password1']) AND !empty($_POST['password2']))
    {
        $userlength = strlen($user);
        if($userlength <= 255)
        {
            $reqmail = $pdo->prepare("SELECT * FROM client WHERE email = ?");
            $reqmail->execute(array($email));
            $mailexist = $reqmail->rowCount();
            if($mailexist == 0) {
                if ($password1 == $password2) {
                    $insertClient = $pdo->prepare("INSERT INTO client (prenom, nom, email, user, password) VALUES (?, ?, ?, ?, ?)") or die("Error: " . mysql_error());
                    $insertClient->execute(array($prenom, $nom, $email, $user, $hashdepass));
                    //var_dump($insertClient->errorInfo());
                    $erreur = "Votre compte a bien été créer ! <a href=\"login.php\">Me connecter</a>";
                } else {
                    $erreur = "Vos mots de passe ne correspondent pas !";
                }
            } else {
                $erreur = "Adresse mail déjà utilisée !";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser les 255 caracteres";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }

}

require_once '../layout/header.php'

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

<form method="POST" action="auth.php">
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="" value="<?php if (isset($prenom)) { echo $prenom; } ?>">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="" value="<?php if (isset($nom)) { echo $nom; } ?>">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="email">email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?php if (isset($email)) { echo $email; } ?>">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="user">user</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="" value="<?php if (isset($user)) { echo $user; } ?>">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="password1">password</label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="">
        </div>
    </div>
    <div class="form-row mx-5">
        <div class="form-group col-md-4">
            <label for="password2">confirm password</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="">
        </div>
    </div>
    <div class="form-group mx-5">
        <button type="submit" name="submit" value="submit">Sign in</button>
    </div>
</form>

<?php
if(isset($erreur))
{
    echo $erreur;
}

require_once '../layout/footer.php'

?>
