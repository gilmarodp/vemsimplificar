<?php

namespace App\Models;

use \App\Core\Model;

class Admin extends Model
{
    public function doValidateLogin(string $email, string $password)
    {
        $sql = "SELECT * FROM mc_admins WHERE `email` = :email AND `password` = :password_login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password_login', $password, \PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}