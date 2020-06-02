<?php
//page index avec session start pour differencier entre visiteur et utilisateur

session_start();
$title = "Accueil";

require_once '../layout/header.php';
?>
    <h1 id="Title" >Un bien, une location,Sakura est la pour toi</h1>
<div id="search">

    <form class="form-inline" method="get" action="../biens/search.php">
        <i class="fas fa-search" aria-hidden="true"></i>
        <input class="form-control mr-sm-2 iconcolor" type="search" name="q" placeholder="Search..." aria-label="Search">
        <button class="btn white btn-rounded btn-sm iconcolor" type="submit">Search</button>
    </form>
</div>
<?php require_once '../layout/footer.php'; ?>