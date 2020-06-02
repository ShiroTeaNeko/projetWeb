<?php
require_once '../function/db.php'
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../Authentification/index.php">AirBnB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../Authentification/index.php">Accueil<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../biens/location.php">Biens</a>
                </li>
                <li class="nav-item">
                    <?php
                    if(isset($_GET['id']) AND $_GET['id'] > 0) {
                        $getid = $_GET['id'];
                        $requser = getPdo()->prepare('SELECT * FROM client WHERE id_client = ?');
                        $requser->execute(array($getid));
                        $userinfo = $requser->fetch();
                    }
                    if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
                        ?>
                        <a class="nav-link" href="../biens/addLocation.php" >Ajouter son bien</a>
                        <?php
                    }

                    ?>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['id']) == "") {
            ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="../Authentification/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../Authentification/auth.php">Register</a>
                </li>
            </ul>
                <?php
            }
            ?>
            <?php
            if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../Authentification/profile.php">Mon Profil</a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
    </nav>
