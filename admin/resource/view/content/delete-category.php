<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");

$obj = new CategoryController;

# delete category
if (isset($_POST['delete_id'])) {

    $result = $obj->deleteCategory($_POST['delete_id']);
    header("Location: list-category.php");
}

?>