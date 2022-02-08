<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");
include("app/Http/Controllers/SubcategoryController.php");

$cat_obj = new CategoryController;
$subcat_obj = new SubcategoryController;

if (isset($_POST['save_subcategory'])) {
    $subcat_name = $_POST['subcategory_name'];
    $cat_id = $_POST['category_id'];
    $result = $subcat_obj->insertSubcategory($cat_id, $subcat_name);
}

$categories = $cat_obj->index();

?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list-category.php">Manage Subcategory</a></li>
                <li class="breadcrumb-item active"><a href="add-category.php">Add Subcategory</a></li>
            </ol>
        </div>
    </div>

    <?php if (isset($_POST['save_subcategory'])) : ?>

        <?php if (!empty($result)) : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> The subcategory is saved successfully.
                </div>
            </div>

        <?php else : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Faild!</strong> The subcategory is not saved successfully.
                </div>
            </div>

        <?php endif; ?>

    <?php endif; ?>


    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Subcategory</h4>
                        <div class="basic-form">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="category_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?php echo $category['id'] ?>">
                                                    <?php echo $category['category_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Subcategory Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="subcategory_name" class="form-control" placeholder="Enter Subcategory Name..." required autofocus autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_subcategory" type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>