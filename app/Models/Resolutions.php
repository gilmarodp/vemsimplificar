<?php

namespace App\Models;

use \App\Core\Model;

class Resolutions extends Model
{
    public function getAllResolutionsYears()
    {
        $sql = "SELECT `year` FROM `mc_resolutions_years` WHERE `status` = 'completo' OR `status` = 'completando'";
        $stmt = $this->pdo->query($sql);
        $resolutionsYears = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsYears;
    }

    public function getAllResolutionsDisciplines()
    {
        $sql = "SELECT `discipline`, `name_normal` FROM `mc_disciplines`";
        $stmt = $this->pdo->query($sql);
        $resolutionsDisciplines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsDisciplines;
    }
}