<?php

namespace App\Models;

use \App\Core\Model;

class Exams extends Model
{
    public function getAllExams()
    {
        $sql = "SELECT `year`, `link` FROM `mc_exams`";
        $stmt = $this->pdo->query($sql);
        $exams = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $exams;
    }
}