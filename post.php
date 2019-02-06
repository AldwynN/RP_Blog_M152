<!-- 
Titre : Poster une image avec un commentaire
Date : 23.01.2019
Auteur : Romain Peretti
Description : Cette page permettra grâce à une formulaire l'ajout d'un commentaire ainsi qu'une image dans la base de données
-->
<?php
include './server/database/function.inc.php';

if (isset($_POST['sendPhoto'])) {
    if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
        $commentaire = $_POST['commentPhoto'];
        $currentDate = date('Y-m-d H:i:s');
        if (($idPost = InsertPost($commentaire, $currentDate)) == FALSE) {
            echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
        }
        
        $files = $_FILES['myImage'];
        $cptErreur = 0;

        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileType = $files['type'][$i];

            if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $fileName)) {
                if (InsertMedia($fileName, $fileType, $idPost)) {
                } else {
                    echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
                    header('Location: index.php');//$cptErreur++;
                }
            } else {
                echo '<h2>Erreur lors de l\'upload du fichier</h2>';
                //$cptErreur++;
            }
        }
       /*if ($cptErreur == 0) {
            header('Location: index.php');
        }else{
            echo "<h1>Erreur</h1>";
        }*/
        
    }
}

if (isset($_POST['sendVideo'])) {
    if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
        $commentaire = $_POST['commentVideo'];
        $currentDate = date('Y-m-d H:i:s');
        if (($idPost = InsertPost($commentaire, $currentDate)) == FALSE) {
            echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
        }
        
        $files = $_FILES['myVideo'];

        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileType = $files['type'][$i];

            if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $fileName)) {
                if (InsertMedia($fileName, $fileType, $idPost)) {
                    header('Location: index.php');
                } else {
                    echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
                }
            } else {
                echo '<h2>Erreur lors de l\'upload du fichier</h2>';
            }
        }
    }
}

if (isset($_POST['sendAudio'])) {
    if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
        $commentaire = $_POST['commentAudio'];
        $currentDate = date('Y-m-d H:i:s');
        if (($idPost = InsertPost($commentaire, $currentDate)) == FALSE) {
            echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
        }
        
        $files = $_FILES['myAudio'];

        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileType = $files['type'][$i];

            if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $fileName)) {
                if (InsertMedia($fileName, $fileType, $idPost)) {
                    header('Location: index.php');
                } else {
                    echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
                }
            } else {
                echo '<h2>Erreur lors de l\'upload du fichier</h2>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <link href="css/cssGlobal.css" rel="stylesheet" type="text/css"/>
        <title>Post</title>
    </head>
    <body>
        <?php include './server/inc/nav.inc.php'; ?>
        <section class="sectionGlobal">
            <?php
            include './server/inc/photoUpload.inc.php';
            include './server/inc/videoUpload.inc.php';
            include './server/inc/audioUpload.inc.php';
            ?>
        </section>
    </body>
</html>
