<?php

?>

<div id="main">
    <div class="container">
        <div class="row">
            <!-- About Me (Left Sidebar) Start -->
            <?php require_once "../app/views/template/partials/_aside.php"; ?>
            <!-- About Me (Left Sidebar) End -->

            <!-- Blog Post (Right Sidebar) Start -->
            <div class="col-md-9">
                
                <?php echo $content; ?>

                <!-- Footer Start -->
                <?php require_once "../app/views/template/partials/_footer.php"; ?>
                <!-- Footer End -->
            </div>
            <!-- Blog Post (Right Sidebar) End -->
        </div>
    </div>
</div>