<?php

$posts = GetAllPosts();

foreach ($posts as $value) {

    $medias = GetMediasByIdPost($value['idPost']);

    echo '<figure class="post">';

    for ($index = 0; $index < count($medias); $index++) {

        if (\strpos($medias[$index]['typeMedia'], 'image') !== FALSE) {
            echo '<img class="imagePost" src="uploads/' . $medias[$index]['nomFichierMedia'] . '" alt="Image du post" />';
        }
        if (\strpos($medias[$index]['typeMedia'], 'video') !== FALSE) {
            echo '<video width="320" height="240" autoplay controls><source src="uploads/'.$medias[$index]['nomFichierMedia'].'" type="' . $medias[$index]['typeMedia'] . '"></video>';
        }
    }

    echo '<figcaption>' . $value['commentaire'] . '</figcaption>'
    . '<figcaption>Posté le '
    . $value['datePost']
    . '</figcaption>'
    . '</figure>';
}