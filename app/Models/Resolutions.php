<?php

namespace App\Models;

use \App\Core\Model;

class Resolutions extends Model
{

    // ======================================================
    // ======================================================
    // ================= SCHOOLS ============================
    // ======================================================
    // ======================================================

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
   
    // ======================================================
    // ======================================================
    // ================= RESOLUTIONS ========================
    // ======================================================
    // ======================================================
    
    public function getAllResolutionsYears(string $school)
    {
        $sql = "SELECT `year` FROM " . PREFIX_DB . "resolutions_years WHERE `school` = :school AND (`status` = 'completo' OR `status` = 'completando')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':school', $school, \PDO::PARAM_STR);
        $stmt->execute();
        $resolutionsYears = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resolutionsYears;
    }

    public function getAllResolutionsDisciplines(string $school_codename)
    {
        $sql = "SELECT `disciplines` FROM `" . PREFIX_DB . "schools` WHERE `codename`=:school_codename LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':school_codename', $school_codename, \PDO::PARAM_STR);
        $stmt->execute();
        $resolutionsDisciplines = $stmt->fetch(\PDO::FETCH_OBJ);
        $resolutionsDisciplines->disciplines = json_decode($resolutionsDisciplines->disciplines, JSON_PRETTY_PRINT);

        return $resolutionsDisciplines->disciplines;
    }

    public function getNumberQuestions(string $exam_year, string $discipline_id)
    {
        $sql = "SELECT `number_question` FROM " . PREFIX_DB . "resolutions_questions WHERE `exam_year` = :exam_year AND `discipline` = :discipline_id ORDER BY CAST(number_question AS UNSIGNED INT) ASC";
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

        if (!$resolution)
            $resolution = null;

        return $resolution;
    }
}
