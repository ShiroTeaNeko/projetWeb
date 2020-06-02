<?php
//Création d'une carte pour montrer une annonce
?>

    <div class="card col-4">
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

    </div>
</div>