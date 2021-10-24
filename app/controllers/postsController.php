<?php

namespace App\Controllers\PostsController;

use App\Models\PostsModel;
use App\Models\CategoriesModel;

/**
 * Route de base - Affiche la liste des postes
 *
 * @param \PDO $conn
 * @param integer $page
 * @return void
 */
function indexAction(\PDO $conn, int $page = 0) {
    include_once "../app/models/postsModel.php";

    $postsCount = PostsModel\findPostsCount($conn);
    $postsCount = (int)$postsCount["postsCount"];
    $pages = ceil($postsCount/10);

    $offset = ($page-1) * 10;

    $posts = PostsModel\findAllWithLimit($conn, 10, $offset);

    GLOBAL $content;
    ob_start();
        require_once "../app/views/posts/index.php";
    $content = ob_get_clean();
}

/**
 * Affiche un post selon l'id donnée
 *
 * @param \PDO $conn
 * @param integer $id
 * @return void
 */
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

/**
 * Affiche le formulaire d'ajout d'un post
 *
 * @param \PDO $conn
 * @return void
 */
function addPostAction(\PDO $conn) {
    include_once "../app/models/categoriesModel.php";
    $categories = CategoriesModel\findAll($conn);

    GLOBAL $title;
    $title = "Alex Parker - Add a post";

    GLOBAL $content;
    ob_start();
        include_once "../app/views/posts/addPost.php";
    $content = ob_get_clean();
}

/**
 * Affiche le formulaire d'édition d'un post
 *
 * @param \PDO $conn
 * @param integer $id
 * @return void
 */
function editPostAction(\PDO $conn, int $id) {
    include_once "../app/models/postsModel.php";
    $post = PostsModel\findOneByID($conn, $id);

    include_once "../app/models/categoriesModel.php";
    $categories = CategoriesModel\findAll($conn);

    GLOBAL $title;
    $title = "Alex Parker - Edit a post";

    GLOBAL $content;
    ob_start();
        include_once "../app/views/posts/editPost.php";
    $content = ob_get_clean();
}