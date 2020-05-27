<?php

namespace App\Models;

use \App\Core\Model;

class Exams extends Model
{
    public function getAllExams(string $school)
    {
        $sql = "SELECT `year`, `link` FROM " . PREFIX_DB . "exams WHERE `school` = :school";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':school', $school, \PDO::PARAM_STR);
        $stmt->execute();
        $exams = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $exams;
    }
}