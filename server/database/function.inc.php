<?php

require_once 'databaseConnection.php';

function InsertPost($commentaire, $dataType, $dataName, $date) {
    try {
        $connect = myDatabase();
        $req = $connect->prepare('INSERT INTO `posts`(`commentaire`, `typeMedia`, `nomMedia`, `datePost`) VALUES (:commentaire, :dataType, :dataName, :date)');
        $req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindParam(':dataType', $dataType, PDO::PARAM_STR);
        $req->bindParam(':dataName', $dataName, PDO::PARAM_INT);
        $req->bindParam(':date', $date);
        $req->execute();
        return TRUE;
    } catch (Exception $ex) {
        return FALSE;
    }
}

function GetAllPosts() {
    try {
        $connect = myDatabase();
        $req = $connect->prepare("SELECT * FROM posts ORDER BY datePost DESC");
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        return FALSE;
    }
    return $result;
}
