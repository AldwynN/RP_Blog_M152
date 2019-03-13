<?php
include './server/database/function.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <meta charset="utf-8" />		
    </head>
    <body>


        <?php
        //Récupération du paramètre idNews
        if (isset($_GET['idPost']) && is_numeric($_GET['idPost'])) {    //De main.php
            $idPost = $_GET['idPost'];
        } elseif (isset($_POST['idPost']) && is_numeric($_POST['idPost'])) {   //Depuis le formulaire de cette page
            $idPost = $_POST['idPost'];
        }

        $post = GetDetailsPostById($idPost);
        $commentaire = $post[0]['commentaire'];

        //Si la suppression a été confirmée depuis le formulaire de cette page, on supprime
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['sure'] == "oui") {
                if (DeletePostById($idPost)) {
                    echo "Le post a bien été supprimé!";
                } else {
                    echo "Le post n'a pas pu être supprimé!";
                }
                echo '<br><br><a href="index.php">Retour</a>';
            } else {
                echo "Le post n'a pas été supprimé.";
                echo '<br><br><a href="index.php">Retour</a>';
            }
        }
        //Sinon on demande confirmation
        else {
            ?>
            <h1>Suppression d'un post</h1>

            <p>Etes-vous sûr de vouloir supprimer le post intitulé: "<?php echo $commentaire; ?>"?</p>

            <form action="deleteNews.php" method="POST">
                <input type="radio" name="sure" value="oui" /> Oui
                <input type="radio" name="sure" value="non" checked="checked" /> Non
                <input type="submit" name="submit" value="Valider" />
                <input type="hidden" name="idPost" value="<?php echo $idPost; ?>" />
            </form><br><br>

            <a href="index.php">Retour</a>
    <?php
}
?>

    </body>
</html>