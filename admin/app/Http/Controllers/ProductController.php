<?php

class ProductController extends Controller
{

    public function index()
    {
        try {
            $sql = "SELECT pt.id AS id, ct.id AS category_id, ct.category_name, sct.id AS subcategory_id, sct.subcategory_name,
            product_name, product_master_image, product_regular_price, product_discounted_price,
            discount_start_date, discount_end_date, product_quantity, product_status
            FROM `products` AS pt
            INNER JOIN `categories` AS ct
            ON ct.id = pt.category_id
            INNER JOIN `subcategories` AS sct
            ON sct.id = pt.subcategory_id";

            $query = $this->connection->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function showProduct($product_id)
    {
        try {
            $sql = "SELECT pt.id AS id, ct.id AS category_id, sct.id AS subcategory_id, pt.*
            FROM `products` AS pt
            INNER JOIN `categories` AS ct
            ON ct.id = pt.category_id
            INNER JOIN `subcategories` AS sct
            ON sct.id = pt.subcategory_id
            WHERE pt.id = :PRODUCT_ID";

            $query = $this->connection->prepare($sql);
            $bindValue[':PRODUCT_ID'] = $product_id;
            $query->execute($bindValue);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE `products` 
            SET `product_status` = :STATUS, `updated_at` = :UPDATED_AT
            WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':STATUS'] = $status;
            $bindValues[':UPDATED_AT'] = date("Y-m-d H:i:s");
            $bindValues[':ID'] = $id;
            $query->execute($bindValues);
            return $query->rowCount();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function deleteProduct($product_id)
    {
        try {
            $sql = "DELETE FROM `products` WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':ID'] = $product_id;
            $query->execute($bindValues);
            return $query->rowCount();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function insertProduct($postData, $imageName = null)
    {

        try {
            $sql = "INSERT INTO `products` 
                (`category_id`, `subcategory_id`, `product_order`, `product_name`,`product_summary`,
                `product_details`, `product_master_image`, `product_regular_price`,`product_discounted_price`,
                `discount_start_date`,`discount_end_date`, `product_quantity`,`product_status`, `created_at`)
                VALUES (:CATEGORY_ID, :SUBCATEGORY_ID, :PRODUCT_ORDER, :PRODUCT_NAME, :PRODUCT_SUMMARY,
                :PRODUCT_DETAILS, :PRODUCT_MASTER_IMAGE, :PRODUCT_REGULAR_PRICE, :PRODUCT_DISCOUNTED_PRICE,
                :DISCOUNT_START_DATE, :DISCOUNT_END_DATE, :PRODUCT_QUANTITY, :PRODUCT_STATUS, :CREATED_AT)";

            $query = $this->connection->prepare($sql);

            $bindValues[':CATEGORY_ID'] = $postData['category_id'];
            $bindValues[':SUBCATEGORY_ID'] = $postData['subcategory_id'];
            $bindValues[':PRODUCT_ORDER'] = $postData['product_order'];
            $bindValues[':PRODUCT_NAME'] = $postData['product_name'];
            $bindValues[':PRODUCT_SUMMARY'] = $postData['product_summary'];
            $bindValues[':PRODUCT_DETAILS'] = $postData['product_details'];
            $bindValues[':PRODUCT_MASTER_IMAGE'] = $imageName;
            $bindValues[':PRODUCT_REGULAR_PRICE'] = $postData['product_regular_price'];

            if(!empty($postData['product_discounted_price']))
            {
                $bindValues[':PRODUCT_DISCOUNTED_PRICE'] = $postData['product_discounted_price'];
                $bindValues[':DISCOUNT_START_DATE'] = $postData['discount_start_date'];
                $bindValues[':DISCOUNT_END_DATE'] = $postData['discount_end_date'];
            }else{
                $bindValues[':PRODUCT_DISCOUNTED_PRICE'] = null;
                $bindValues[':DISCOUNT_START_DATE'] = null;
                $bindValues[':DISCOUNT_END_DATE'] = null;
            }

            $bindValues[':PRODUCT_QUANTITY'] = $postData['product_quantity'];
            $bindValues[':PRODUCT_STATUS'] = $postData['product_status'];
            $bindValues[':CREATED_AT'] = date('Y-m-d H:i:s');
            $query->execute($bindValues);

            if ($query->rowCount() > 0)
                return $query->rowCount();
            else return 0;
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function updateProduct($postData,  $product_id, $imageName)
    {

        try {
            $sql = "UPDATE `products` 
                SET `category_id` = :CATEGORY_ID, `subcategory_id` = :SUBCATEGORY_ID, `product_order` = :PRODUCT_ORDER,
                `product_name` = :PRODUCT_NAME, `product_summary` = :PRODUCT_SUMMARY, `product_details` = :PRODUCT_DETAILS, 
                `product_master_image` = :PRODUCT_MASTER_IMAGE, `product_regular_price` = :PRODUCT_REGULAR_PRICE,
                `product_discounted_price` = :PRODUCT_DISCOUNTED_PRICE, `discount_start_date` = :DISCOUNT_START_DATE,
                `discount_end_date` = :DISCOUNT_END_DATE, `product_quantity` = :PRODUCT_QUANTITY, `product_status` = :PRODUCT_STATUS,
                `updated_at` = :UPDATED_AT
                WHERE id = :PRODUCT_ID";

            $query = $this->connection->prepare($sql);

            $bindValues[':PRODUCT_ID'] = $product_id;
            $bindValues[':CATEGORY_ID'] = $postData['category_id'];
            $bindValues[':SUBCATEGORY_ID'] = $postData['subcategory_id'];
            $bindValues[':PRODUCT_ORDER'] = $postData['product_order'];
            $bindValues[':PRODUCT_NAME'] = $postData['product_name'];
            $bindValues[':PRODUCT_SUMMARY'] = $postData['product_summary'];
            $bindValues[':PRODUCT_DETAILS'] = $postData['product_details'];
            $bindValues[':PRODUCT_MASTER_IMAGE'] = $imageName;
            $bindValues[':PRODUCT_REGULAR_PRICE'] = $postData['product_regular_price'];

            if(!empty($postData['product_discounted_price']))
            {
                $bindValues[':PRODUCT_DISCOUNTED_PRICE'] = $postData['product_discounted_price'];
                $bindValues[':DISCOUNT_START_DATE'] = $postData['discount_start_date'];
                $bindValues[':DISCOUNT_END_DATE'] = $postData['discount_end_date'];
            }else{
                $bindValues[':PRODUCT_DISCOUNTED_PRICE'] = null;
                $bindValues[':DISCOUNT_START_DATE'] = null;
                $bindValues[':DISCOUNT_END_DATE'] = null;
            }
            
            $bindValues[':PRODUCT_QUANTITY'] = $postData['product_quantity'];
            $bindValues[':PRODUCT_STATUS'] = $postData['product_status'];
            $bindValues[':UPDATED_AT'] = date('Y-m-d H:i:s');
            $query->execute($bindValues);

            if ($query->rowCount() > 0)
                return $query->rowCount();
            else return 0;
        } catch (PDOException $e) {
            return 0;
        }
    }
}


