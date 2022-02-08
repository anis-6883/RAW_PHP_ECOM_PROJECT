<?php

class SubcategoryController extends Controller{

    public function index()
    {
        try
        {
            $sql = "SELECT c.id AS cat_id, s.id AS subcat_id, c.category_name, 
                    subcategory_name, subcategory_status, s.created_at 
                    FROM `subcategories` AS s
                    INNER JOIN `categories` AS c
                    ON c.id = s.category_id
                    ORDER BY s.created_at DESC";

            $query = $this->connection->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function updateStatus($id, $status)
    {
        try
        {
            $sql = "UPDATE `subcategories` 
            SET `subcategory_status` = :STATUS, `updated_at` = :UPDATED_AT
            WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':STATUS'] = $status;
            $bindValues[':UPDATED_AT'] = date("Y-m-d H:i:s");
            $bindValues[':ID'] = $id;
            $query->execute($bindValues);
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function insertSubcategory($cat_id, $subcat_name)
    {
        try
        {
            $sql = "INSERT INTO `subcategories` (`category_id`, `subcategory_name`, `created_at`)
            VALUES (:CATEGORY_ID, :SUBCATEGORY_NAME, :CREATED_AT)";
            $query = $this->connection->prepare($sql);

            $bindValues[':CATEGORY_ID'] = $cat_id;
            $bindValues[':SUBCATEGORY_NAME'] = trim($subcat_name);
            $bindValues[':CREATED_AT'] = date('Y-m-d H:i:s');

            $query->execute($bindValues);
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function showSubcategory($id)
    {
        try
        {
            $sql = "SELECT * FROM `subcategories` WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':ID', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function updateSubcategory($cat_id, $subcat_id, $subcat_name)
    {
        try
        {
            $sql = "UPDATE `subcategories`
            SET `category_id` = :CATEGORY_ID, `subcategory_name` = :SUBCATEGORY_NAME, `updated_at` = :UPDATED_AT
            WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':SUBCATEGORY_NAME'] = trim($subcat_name);
            $bindValues[':CATEGORY_ID'] = $cat_id;
            $bindValues[':ID'] = $subcat_id;
            $bindValues[':UPDATED_AT'] = date("Y-m-d H:i:s");
            $query->execute($bindValues);
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function deleteSubcategory($id)
    {
        try
        {
            $sql = "DELETE FROM `subcategories` WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':ID'] = $id;
            $query->execute($bindValues);
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }
}