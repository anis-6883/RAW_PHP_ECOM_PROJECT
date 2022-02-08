<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");
include("app/Http/Controllers/SubcategoryController.php");
include("app/Http/Controllers/ProductController.php");

$cat_obj = new CategoryController;
$subcat_obj = new SubcategoryController;
$pro_obj = new ProductController;

if(isset($_POST['ajax_list_category']))
{
    echo $cat_obj->updateStatus($_POST['statusId'], $_POST['statusText']);
}

if(isset($_POST['ajax_list_subcategory']))
{
    echo $subcat_obj->updateStatus($_POST['statusId'], $_POST['statusText']);
}

if(isset($_POST['ajax_list_product']))
{
    echo $pro_obj->updateStatus($_POST['statusId'], $_POST['statusText']);
}

if(isset($_POST['ajax_add_product']))
{
    $subcategories = $cat_obj->getAllSubcategories($_POST['category_id']);
    if(!empty($subcategories)){
        foreach($subcategories as $subcategory)
        {
            echo '<option value="' . $subcategory['id'] . '">' . $subcategory['subcategory_name'] . '</option>';
        }
    }
    else return 0;
}
