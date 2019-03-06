<?php

require_once 'EDatabase.php';

function InsertPost($commentaire, $date) {
    try {
        $req = EDatabase::prepare('INSERT INTO `posts`(`commentaire`, `datePost`) VALUES (:commentaire, :date)'); //Retour un pdoStatement
        EDatabase::beginTransaction();
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindParam(':date', $date);
        $req->execute(); //Retourne un bool
        EDatabase::commit();
        $result = EDatabase::lastInsertId();
    } catch (Exception $e) {
        EDatabase::rollBack();
        return FALSE;
    }
    return $result;
}

function InsertMedia($nomFichier, $typeMedia, $idPost) {
    try {
        $req = EDatabase::prepare('INSERT INTO `medias`(`nomFichierMedia`, `typeMedia`, `idPost`) VALUES (:nomFichier, :typeMedia, :idPost)');
        EDatabase::beginTransaction();
        $req->bindParam(':nomFichier', $nomFichier, PDO::PARAM_STR);
        $req->bindParam(':typeMedia', $typeMedia, PDO::PARAM_STR);
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        EDatabase::commit();
        return TRUE;
    } catch (Exception $e) {
        EDatabase::rollBack();
        return FALSE;
    }
}

function GetAllPosts() {
    try {
        $req = EDatabase::prepare("SELECT * FROM `posts` ORDER BY datePost DESC");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return FALSE;
    }
    return $result;
}

function GetMediasByIdPost($idPost) {
    try {
        $req = EDatabase::prepare("SELECT * FROM `medias` WHERE idPost = :idPost");
        $req->bindParam(':idPost', $idPost, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return FALSE;
    }
    return $result;
}
