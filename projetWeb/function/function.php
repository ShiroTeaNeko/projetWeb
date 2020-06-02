<?php
//permet de recuperer toutes les fonctions creer à partir d'un fichier

require_once __DIR__ . "/db.php";

//recupere toutes les annonce dans un fetch
function getLocation(): array
{
    $pdo = getPdo();

    $stmt = $pdo->query("SELECT * FROM annonce");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//recupere toutes les annonces d'un seul utilisateur
function getSelfLocation(): array
{
    $pdo = getPdo();
    $getid = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM annonce WHERE id_client = ?");
    $stmt->execute(array($getid));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//entre dans la base de données une annonce creer par un utilisateur
function form(
    string $titre,
    string $desc,
    string $adresse,
    int $prix,
    int $client
) {
    $pdo = getPdo();

    $query = "INSERT INTO annonce (Titre, Description, Adresse, Prix, id_client) VALUES (:titre, :desc, :adresse, :prix ,:id_client)";

    $stmt = $pdo->prepare($query);


    return $stmt->execute(array(
        'titre' => $titre,
        'desc' => $desc,
        'adresse' => $adresse,
        'prix' => $prix,
        'id_client' => $client
    ));

}

//permet la suppression d'une annonce dans la base de données
function supprAnn(){
    $pdo = getPdo();
    if(isset($_GET['id']) AND !empty($_GET['id'])) {
        $get_id = htmlspecialchars($_GET['id']);
        $suppression = $pdo->prepare('DELETE FROM annonce WHERE id_Annonce = ?');
        $suppression->execute(array($get_id));
    }
    header("Location: ../Authentification/profile.php?id=" . $_SESSION['id']);
}

//recupere les informations d'un utilisateur dans la base de données
function userInfo()
{
    $pdo = getPdo();

    if (isset($_GET['id']) AND $_GET['id'] > 0) {
        $getid = $_GET['id'];
        $requser = $pdo->prepare('SELECT * FROM client WHERE id_client = ?');
        $requser->execute(array($getid));
        return $userinfo = $requser->fetch();
    }
}

//permet d'obtenir les annonce lié à la recherche
function search(): array
{
    $pdo = getPdo();

    if (isset($_GET['q']) AND !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);

        $annonce = $pdo->query('SELECT * FROM annonce WHERE Titre LIKE "%'.$q.'%" OR Description LIKE "%'.$q.'%" ORDER BY id_Annonce DESC');
        return $annonce->fetchAll(PDO::FETCH_ASSOC);
    }
}