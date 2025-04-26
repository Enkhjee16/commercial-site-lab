<?php
include("config.php");
include("includes/header.php");

$page = $_GET['page'] ?? 'home';

if (array_key_exists($page, $menu)) {
    include("pages/{$page}.php");
} else {
    echo "<h2>Page not found</h2>";
}

include("includes/footer.php");
?>
