<?php

use App\Controllers\PostsController;

if (isset($_GET["postID"])) {
    include_once "../app/controllers/postsController.php";
    PostsController\showAction($conn, $_GET["postID"]);
} 

else {
    include_once "../app/controllers/postsController.php";
    PostsController\indexAction($conn);
}
