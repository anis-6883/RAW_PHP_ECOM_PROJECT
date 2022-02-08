<?php

class AdminController extends Controller
{
	public function try_login($email, $password)
    {
        $sql = "SELECT * FROM `admins` 
                WHERE `admin_username` = :ADMIN_USERNAME 
                AND `admin_password` = :ADMIN_PASSWORD";

        $query = $this->connection->prepare($sql);

        $bindValues[':ADMIN_USERNAME'] = $email;
        $bindValues[':ADMIN_PASSWORD'] = $password;

        $query->execute($bindValues);

        $dataList = $query->fetchAll(PDO::FETCH_ASSOC);
        $totalRowSelected = $query->rowCount();

        if($totalRowSelected > 0)
            return $dataList;
        else
            return 0;
    }
}