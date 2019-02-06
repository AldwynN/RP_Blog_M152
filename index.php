<!-- 
Titre : Page de profil de l'utilisateur
Date : 23.01.2019
Auteur : Romain Peretti
Description : Cette page permettra d'afficher les informations de l'utilisateur ainsi que ce qu'il a publié (image/vidéos)
-->
<?php
include './server/database/function.inc.php';
?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <link href="css/cssGlobal.css" rel="stylesheet" type="text/css"/>
        <title>Home</title>
    </head>
    <body>
        <?php include './server/inc/nav.inc.php'; ?>
        <!-- Section pour la photo de profile -->
        <section id="profil">
            <image src='https://fr.cdn.v5.futura-sciences.com/buildsv6/images/mediumoriginal/6/5/2/652a7adb1b_98148_01-intro-773.jpg' alt='Photo de profil' height='70' width='110'>
            <h3>Romain Peretti</h3>
        </section>

        <!-- Section pour le message d'accueil -->
        <section class="sectionGlobal">
            <h1>Bienvenue sur ma page magnifique !</h1>
        </section>
        <!-- Section pour les posts de l'utilisateur -->
        <section id="sectPost">
            <?php
            include './server/inc/post.inc.php';
            ?>
        </section>
    </body>
</html>
