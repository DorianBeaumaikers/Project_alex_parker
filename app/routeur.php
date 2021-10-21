<?php

use App\Controllers\PostsController;
use App\Models\PostsModel;

if(isset($_GET["addPost"])){
    include_once "../app/controllers/postsController.php";
    PostsController\addPostAction($conn);
}

elseif(isset($_GET["insertPost"])) {
    $data = [
        "title" => $_POST["title"],
        "text" => $_POST["text"],
        "image" => Core\Functions\slugifyImagePath(basename($_FILES["image"]["name"])),
        "quote" => $_POST["quote"],
        "category_id" => (int)$_POST["category_id"]
    ];

    include_once "../app/models/postsModel.php";
    PostsModel\insertOne($conn, $data);

    Core\Functions\saveImage($_FILES["image"], $image_target_dir);

    header("location: ../../");
}

elseif(isset($_GET["editPost"])) {
    include_once "../app/controllers/postsController.php";
    PostsController\editPostAction($conn, $_GET["postID"]);
}

elseif(isset($_GET["updatePost"])) {
    $data = [
        "id" => $_GET["postID"],
        "title" => $_POST["title"],
        "text" => $_POST["text"],
        "image" => Core\Functions\slugifyImagePath(basename($_FILES["image"]["name"])),
        "quote" => $_POST["quote"],
        "category_id" => (int)$_POST["category_id"]
    ];

    include_once "../app/models/postsModel.php";
    PostsModel\updateOneByID($conn, $data);

    if(!($_FILES["image"]["name"] == "")){
        PostsModel\updateImageByID($conn, $data);
        Core\Functions\saveImage($_FILES["image"], $image_target_dir);
    }

    header("location: ../../");
}

elseif (isset($_GET["postID"])) { 
    include_once "../app/controllers/postsController.php";
    PostsController\showAction($conn, $_GET["postID"]);
} 

else {
    include_once "../app/controllers/postsController.php";
    PostsController\indexAction($conn);
}
