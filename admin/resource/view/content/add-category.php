<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");

$obj = new CategoryController;

if (isset($_POST['save_category'])) {
    $result = $obj->insertCategory($_POST['category_name']);
}

?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list-category.php">Manage Category</a></li>
                <li class="breadcrumb-item active"><a href="add-category.php">Add Category</a></li>
            </ol>
        </div>
    </div>

    <?php if (isset($_POST['save_category'])) : ?>

        <?php if (!empty($result)) : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> The category is saved successfully.
                </div>
            </div>

        <?php else : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Faild!</strong> The category is not saved successfully.
                </div>
            </div>

        <?php endif; ?>

    <?php endif; ?>


    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add New Category</h4>
                        <div class="basic-form">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name..." required autofocus autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="save_category" type="submit" class="btn btn-primary">Submit</button>
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