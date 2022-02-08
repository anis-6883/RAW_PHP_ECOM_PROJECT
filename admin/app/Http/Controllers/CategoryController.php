<?php

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $sql = "SELECT * FROM `categories` ORDER BY `created_at` DESC";
            $query = $this->connection->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function insertCategory($cat_name)
    {
        try {
            $sql = "INSERT INTO `categories` (`category_name`, `created_at`)
            VALUES (:CATEGORY_NAME, :CREATED_AT)";
            $query = $this->connection->prepare($sql);

            $bindValues[':CATEGORY_NAME'] = trim($cat_name);
            $bindValues[':CREATED_AT'] = date('Y-m-d H:i:s');

            $query->execute($bindValues);
            return $query->rowCount();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE `categories` 
            SET `category_status` = :STATUS, `updated_at` = :UPDATED_AT
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

    public function showCategory($id)
    {
        try {
            $sql = "SELECT * FROM `categories` WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $query->bindValue(':ID', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function updateCategory($id, $cat_name)
    {
        try {
            $sql = "UPDATE `categories` 
            SET `category_name` = :CATEGORY_NAME, `updated_at` = :UPDATED_AT
            WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':CATEGORY_NAME'] = trim($cat_name);
            $bindValues[':UPDATED_AT'] = date("Y-m-d H:i:s");
            $bindValues[':ID'] = $id;
            $query->execute($bindValues);
            return $query->rowCount();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function deleteCategory($id)
    {
        try {
            $sql = "DELETE FROM `categories` WHERE `id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':ID'] = $id;
            $query->execute($bindValues);
            return $query->rowCount();
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function getAllSubcategories($cat_id)
    {
        try {
            $sql = "SELECT * FROM `subcategories` WHERE `category_id` = :ID";
            $query = $this->connection->prepare($sql);
            $bindValues[':ID'] = $cat_id;
            $query->execute($bindValues);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 0;
        }
    }
}
