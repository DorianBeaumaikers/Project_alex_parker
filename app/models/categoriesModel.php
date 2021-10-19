<?php

namespace App\Models\CategoriesModel;

function findAll(\PDO $conn) {
    $sql = "SELECT * FROM categories ORDER BY name;";
    $rs = $conn->prepare($sql);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findAllWithCount(\PDO $conn) {
    $sql = "SELECT c.name, COUNT(*) as categoryCount FROM posts p JOIN categories c ON p.category_id = c.id GROUP BY c.name ORDER BY c.name;";
    $rs = $conn->prepare($sql);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}