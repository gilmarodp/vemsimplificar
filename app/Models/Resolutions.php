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
        $sql = "SELECT `discipline`, `name_normal`, `number_questions` FROM `mc_disciplines`";
        $stmt = $this->pdo->query($sql);
        $resolutionsDisciplines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsDisciplines;
    }

    public function getAllResolutionsQuestions(string $exam_year, string $discipline_id, string $number_question)
    {
        $sql = "SELECT * FROM `mc_resolutions_questions` WHERE `exam_year` = :exam_year AND `discipline` = :discipline_id AND `number_question` = :number_question";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':exam_year', $exam_year, \PDO::PARAM_STR); 
        $stmt->bindParam(':discipline_id', $discipline_id, \PDO::PARAM_STR); 
        $stmt->bindParam(':number_question', $number_question, \PDO::PARAM_STR); 
        $stmt->execute();
        $resolution = $stmt->fetch(\PDO::FETCH_OBJ);

        return $resolution;
    }
}