<?php

class ProductController extends Controller
{
    public function get_categories()
    {
        try {
            $sql = "SELECT * 
                    FROM `categories`
                    WHERE `category_status` = 'Active'
                    ORDER BY `category_name`";
            $query = $this->connection->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function get_subcategories($cat_id)
    {
        try {
            $sql = "SELECT * 
                    FROM `subcategories`
                    WHERE `category_id` = :CATEGORY_ID AND `subcategory_status` = 'Active'
                    ORDER BY `subcategory_name`";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':CATEGORY_ID', $cat_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function get_category_name($cat_id)
    {
        try {
            $sql = "SELECT `category_name`
                    FROM `categories`
                    WHERE `id` = :CATEGORY_ID";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':CATEGORY_ID', $cat_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function get_product_by_category($cat_id)
    {
        try {
            $sql = "SELECT *
                    FROM `products`
                    WHERE `category_id` = :CATEGORY_ID";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':CATEGORY_ID', $cat_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function total_product_by_category($cat_id)
    {
        try {
            $sql = "SELECT COUNT(*) AS `total_product`
                    FROM `products`
                    WHERE `category_id` = :CATEGORY_ID";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':CATEGORY_ID', $cat_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }
}
