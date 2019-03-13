<?php

require_once 'EDatabase.php';

function InsertPost($commentaire, $date) {
    $req = EDatabase::prepare('INSERT INTO `posts`(`commentaire`, `datePost`) VALUES (:commentaire, :date)'); //Retour un pdoStatement
    $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $req->bindParam(':date', $date);
    $req->execute(); //Retourne un bool
    $result = EDatabase::lastInsertId();
    return $result;
}

function InsertMedia($nomFichier, $typeMedia, $idPost) {
    $req = EDatabase::prepare('INSERT INTO `medias`(`nomFichierMedia`, `typeMedia`, `idPost`) VALUES (:nomFichier, :typeMedia, :idPost)');
    $req->bindParam(':nomFichier', $nomFichier, PDO::PARAM_STR);
    $req->bindParam(':typeMedia', $typeMedia, PDO::PARAM_STR);
    $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
    return $req->execute();
}

function InsertPostWithMedia($commentaire, $date, $fileList) {
    try {
        EDatabase::beginTransaction();
        $idPost = InsertPost($commentaire, $date);

        for ($i = 0; $i < count($fileList['name']); $i++) {
            $fileName = uniqid();
            $fileType = $fileList['type'][$i];
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à l'extension mimetype
            $mime = finfo_file($finfo, $fileList["tmp_name"][$i]);
            if ($mime == 'image/gif' || $mime == 'image/png' || $mime == 'image/jpeg' || $mime == 'image/jpg' || $mime == 'video/mp4' || $mime == 'video/avi' || $mime == 'video/ogg' || $mime == 'audio/mp3' || $mime == 'audio/wav') {
                if (move_uploaded_file($fileList['tmp_name'][$i], 'uploads/' . $fileName)) {
                    InsertMedia($fileName, $fileType, $idPost);
                }
                finfo_close($finfo);
            }
        }
        EDatabase::commit();
        return true;
    } catch (Exception $e) {
        EDatabase::rollBack();
        return false;
    }
}

function GetAllPosts() {
    try {
        $req = EDatabase::prepare("SELECT * FROM `posts` ORDER BY datePost DESC");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        return FALSE;
    }
}

function GetMediasByIdPost($idPost) {
    try {
        $req = EDatabase::prepare("SELECT * FROM `medias` WHERE idPost = :idPost");
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        return FALSE;
    }
}

function GetDetailsPostById($idPost) {
    try {
        $req = EDatabase::prepare("SELECT * FROM `posts` WHERE idPost = :idPost");
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        return FALSE;
    }
}

function DeletePostById($idPost){
    try {
        $req = EDatabase::prepare("DELETE FROM `medias` WHERE idPost = :idPost");
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        return TRUE;
    } catch (Exception $e) {
        return FALSE;
    }
}