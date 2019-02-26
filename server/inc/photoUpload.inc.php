<?php ?>

<form method="POST" action="post.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Commentaire :</th>
            <th>Upload la/les image(s) :</th>
        </tr>
        <tr>
            <td><textarea cols='50' rows='5' name='commentPhoto' required></textarea>
            <td><input type='file' name='myImage[]' accept='image/jpeg, image/png, image/gif, image/jpg' multiple></td>
        </tr>
        <tr>
            <td><input type='submit' name='sendPhoto' value='Poster'></td>
        </tr>
    </table>
</form>