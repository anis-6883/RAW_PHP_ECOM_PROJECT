<?php
include("app/Http/Controllers/View.php");

$view = new View;
$view->loadContent("include", "session");
$view->loadContent("include", "top");
$view->loadContent("content", "add-subcategory");
$view->loadContent("include", "tail");

?>