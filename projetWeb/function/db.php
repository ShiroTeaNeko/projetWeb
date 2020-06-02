<?php
//permet de se connecter à la base de données

function getPdo(): PDO
{
    try {
        $pdo = new PDO(
            "mysql:host=localhost:3307;dbname=projetWeb",
            "AdminWeb",
            "f1b29BixVHmRCi5p"
        );
        return $pdo;
    } catch (PDOException $ex) {
        exit("Erreur lors de la connexion à la base de données");
    }
}