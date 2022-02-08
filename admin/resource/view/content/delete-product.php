<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/ProductController.php");

$pro_obj = new ProductController;

# delete product
if (isset($_POST['delete_id'])) {

    $result = $pro_obj->deleteProduct($_POST['delete_id']);
    header("Location: list-product.php");
}

?>