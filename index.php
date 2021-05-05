<?php
session_start();
include("connexion_bdd.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc Note</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="connexionDeco">
        <?php
            if (isset($_SESSION["login"])) {
                echo "Bienvenue ". $_SESSION["login"]."<div class='espaceCo'></div>";
                echo '<a href="/blocNote/index.php?page=accueil" style="width:200px">Accueil</a>'."<div class='espaceCo'></div>";
                echo '<a href="/blocNote/index.php?page=deconnexion" style="width:500px">Déconnectez-vous</a>'."<div class='espaceCo'></div>";
                echo '<a href="/blocNote/index.php?page=blocnote" style="width:500px">Ajouter une note</a>';
            } else {
                echo '<a href="/blocNote/index.php?page=connexion">Connectez-vous</a>'.'<div class="espaceCo"></div>'.'<a href="/blocNote/index.php?page=inscription">Inscrivez-vous</a>';
            }
        ?>
    </div>

    <?php

    //Ma page de base
    $page = "accueil";

    //Mes pages dispos 
    $pagesDispos = [
        "accueil", "connexion","inscription"
    ];

    $pagesDisposCo = [
        "accueil", "connexion", "deconnexion", "blocnote","suppr_note"
    ];


    if (isset($_GET['page']) /* ce que l'on cherche, dans quel tableau */ && in_array($_GET['page'], $pagesDispos)) {
        $page = $_GET['page'];
        include($page . '.php');
    } elseif (isset($_SESSION['login']) /* EST CONNECTE */ && isset($_GET['page']) && in_array($_GET['page'], $pagesDisposCo)) {
        $page = $_GET['page'];
        include($page . '.php');
    } elseif (isset($_GET['page']) && !in_array($_GET['page'], $pagesDispos))
    //si l'utilisateur cherche une page qui n'existe pas (qui n'est pas dans $pagesDispos)
    {
        include('404.php');
        //afficher la page 404 plutot que accueil
    } else {
        include($page . '.php');
        //s'il n'y a pas de paramétre ?page dans l'url, afficher la page accueil
    }

    ?>

</body>
</html>