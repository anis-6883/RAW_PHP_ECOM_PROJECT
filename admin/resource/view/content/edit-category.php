<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");

$obj = new CategoryController;

if (isset($_POST['update_category'])) {
    $result = $obj->updateCategory($_SESSION['edit_category_id'], $_POST['category_name']);
}

if (isset($_POST['edit_id'])) {
    $_SESSION['edit_category_id'] = $_POST['edit_id'];
}

$categoryDetail = $obj->showCategory($_SESSION['edit_category_id']);

?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list-category.php">Manage Category</a></li>
                <li class="breadcrumb-item active"><a href="add-category.php">Edit Category</a></li>
            </ol>
        </div>
    </div>

    <?php if (isset($_POST['update_category'])) : ?>

        <?php if (!empty($result)) : ?>
            <?php echo "<script>window.location.href='list-category.php';</script>"; ?>
        <?php else : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Faild!</strong> The category is already existed.
                </div>
            </div>

        <?php endif; ?>

    <?php endif; ?>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Category</h4>
                        <div class="basic-form">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name..." required autofocus autocomplete="off" value="<?php echo $categoryDetail['category_name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="update_category" type="submit" class="btn btn-warning">Update</button>
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