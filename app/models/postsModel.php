<?php

namespace App\Models\PostsModel;

function findAllWithLimit(\PDO $conn, int $limit = 10) {
    $sql = "SELECT p.id, p.title, p.text, p.created_at, p.quote, p.image, c.name FROM posts p JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC LIMIT :limit;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":limit", $limit, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findOneByID(\PDO $conn, int $id){
    $sql = "SELECT p.id, p.title, p.text, p.created_at, p.quote, p.image, p.category_id, c.name FROM posts p JOIN categories c ON p.category_id = c.id WHERE p.id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":id", $id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}

function insertOne(\PDO $conn, array $data) {
    $sql = "INSERT INTO posts (title, text, created_at, quote, image, category_id) VALUES (:title, :text, :currentTime, :quote, :image, :category_id);";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":title", $data["title"], \PDO::PARAM_STR);
    $rs->bindValue(":text", $data["text"], \PDO::PARAM_STR);
    $rs->bindValue(":currentTime", date("Y-m-d"), \PDO::PARAM_STR);
    $rs->bindValue(":quote", $data["quote"], \PDO::PARAM_STR);
    $rs->bindValue(":image", $data["image"], \PDO::PARAM_STR);
    $rs->bindValue(":category_id", $data["category_id"], \PDO::PARAM_INT);
    $rs->execute();
}