<?php ?>
<form method="POST" action="post.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Commentaire :</th>
            <th>Upload la/les fichier(s) audio:</th>
        </tr>
        <tr>
            <td><textarea cols='50' rows='5' name='commentAudio' required></textarea>
            <td><input type='file' name='myAudio[]' accept='audio/mp3, audio/wav' multiple></td>
        </tr>
        <tr>
            <td><input type='submit' name='sendAudio' value='Poster'></td>
        </tr>
    </table>
</form>