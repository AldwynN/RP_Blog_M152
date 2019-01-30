<?php

require_once 'databaseConnection.php';

function InsertPost($commentaire, $date) {
    try {
        $connect = myDatabase();
        $req = $connect->prepare('INSERT INTO `posts`(`commentaire`, `datePost`) VALUES (:commentaire, :date)');
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindParam(':date', $date);
        $req->execute();
        $result = $connect->lastInsertId();
    } catch (Exception $ex) {
        return FALSE;
    }
    return $result;
}

function InsertMedia($nomFichier, $typeMedia, $idPost) {
    try {
        $connect = myDatabase();
        $req = $connect->prepare('INSERT INTO `medias`(`nomFichierMedia`, `typeMedia`, `idPost`) VALUES (:nomFichier, :typeMedia, :idPost)');
        $req->bindParam(':nomFichier', $nomFichier, PDO::PARAM_STR);
        $req->bindParam(':typeMedia', $typeMedia, PDO::PARAM_STR);
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        return TRUE;
    } catch (Exception $ex) {
        return FALSE;
    }
}

function GetAllPosts() {
    try {
        $connect = myDatabase();
        $req = $connect->prepare("SELECT * FROM `posts` ORDER BY datePost DESC");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        return FALSE;
    }
    return $result;
}

function GetMediasByIdPost($idPost){
    try {
        $connect = myDatabase();
        $req = $connect->prepare("SELECT * FROM `medias` WHERE idPost = :idPost");
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        return FALSE;
    }
    return $result;
}