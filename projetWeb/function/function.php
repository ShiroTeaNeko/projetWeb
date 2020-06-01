<?php
require_once __DIR__ . "/db.php";

function getLocation(): array
{
    $pdo = getPdo();

    $stmt = $pdo->query("SELECT * FROM annonce");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSelfLocation(): array
{
    $pdo = getPdo();
    $getid = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM annonce WHERE id_client = ?");
    $stmt->execute(array($getid));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function form(
    string $titre,
    string $desc,
    string $adresse,
    int $prix,
    int $client
) {
    $pdo = getPdo();

    $query = "INSERT INTO annonce (Titre, Description, Adresse, Prix, id_client) VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($query);

    return $stmt->execute(array($titre,$desc,$adresse,$prix, $client));

}

function deleteAnn(){
    
}