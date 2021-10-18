<?php

use App\Controllers\PostsController;

include_once "../app/controllers/postsController.php";
PostsController\indexAction($conn);