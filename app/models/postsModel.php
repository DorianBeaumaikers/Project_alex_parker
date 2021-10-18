<?php

namespace App\Models\PostsModel;

function findAllWithLimit(\PDO $conn, int $limit = 10) {
    $sql = "SELECT p.id, p.title, p.text, p.created_at, p.quote, p.image, c.name FROM posts p JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC LIMIT :limit;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(":limit", $limit, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}