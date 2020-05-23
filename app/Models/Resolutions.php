<?php

namespace App\Models;

use \App\Core\Model;

class Resolutions extends Model
{
    public function getAllResolutionsYears()
    {
        $sql = "SELECT `year` FROM " . PREFIX_DB . "resolutions_years WHERE `status` = 'completo' OR `status` = 'completando'";
        $stmt = $this->pdo->query($sql);
        $resolutionsYears = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsYears;
    }

    public function getAllResolutionsDisciplines()
    {
        $sql = "SELECT `discipline`, `name_normal`, `number_questions` FROM " . PREFIX_DB . "disciplines";
        $stmt = $this->pdo->query($sql);
        $resolutionsDisciplines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsDisciplines;
    }

    public function getNumberQuestions(string $exam_year, string $discipline_id)
    {
        $sql = "SELECT `number_question` FROM " . PREFIX_DB . "resolutions_questions WHERE `exam_year` = :exam_year AND `discipline` = :discipline_id ORDER BY `number_question`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':exam_year', $exam_year, \PDO::PARAM_STR);
        $stmt->bindParam(':discipline_id', $discipline_id, \PDO::PARAM_STR);
        $stmt->execute();
        $numberQuestions = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $numberQuestions;
    }

    public function getAllResolutionsQuestions(string $exam_year, string $discipline_id, string $number_question)
    {
        $sql = "SELECT * FROM " . PREFIX_DB . "resolutions_questions WHERE `exam_year` = :exam_year AND `discipline` = :discipline_id AND `number_question` = :number_question";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':exam_year', $exam_year, \PDO::PARAM_STR); 
        $stmt->bindParam(':discipline_id', $discipline_id, \PDO::PARAM_STR); 
        $stmt->bindParam(':number_question', $number_question, \PDO::PARAM_STR); 
        $stmt->execute();
        $resolution = $stmt->fetch(\PDO::FETCH_OBJ);

        $resolution->date_resolution = \convertDatetimeToDate($resolution->date_resolution);
        return $resolution;
    }
}