<?php

class UserController extends Controller
{
    public function user_register($post)
    {
        try
        {
            $sql = "INSERT INTO `customers` (`customer_name`, `customer_email`, `password`, `customer_gender`, `customer_dob`, `created_at`)
            VALUES (:CUSTOMER_NAME, :CUSTOMER_EMAIL, :PASSWORD, :CUSTOMER_GENDER, :CUSTOMER_DOB, :CREATED_AT)";
            $query = $this->connection->prepare($sql);
            
            $bindValues[':CUSTOMER_NAME'] = $post['user_fullname'];
            $bindValues[':CUSTOMER_EMAIL'] = $post['user_email'];
            $bindValues[':PASSWORD'] = sha1($post['user_password']);
            $bindValues[':CUSTOMER_GENDER'] = $post['user_gender'];
            $bindValues[':CUSTOMER_DOB'] = $post['user_dob'];
            $bindValues[':CREATED_AT'] = date("Y-m-d H:i:s");
            
            $query->execute($bindValues);
            return $query->rowCount();
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }

    public function user_login($post)
    {
        try
        {
            $sql = "SELECT * FROM `customers` WHERE `customer_email` = :CUSTOMER_EMAIL AND `password` = :PASSWORD";
            $query = $this->connection->prepare($sql);
            
            $bindValues[':CUSTOMER_EMAIL'] = $post['user_email'];
            $bindValues[':PASSWORD'] = sha1($post['user_password']);
            
            $query->execute($bindValues);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            return 0;
        }
    }
}