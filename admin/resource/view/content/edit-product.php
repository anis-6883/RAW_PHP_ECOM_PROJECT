<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/CategoryController.php");
include("app/Http/Controllers/SubcategoryController.php");
include("app/Http/Controllers/ProductController.php");

$pro_obj = new ProductController;
$cat_obj = new CategoryController;
$subcat_obj = new SubcategoryController;

$categories = $cat_obj->index();

# Hold Editing Product's ID in Session Variable to Edit it Further
if (isset($_POST['product_edit_id']))
    $_SESSION['product_edit_id'] = $_POST['product_edit_id'];

if (isset($_POST['update_product'])) {
    $fileType = $_FILES['product_master_image']['type'];
    $fileSize = $_FILES['product_master_image']['size'];
    $fileError = $_FILES['product_master_image']['error'];
    $fileName = $_FILES['product_master_image']['name'];
    $fileTemp = $_FILES['product_master_image']['tmp_name'];
    $checkImage = $pro_obj->checkImage($fileType, $fileSize, $fileError);

    if ($checkImage == 1 && !empty($_FILES['product_master_image']['name'])) {
        $masterImageName = "PRODUCT_" . date('YmdHis') . rand(100000, 999999) . "_" . $fileName;
        $result = $pro_obj->updateProduct($_POST, $_SESSION['product_edit_id'], $masterImageName);
    } else {
        $result = $pro_obj->updateProduct($_POST, $_SESSION['product_edit_id'], $_SESSION['edit_product_image_name']);
    }

    if ($result > 0 && $checkImage == 1) {
        move_uploaded_file($fileTemp, $GLOBALS['PRODUCT_DIRECTORY'] . $masterImageName);
        # delete old image
        if ($_SESSION['edit_product_image_name'] != null)
            unlink($GLOBALS['PRODUCT_DIRECTORY'] . $_SESSION['edit_product_image_name']);
    }
}

$productDetail = $pro_obj->showProduct($_SESSION['product_edit_id']);
$_SESSION['edit_product_image_name'] = $productDetail['product_master_image'];

?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="list-product.php">Manage Product</a></li>
                <li class="breadcrumb-item active"><a href="add-product.php">Edit Product</a></li>
            </ol>
        </div>
    </div>

    <?php if (isset($_POST['update_product'])) : ?>

        <?php if (!empty($result)) : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> The product is updated successfully.
                </div>
            </div>

        <?php else : ?>
            <div class="container-fluid mt-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Faild!</strong> Unable to update the product.
                </div>
            </div>

        <?php endif; ?>

    <?php endif; ?>


    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit A Product</h4>
                        <div class="basic-form">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="category_id" class="custom-select mr-sm-2" id="select_category">
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?php echo $category['id'] ?>" <?php if ($productDetail['category_id'] == $category['id']) echo "selected" ?>>
                                                    <?php echo $category['category_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="subcategory_id" class="custom-select mr-sm-2" id="select_subcategory"></select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Order Serial</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="product_order" class="form-control input-default" autocomplete="off" value="<?php echo @$productDetail['product_order'] ?>">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="text" name="product_name" class="form-control input-default" required autocomplete="off" value="<?php echo @$productDetail['product_name'] ?>">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Summary</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="product_summary" id="richTextEditor1"><?php echo @$productDetail['product_summary'] ?></textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Product Details</label>
                                    <div class="col-sm-10 mb-4">
                                        <textarea name="product_details" id="richTextEditor2"><?php echo @$productDetail['product_details'] ?></textarea>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Regular Price</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="product_regular_price" class="form-control input-default" required autocomplete="off" value="<?php echo @$productDetail['product_regular_price'] ?>">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Price</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="product_discounted_price" class="form-control input-default" autocomplete="off" value="<?php echo @$productDetail['product_discounted_price'] ?>">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Start On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="discount_start_date" name="discount_start_date" type="text" autocomplete="off" value="<?php echo @$productDetail['discount_start_date'] ?>" />
                                    </div>

                                    <label class="col-sm-2 col-form-label">Discounted Ends On</label>
                                    <div class="col-sm-10 mb-4">
                                        <input class="form-control input-default jqdatepicker" id="discount_end_date" name="discount_end_date" type="text" autocomplete="off" value="<?php echo @$productDetail['discount_end_date'] ?>" />
                                    </div>

                                    <label class="col-sm-2 col-form-label">Stock Quantity</label>
                                    <div class="col-sm-10 mb-4">
                                        <input type="number" name="product_quantity" class="form-control input-default" required autocomplete="off" value="<?php echo @$productDetail['product_quantity'] ?>">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Preview</label>
                                    <div class="col-sm-10 mb-4">
                                        <td><img <?php

                                                    if ($productDetail['product_master_image'] != null) {
                                                        echo 'src = ' . $GLOBALS['PRODUCT_DIRECTORY'] . $productDetail['product_master_image'];
                                                    } else {
                                                        echo 'src="public/images/no-image.png"';
                                                    }

                                                    ?> id="master_img" alt="No Image Found" width="100px" height="100px">
                                        </td>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Master Image</label>
                                    <div class="col-sm-10 mb-4">
                                        <input onchange="loadFile(event)" name="product_master_image" type="file" class="form-control input-default">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10 mb-4">
                                        <select name="product_status" class="custom-select mr-sm-2" id="product_status">
                                            <option <?php if ($productDetail['product_status'] == "Active") echo "selected" ?>>Active</option>
                                            <option <?php if ($productDetail['product_status'] == "Inactive") echo "selected" ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button name="update_product" type="submit" class="btn btn-warning">Update</button>
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

<script>
    $(function() {
        // ------------ ON PAGE LOAD GET CATEGORY ID AND LOAD SUBCATEGORY ------------ //
        var cat_id = $("#select_category").val();

        if (cat_id != "") {
            $.ajax({
                url: "./ajax.php",
                type: "post",
                data: {
                    ajax_edit_product: "Yes",
                    category_id: cat_id,
                    subcategory_id: <?php echo $productDetail['subcategory_id'] ?>
                },
                success: function(response) {
                    if (response) {
                        $("#select_subcategory").html(response);
                        // console.log(response);
                    } else {
                        $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                    }
                }
            })
        }

        // ------------ WHEN I CHANGE THE CATEGORY | LOAD SUBCATEGORY ------------ //
        $("#select_category").change(function() {

            let cat_id = $(this).val();
            if (cat_id != "") {
                $.ajax({
                    url: "./ajax.php",
                    type: "post",
                    data: {
                        ajax_add_product: "Yes",
                        category_id: cat_id
                    },
                    success: function(response) {
                        if (response) {
                            $("#select_subcategory").html(response);
                        } else {
                            $("#select_subcategory").html("<option value=''>No Subcategory Found</option>");
                        }
                    }
                })
            }
        })
    });

    var loadFile = function(event) {
        var output = document.getElementById('master_img');
        output.style.display = null;
        output.parentElement.classList.add("mb-4")
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>