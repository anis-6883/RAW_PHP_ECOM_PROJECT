<?php

class HomeController extends Controller
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
}
