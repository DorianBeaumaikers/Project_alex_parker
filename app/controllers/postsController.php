<?php

namespace App\Controllers\PostsController;

use App\Models\PostsModel;

function indexAction(\PDO $conn) {
    include_once "../app/models/postsModel.php";
    $posts = PostsModel\findAllWithLimit($conn, 10);

    GLOBAL $content;
    ob_start();
        require_once "../app/views/posts/index.php";
    $content = ob_get_clean();
}

function showAction(\PDO $conn, int $id){
    include_once "../app/models/postsModel.php";
    $post = PostsModel\findOneByID($conn, $id);

    GLOBAL $title;
    $title = "Alex Parker - " . $post["title"];

    GLOBAL $content;
    ob_start();
        require_once "../app/views/posts/show.php";
    $content = \ob_get_clean();
}