<!-- 
Titre : Poster une image avec un commentaire
Date : 23.01.2019
Auteur : Romain Peretti
Description : Cette page permettra grâce à une formulaire l'ajout d'un commentaire ainsi qu'une image dans la base de données
-->
<?php
include './server/database/function.inc.php';

if (isset($_POST['send'])) {
    if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
        $commentaire = $_POST['comment'];
        $currentDate = date('Y-m-d H:i:s');
        if (!InsertPost($commentaire, $currentDate)) {
            echo '<h2>Erreur lors de l\'ajout en base de données</h2>';
        }
        
        $files = $_FILES['myImage'];
        
        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['name'][$i];
            $fileType = $files['type'][$i];

            if (move_uploaded_file($files['tmp_name'][$i], 'uploads/' . $fileName)) {
                $idPost = GetLastIdPost();
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
        <title>Post</title>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='#'>Post</a></li>
            </ul>
        </nav>
        <form method="POST" action="post.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <th>Commentaire :</th>
                    <th>Upload l'image :</th>
                </tr>
                <tr>
                    <td><textarea cols='50' rows='5' name='comment' required></textarea>
                    <td><input type='file' name='myImage[]' accept='image/jpeg, image/png, image/gif, image/jpg' multiple></td>
                </tr>
                <tr>
                    <td><input type='submit' name='send' value='Poster'></td>
                </tr>
            </table>
        </form>
    </body>
</html>
