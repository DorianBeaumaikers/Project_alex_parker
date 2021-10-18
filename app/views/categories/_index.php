<?php foreach ($categories as $category) :?>
    <li><a href="index.html"><?php echo $category["name"]; ?> [<?php echo $category["categoryCount"]; ?>]</a></li>
<?php endforeach; ?>
