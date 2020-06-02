<?php
//permet la deconnexion de l'utilisateur
session_start();
$_SESSION = array();
session_destroy();
header("Location: login.php");
?>