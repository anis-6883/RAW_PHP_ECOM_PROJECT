<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");

$obj = new CategoryController;

# list categories
$categories = $obj->index();
$serialId = 1;

?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list-category.php">Manage Category</a></li>
                <li class="breadcrumb-item active"><a href="list-category.php">List Category</a></li>
            </ol>
        </div>
    </div>

    <?php if (!empty(@$result)) : ?>

        <div class="container-fluid mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Success!</strong> The Operation Performs Successfully.
            </div>
        </div>

    <?php endif; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Category</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">

                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($categories as $category) : ?>
                                        <tr>
                                            <td><?php echo $serialId++ ?></td>
                                            <td><?php echo $category['category_name'] ?></td>
                                            <td>
                                                <?php if ($category['category_status'] == "Active") : ?>
                                                    <button id="status<?php echo $category['id'] ?>" onclick="chnageStatus(<?php echo $category['id'] ?>)" class="badge badge-success px-2">
                                                        Active
                                                    </button>
                                                <?php else : ?>
                                                    <button id="status<?php echo $category['id'] ?>" onclick="chnageStatus(<?php echo $category['id'] ?>)" class="badge badge-danger px-2">
                                                        Inactive
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $date = date_parse($category['created_at']);
                                                echo $date['day'] . " - " . $date['month'] . " - " . $date['year'];
                                                ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <form class="mr-2" action="edit-category.php" method="post">
                                                        <input type="hidden" name="edit_id" value="<?php echo $category['id'] ?>">
                                                        <button class="btn btn-info btn-xs" type="submit">Edit</button>
                                                    </form>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="basicModal<?php echo $category['id'] ?>">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Are you sure to delete <b>"<?php echo $category['category_name'] ?>"</b> Category? </div>
                                                                <div class="modal-footer">
                                                                    <form action="delete-category.php" method="post">
                                                                        <input type="hidden" name="delete_id" value="<?php echo $category['id'] ?>">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#basicModal<?php echo $category['id'] ?>">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function chnageStatus(statusId) {
        $(function() {
            var statusBtn = $(`#status${statusId}`);
            var statusText = statusBtn.text();
            $.ajax({
                url: "./ajax.php",
                type: "post",
                data: {
                    statusId,
                    statusText: statusText === "Active" ? "Inactive" : "Active",
                    ajax_list_category: "Yes"
                },
                success: function(result) {
                    if (result) {
                        if (statusText === "Active") {
                            statusBtn.text("Inactive");
                            statusBtn.removeClass("badge-success");
                            statusBtn.addClass("badge-danger");
                        } else {
                            statusBtn.text("Active");
                            statusBtn.removeClass("badge-danger");
                            statusBtn.addClass("badge-success");
                        }
                    }
                }
            });
        });
    }
</script>