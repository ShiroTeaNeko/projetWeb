<?php
//permet de recuperer uniquement les annonces d'un utilisateur et de lui permettre de la voir ou de l'éditer

require_once '../function/function.php'
?>

<div class="card ">
    <img class="card-img-top" src="../images/<?php echo $bien['image'];?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">
            <?php echo $bien['Titre'];
            echo '<br>';
            ?>
        </h5>
        <p>
            <?php
            echo 'Description : ', $bien['Description'];
            echo '<br>';
            echo 'Adresse : ', $bien['Adresse'];
            echo '<br>';
            echo 'Prix : ', $bien['Prix'] , ' €/semaine';
            ?>
        </p>
        <a href="../biens/annonce.php?id=<?= $bien['id_Annonce'] ?>" class="btn btn-primary">Voir l'annonce</a>
        <?php if (isset($_SESSION['id']) AND userInfo()['id_client'] == $_SESSION['id']){ ?>
        <a href="../biens/editionAnnonce.php?id=<?= $bien['id_Annonce'] ?>" class="btn btn-primary">Editer l'annonce</a>
        <?php } ?>
    </div>
</div>