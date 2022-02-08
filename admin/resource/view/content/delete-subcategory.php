<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/SubcategoryController.php");

$obj = new SubcategoryController;

# delete category
if (isset($_POST['delete_id'])) {

    $result = $obj->deleteSubcategory($_POST['delete_id']);
    header("Location: list-subcategory.php");
}

?>