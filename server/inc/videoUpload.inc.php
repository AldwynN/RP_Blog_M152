<?php ?>

<form method="POST" action="post.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Commentaire :</th>
            <th>Upload la/les video(s):</th>
        </tr>
        <tr>
            <td><textarea cols='50' rows='5' name='commentVideo' required></textarea>
            <td><input type='file' name='myVideo[]' accept='video/mp4, video/ogg' multiple></td>
        </tr>
        <tr>
            <td><input type='submit' name='sendVideo' value='Poster'></td>
        </tr>
    </table>
</form>