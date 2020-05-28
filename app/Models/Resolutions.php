<?php

namespace App\Models;

use \App\Core\Model;

class Resolutions extends Model
{

    public function getAllSchools()
    {
        $sql = "SELECT * FROM " . PREFIX_DB . "schools";
        $stmt = $this->pdo->query($sql);
        $schools = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $schools;
    }
    
    public function getSchool(string $school_codename)
    {
        $sql = "SELECT `name` FROM " . PREFIX_DB . "schools WHERE `codename` = :codename";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':codename', $school_codename, \PDO::PARAM_STR);
        $stmt->execute();
        $school = $stmt->fetch(\PDO::FETCH_OBJ);

        return $school;
    }
    
    public function getAllResolutionsYears(string $school)
    {
        $sql = "SELECT `year` FROM " . PREFIX_DB . "resolutions_years WHERE `school` = :school AND (`status` = 'completo' OR `status` = 'completando')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':school', $school, \PDO::PARAM_STR);
        $stmt->execute();
        $resolutionsYears = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsYears;
    }

    public function getAllResolutionsDisciplines()
    {
        $sql = "SELECT `" . PREFIX_DB . "disciplines`.`discipline`, `" . PREFIX_DB . "disciplines`.`name_normal` FROM `" . PREFIX_DB . "disciplines` INNER JOIN `" . PREFIX_DB . "resolutions_questions` ON `" . PREFIX_DB . "disciplines`.`id`=`" . PREFIX_DB . "resolutions_questions`.`discipline` LIMIT 1 ";
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

        $resolution->date_resolution = date('d/m/Y', strtotime($resolution->date_resolution));

        return $resolution;
    }
}