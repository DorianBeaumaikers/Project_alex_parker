<?php

namespace App\Models\PostsModel;

/**
 * Renvoie la liste des postes selon une limite et un offset donné
 *
 * @param \PDO $conn
 * @param integer $limit
 * @param integer $offset
 * @return array
 */
function findAllWithLimit(\PDO $conn, int $limit = 10, int $offset = 0) {
    $sql = "SELECT p.id, p.title, p.text, p.created_at, p.quote, p.image, c.name FROM posts p JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC LIMIT :limit OFFSET :offset;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":limit", $limit, \PDO::PARAM_INT);
    $rs->bindValue(":offset", $offset, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Renvoie les infos d'un poste selon une id donnée
 *
 * @param \PDO $conn
 * @param integer $id
 * @return array
 */
function findOneByID(\PDO $conn, int $id){
    $sql = "SELECT p.id, p.title, p.text, p.created_at, p.quote, p.image, p.category_id, c.name FROM posts p JOIN categories c ON p.category_id = c.id WHERE p.id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":id", $id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}

/**
 * Insert un nouveau poste dans la base de donnée
 *
 * @param \PDO $conn
 * @param array $data
 * @return void
 */
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

/**
 * Met à jour les infos d'un post dans la base de donnée
 *
 * @param \PDO $conn
 * @param array $data
 * @return void
 */
function updateOneByID(\PDO $conn, array $data){
    $sql = "UPDATE posts SET title = :title, text = :text, quote = :quote, category_id = :category_id WHERE id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":id", $data["id"], \PDO::PARAM_STR);
    $rs->bindValue(":title", $data["title"], \PDO::PARAM_STR);
    $rs->bindValue(":text", $data["text"], \PDO::PARAM_STR);
    $rs->bindValue(":quote", $data["quote"], \PDO::PARAM_STR);
    $rs->bindValue(":category_id", $data["category_id"], \PDO::PARAM_INT);
    $rs->execute();
}

/**
 * Met à jour l'image d'un post dans la base de donnée
 *
 * @param \PDO $conn
 * @param array $data
 * @return void
 */
function updateImageByID(\PDO $conn, array $data){
    $sql = "UPDATE posts SET image = :image WHERE id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":id", $data["id"], \PDO::PARAM_STR);
    $rs->bindValue(":image", $data["image"], \PDO::PARAM_STR);
    $rs->execute();
}

/**
 * Supprime un poste de la base de donnée
 *
 * @param \PDO $conn
 * @param integer $id
 * @return void
 */
function deleteOneByID(\PDO $conn, int $id){
    $sql = "DELETE FROM posts WHERE id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":id", $id, \PDO::PARAM_INT);
    $rs->execute();
}

/**
 * Renvoie le nombre de postes dans la base de donnée
 *
 * @param \PDO $conn
 * @return array
 */
function findPostsCount(\PDO $conn){
    $sql = "SELECT COUNT(id) as postsCount FROM posts;";
    $rs = $conn->prepare($sql);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}